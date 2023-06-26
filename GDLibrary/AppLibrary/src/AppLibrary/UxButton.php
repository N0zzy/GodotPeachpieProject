<?php
namespace AppLibrary;

use Godot\GD;
use System\Console;

/**
 * @compile-cs
 */
class UxButton extends UxButtonAbstract {
    public function _Ready(): void {
        GD::Print(__CLASS__);
    }
}