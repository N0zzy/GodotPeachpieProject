using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text.RegularExpressions;

namespace Compiler;

using System;
using PhpieSdk.Library;

public class Compiler: CompilerHelper
{

    protected static string OutPath = "project/";
    
    protected static string LibsPath = "support/utils/compiler/bin/Debug/net7.0";
    
    public static readonly string PrefixPhpFiles = "Ux";
    

    public static void Main( string[] args )
    {
        ProjectPath = GetProjectPath();
        ApplicationPath = $"{ProjectPath}project/application/";
        LibraryPath = $"{ProjectPath}project/library/";

        var dirs = new string[]
        {
            "Scene", "Gui"
        };
        var index = 0;
        foreach (var dir in  dirs)
        {
            GenerateUx(dir, index);
			index++;
        }
        new PhpieSdkRunner().Run( 
            ProjectPath + OutPath, 
            ProjectPath + LibsPath
        );
    }


}

public abstract class CompilerHelper
{
    protected static string ProjectPath { get;  set; }
    protected static string ApplicationPath { get;  set; }
    protected static string LibraryPath { get;  set; }
    
    
    protected static string GetProjectPath()
    {
        string currentPath = AppDomain.CurrentDomain.BaseDirectory;
        return currentPath.Split("support")[0].Replace("\\", "/");
    }
    
    protected static void GenerateUx(string name, int index)
    {
        string[] uxs = Directory.GetFiles(
            LibraryPath + "src/" + name, "Ux*.php", SearchOption.AllDirectories
        );
        
        foreach (var ux in uxs)
        {
            var p = ux.Split(name)[1];
            var d = Path.GetDirectoryName(p)!.Substring(1);
            d = d.Length > 0 ? $"/{d}" : d;
            var s = p
                .Replace("\\", ".")
                .Replace("/", ".")
                .Replace(Compiler.PrefixPhpFiles, "")
                .Replace(".php", "");
            var ns = RemoveLastSegment(s);
            var nm = GetLastSegment(s);
            var sn = name.ToLower();
            var dir = ApplicationPath + $"{sn}{d}/";
            if( !Directory.Exists( dir )){
                Directory.CreateDirectory( dir );
            }            
            var txt = $"using GodotPeachpie.{name}{ns};\n" +
                      $"using Godot;\n" +
                      $"[Tool]\n" +
                      $"public partial class {nm} : {Compiler.PrefixPhpFiles}{nm}\n" +  
                      "{\n";
            var code = File.ReadAllText(ux);
            if(index == 0)
            {
                txt += "\tpublic override void _Ready()\n"
                     + "\t{\n"
                     + "\t\tbase._Ready();\n"
                     + "\t}\n";
            }
            txt += GetSignals(code);
            txt += "}";
            File.WriteAllText($"{dir}{nm}.cs", txt);
        }
    }

    protected static string GetLastSegment(string input)
    {
        int lastDotIndex = input.LastIndexOf('.');
        if (lastDotIndex != -1)
        {
            return input.Substring(lastDotIndex + 1);
        }
        return input;
    }

    protected static string RemoveLastSegment(string input)
    {
        int lastDotIndex = input.LastIndexOf('.');
        if (lastDotIndex != -1)
        {
            return input.Substring(0, lastDotIndex);
        }
        return input;
    }
    
    protected static string GetSignals(string code)
    {
        var result = "";
        string pattern = @"/\*\*\s*\*\s*@signal\s*\*/\s*public function\s+(\w+)\(([^)]*)\)";
        MatchCollection matches = Regex.Matches(code, pattern);

        foreach (Match match in matches)
        {
            string functionName = match.Groups[1].Value;
            string[] parameters = Regex.Matches(match.Groups[2].Value, @"\$([\w_]+)")
                                       .Cast<Match>()
                                       .Select(m => m.Groups[1].Value)
                                       .ToArray();
            var allParameters = (parameters.Length < 1   ? "" : "object " + string.Join(", object ", parameters))
                .Replace("$", "");
            result += "\tpublic override void " + functionName + "(" + allParameters + ")\n"
                      + "\t{\n"
                      + "\t\tbase." + functionName + "(" + string.Join(", ", parameters).Replace("$", "") + ");\n"
                      + "\t}\n";
        }
        return result;
    }
}

public class PhpieSdkRunner
{
    public void Run(string outputPath, string libsPath)
    {
        List<object> PreloadList = new List<object>()
        {
            typeof(System.Uri)
        };
        
        List<string> IgnoreList = new List<string>()
        {
            "System.Security.Cryptography",
            "System.Collections.Concurrent"
        };

        new PhpSdkGenerator(new PhpSdkSettings()
        {
            OutputPath = outputPath,
            LibsPath = libsPath,
            IsCached = true,
            IsViewMessageAboutLoaded = false,
            IsUppercaseNames = false,
            IgnoreList = IgnoreList,
            PreloadList = PreloadList,
            EventType = "\\ClrEvent" 
        }).Execute();
    }
}