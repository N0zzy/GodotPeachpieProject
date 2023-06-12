<?php
namespace N0zzy\Application;

use Godot\Node2D;
use Godot\GD;


abstract class UxWindowAbstract extends Node2D {
    public function _Ready() : void {}        
    public function _Process($delta) : void {}
    
    public function OnButtonPressed($name): void
    {
        //$this->button->Text = $name->ToString();  
        GD::Print($name)     ;
    }
}