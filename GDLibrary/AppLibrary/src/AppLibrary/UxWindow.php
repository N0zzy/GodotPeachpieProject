<?php
namespace AppLibrary;

use Godot\GD;
use Godot\NodePath;
use Godot\PopupMenu;
use Godot\SceneTree;
use Godot\Engine;
use Godot\Node;
use Godot\Button;
use Godot\Node2D;
use Godot\SignalName;
use Godot\Vector2;
use Pchp\Core\CallableCallback;
use System\Exception;
use System\Boolean;
use Godot\Signal;
use Godot\StringName;
use GLPchp\UxScene;
use GLPchp\UxEvent;
use GLPchp\UFunc;
use GLPchp\UiStyle;


/**
 * @compile-cs
 */
class UxWindow extends UxWindowAbstract {
    protected UxScene $scene;
    protected Button $button;
    protected UxEvent $event;

    public function _Ready() : void {    
        //$this->scene = new UxScene($this);
        //$this->event = new UxEvent();
        //$this->button = $this->getButton();
        //$this->button->Text = "New Button";   
        //$this->exampleEvents_buttonPressed_3();  
    }    

    /**
     * @param string $path
     * @return Button|Node
     */
    protected function getButton(): Button|Node {
        return $this->scene->GetNode<Button>("Control.Button");
    }
    
    protected function exampleEvents_buttonPressed_1(): void {
        $name = __METHOD__;    
        $this->event->On("pressed", $this->button, function() use ($name){
            $this->button->Text = $name;
        }); 
    }

    /**
     * @return void
     */
    protected function exampleEvents_buttonPressed_2(): void {
        $name = __METHOD__; 
        $this->event->OnListener("pressed", $this->button, [$this, "OnButtonPressed"], [1, 2, $name]);
    }
    
    protected function exampleEvents_buttonPressed_3(): void
    {
        $name = __METHOD__;            
        $this->button->Connect(
            new StringName("pressed"),
            UFunc::Add(function() use ($name){
                $this->button->Text = $name;
                $this->button->Position = UiStyle::Position(100,200);/*Vector2*/
                $this->button->Scale = UiStyle::Scale(0.8,0.8);/*Vector2*/   
            })
        );
    }
}