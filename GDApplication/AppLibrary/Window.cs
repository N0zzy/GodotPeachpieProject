namespace AppLibrary;

using Godot;
using System;

class Window : UxWindow {

	public override void _Ready() {  
		base._Ready(); 
		
		Console.WriteLine("Hello World!");
	}

}