<?php 
namespace AppLibrary;

use Godot\GD;
use Godot\TextEdit;
use Godot\Node;
use Godot\ItemList;
use GLPchp\UxEvent;
use GLPchp\UElement;

/**
 * @compile-cs
 */
class UxTextEdit extends UxTextEditAbstract
{
    public function _Ready(): void {
        GD::Print("[DEBUG]" . __CLASS__); 
    
        $this->event = new UxEvent();
        $this->event->OnScope("mouse_entered", $this, [null, "onMouseEntered"]); 
        $this->event->OnScope("mouse_exited", $this, [null, "onMouseExited"]); 
    }
    
    protected function onMouseEntered(): void {
        $this->getTextEdit()->Text = "onMouseEntered2";
        $this->getItemList()->Visible = true;
        
    }

    protected function onMouseExited(): void {
        $this->getTextEdit()->Text = "onMouseExited2";
        $this->getItemList()->Visible = false;    
    }
    
    protected function getTextEdit(): TextEdit|Node {
        GD::Print("[DEBUG] " . __METHOD__); 
        return UElement::GetNode($this, "root.Window.Control.TextEditContainer.TextEdit", null);
    }
    
    
    protected function getItemList(): ItemList|Node {
        GD::Print("[DEBUG] " . __METHOD__); 
        return UElement::GetNode($this, "root.Window.Control.TextEditContainer.ItemList", null);
    }
}