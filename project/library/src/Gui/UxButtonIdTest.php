<?php
namespace GodotPeachpie\Gui;

use Godot\Button; 
use Godot\TextEdit; 
use Godot\GD; 
use GPL\UlNode;

class UxButtonIdTest extends Button 
{
    private ?TextEdit $textEdit1 = null;
    private ?TextEdit $textEdit2 = null;
    
    public function makeTextEdit() 
    {
        //example 1
        $this->textEdit1 ??= UlNode::Get($this, "/root/Main/TextEdit");
        //example 2
        $this->textEdit2 ??= UlNode::Get($this, "../TextEdit");     
    }
    
    /**
     * @signal
     */
    public function _on_pressed() : void 
    {   
        $this->makeTextEdit(); 
   
        GD::Print("UxButtonIdTest pressed!!!");
        GD::Print($this->getPath());  
        
        $this->textEdit1->Text = "UxButtonIdTest 1 pressed!!!";
        $this->textEdit2->Text = "UxButtonIdTest 2 pressed!!!";
    }
}