<?php
namespace GodotPeachpie\Scene;

use Godot\Node2D; 
use Godot\GD; 

class UxMain extends Node2D
{
    /**
     * @return void
     */
    public function _Ready() : void {
        GD::Print("Привет из UxMain! Все хорошо! Ошибок нет!");
    }
}