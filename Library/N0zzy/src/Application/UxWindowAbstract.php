<?php
namespace N0zzy\Application;

use Godot\Node2D;
use Godot\GD;


abstract class UxWindowAbstract extends Node2D {
    public function _Ready() : void {}        
    public function _Process($delta) : void {}
    
    public function OnButtonPressed($a, $b, $c): void
    {
        //$this->button->Text = $name;  
        GD::Print($a);
        GD::Print($b);
        GD::Print($c);
    }
}