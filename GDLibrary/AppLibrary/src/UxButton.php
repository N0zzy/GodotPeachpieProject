<?php
namespace AppLibrary;

use Godot\GD;

/**
 * @compile-cs
 */
class UxButton extends UxButtonAbstract {
    public function _Ready(): void {
        GD::Print(__CLASS__);
    }
}