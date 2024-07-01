using System.Collections.Generic;
using System.IO;

namespace Compiler;

using System;
using PhpieSdk.Library;

public class Compiler: CompilerHelper
{

    private static string OutPath = "project/";
    
    private static string LibsPath = "support/utils/compiler/bin/Debug/net7.0";
    

    public static void Main( string[] args )
    {
        ProjectPath = GetProjectPath();
        ApplicationPath = $"{ProjectPath}project/application/";
        LibraryPath = $"{ProjectPath}project/library/";
        GenerateUxScenes();
        
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
    
    protected static void GenerateUxScenes()
    {
        string[] uxScenes = Directory.GetFiles(
            LibraryPath + "src/Scene", "Ux*.php", SearchOption.AllDirectories
        );
        
        foreach (var scene in uxScenes)
        {
            var p = scene.Split("Scene")[1];
            var d = Path.GetDirectoryName(p)!.Substring(1);
            d = d.Length > 0 ? $"/{d}" : d;
            var s = p
                .Replace("\\", ".")
                .Replace("/", ".")
                .Replace("Ux", "")
                .Replace(".php", "");
            var ns = RemoveLastSegment(s);
            var nm = GetLastSegment(s);

            var dir = ApplicationPath + $"scene{d}/";
            if( !Directory.Exists( dir )){
                Directory.CreateDirectory( dir );
            }
            File.WriteAllText($"{dir}{nm}.cs", 
                $"using GodotPeachpie.Scene{ns};\n" +
                $"using Godot;\n" +
                $"public partial class {nm} : Ux{nm}\n" +  
                "{\n"
                + "\tpublic override void _Ready()\n"
                + "\t{\n"
                + "\t\tbase._Ready();\n"
                + "\t}\n"
                +"}"
            );
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