namespace GPL;

using Godot;

public class UiNode
{	
    public static Node Get(Node currentNode, string path)
    {
        return currentNode.GetNode(new NodePath(path));
    }
    
    public static T Get<T>(Node currentNode, string path) where T : Node
    { 
        return currentNode.GetNode<T>(new NodePath(path));
    }
}