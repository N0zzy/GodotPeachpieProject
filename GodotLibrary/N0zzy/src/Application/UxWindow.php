<?php
namespace N0zzy\Application;

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
use GLPchp\CallableFunc;
use GLPchp\Extensions\UxButton;
use Pchp\Core\PhpValueConverter;

class UxWindow extends UxWindowAbstract {
    protected SceneTree $sceneTree;
    protected Button $button;
    protected CallableFunc $call;

    public function _Ready() : void {
        $this->sceneTree = $this->GetTree();
        $this->call = new CallableFunc();
        $this->button = $this->getButton("./Control/Button");
        $this->button->Text = "New Button";
        $this->exampleEvents_buttonPressed_2();  
    }    

    public function _Process($delta) : void  {

    }

    /**
     * @param string $path
     * @return Button|Node
     */
    protected function getButton(string $path): Button|Node {
        $nodePath = new NodePath($path);
        return $this->sceneTree->CurrentScene->GetNode($nodePath);
    }
    
    protected function exampleEvents_buttonPressed_1(): void {
        $name = __METHOD__;    
        $this->call->On("pressed", $this->button, function() use ($name){
            $this->button->Text = $name;
        }); 
    }

    /**
     * @return void
     */
    protected function exampleEvents_buttonPressed_2(): void {
        $name = __METHOD__; 
        $this->call->OnListener("pressed", $this->button, [$this, "OnButtonPressed"], [$name]); 
    }
    
    protected function exampleEvents_buttonPressed_3(): void
    {
        $name = __METHOD__;            
        $this->button->Connect(
            new StringName("pressed"),
            CallableFunc::Get(function() use ($name){
                $this->button->Text = $name;
                $this->button->Position = new Vector2(100,100);
            })
        );
    }
}