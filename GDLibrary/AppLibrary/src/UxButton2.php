<?php
namespace AppLibrary;

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
    protected $event;
    
    public function _Ready() : void 
    { 
        GD::Print("[DEBUG]" . __CLASS__);    
        $this->event = new UxEvent();
        $this->event->OnScope("pressed", $this, [null, "onPressed"]);
    }
    
    protected function onPressed() : void {
        $this->getTextEdit()->Text = "New Text";
    }    
  
    protected function getTextEdit(): TextEdit {
        return UElement::GetNode($this, "root.Window.Control.TextEdit", null);
    }
}