<?php
namespace GodotPeachpie\Gui;

use Godot\Button; 
use Godot\GD; 

class UxButtonIdTest extends Button {
    /**
     * @signal
     */
    public function _on_pressed() : void {
        GD::Print("UxButtonIdTest pressed!!!");
    }
}