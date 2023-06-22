<?php
namespace N0zzy\Application;

use Godot\GD;
use GLPchp\UxEvent;
use GLPchp\UxScene;
use GLPchp\UElement;
use Godot\TextEdit;

/**
 * php class UxButton2
 * @compile-cs
 */
class UxButton2 extends UxButton2Abstract 
{
    private $event;
    
    public function _Ready() : void 
    { 
        $this->event = new UxEvent();
        $this->event->OnListener("pressed", $this, [null, "onPressed"]);
    }
    
    protected function onPressed() : void {
        $this->getTextEdit()->Text = "New Text";
    }    
  
    protected function getTextEdit(): TextEdit {
        return UElement::GetNode($this, "root.Window.Control.TextEdit", null);
    }
}