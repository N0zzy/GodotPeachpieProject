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
use Pchp\Core\CallableCallback;
use System\Exception;
use System\Boolean;
use Godot\Signal;
use Godot\StringName;
use GLPchp\CallableFunc;

class UxWindow extends UxWindowAbstract {
    protected $sceneTree;
    protected $button;
    protected $call = null;

    public function _Ready() : void {
        $this->sceneTree = $this->GetTree();
        $this->call = new CallableFunc();
        $this->button = $this->getButton("./Control/Button");
        $this->button->Text = "New Button";
        $this->exampleEvents_buttonPressed_3();
    }    

    public function _Process($delta) : void  {

    }

    /**
     * @param string $path
     * @return Button|Node
     */
    protected function getButton(string $path): Button|Node {
        $nodePath = new NodePath($path);
        return $this->sceneTree->CurrentScene->GetNode<Button>($nodePath);
    }
    
    protected function exampleEvents_buttonPressed_1() {
        $this->call->On("pressed", $this->button, function(){
            $this->button->Text = __METHOD__;
        }); 
    }
    
    protected function exampleEvents_buttonPressed_2() {
        $this->call->OnListener("pressed", $this->button, [$this, "OnButtonPressed"]); 
    }
    
    protected function exampleEvents_buttonPressed_3() {
        $a = __METHOD__;            
        $this->button->Connect(new StringName("pressed"), CallableFunc::Get(function() use ($a){
            $this->button->Text = $a;
        }));
    }
}