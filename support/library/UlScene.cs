using System.Collections;
using System.Collections.Generic;
using Pchp.Core;
using Godot;

namespace GPL;

public class UlScene
{
    private static readonly Dictionary<string, ArrayList> _scenes = new ();

    public static void Load(PhpString name, PhpString path)
    {
        Load(name.ToString(), path.ToString());
    }
    
    public static void Load(string name, string path)
    {
        var _name = NameLower(name);
        var _path = path;
        if (_scenes.ContainsKey(_name))
        {
            return;
        }
        var _node = ResourceLoader.Load<PackedScene>(path).Instantiate();
        var _scene = new ArrayList()
        {
            _path, 
            _node
        };
        if (_scenes.ContainsKey(_name))
        {
            _scenes[_name] = _scene;
        }
        else
        {
            _scenes.Add(_name, _scene);
        }
    }
    
    public static void Preload(PhpArray resources)
    {
        foreach (var resource in resources)
        {
            var name = resource.Key.ToString().ToLower();
            var _path = resource.Value.ToString();
            var _node = ResourceLoader.Load<PackedScene>(_path).Instantiate();
            var _scene = new ArrayList()
            {
                _path, 
                _node
            };
            if (_scenes.ContainsKey(name))
            {
                _scenes[name] = _scene;
            }
            else
            {
                _scenes.Add(name, _scene);
            }
        }
    }
    
    public static Node Change(Node currentNode, PhpString name)
    {
        var n = _scenes[NameLower(name)][1] as Node;
        var r = currentNode.GetTree().Root;
        foreach (var _child in r.GetChildren())
        {
            r.RemoveChild(_child);
        }
        r.AddChild(n);
        return n; 
    }

    public static Node Get(string name)
    {
        return _scenes[NameLower(name)][1] as Node;
    }
    
    public static string GetPath(string name)
    {
        return _scenes[NameLower(name)][0] as string;
    }
    
    public static bool Clear(string name = null)
    {
        if (name == null) _scenes.Clear();
        else _scenes!.Remove(NameLower(name));
        return _scenes.Count <= 0;
    }

    private static string NameLower(PhpString name)
    {
        return name.ToString().ToLower();
    }
    
    private static string NameLower(string name)
    {
        return name.ToLower();
    }
}