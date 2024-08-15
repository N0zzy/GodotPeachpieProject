<?php
namespace GodotPeachpie\Gui;

use Godot\Button;
use Godot\Node2D;
use Godot\TextEdit;
use Godot\GD; 
use Godot\Node;
use Godot\NodePath;
use Godot\SceneTree;
use GPL\UlNode;
use GPL\UlScene;
use GPL\NodeLoad;

class UxButtonIdTest extends Button 
{
    /**
     * @var string
     */
    private string $tscn = "res://scene/main.tscn";
    /**
     * @var TextEdit|null
     */
    private ?TextEdit $textEdit1 = null;
    /**
     * @var TextEdit|null
     */
    private ?TextEdit $textEdit2 = null;
    /**
     * @var Node2D|null
     */
    private  $sceneNode2d = null;
    
    /**
     * @return void
     */
    public function makeTextEdit() : void
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

        //example Change current scene
        //$this->changeScene();
    }
    
    /**
     * example Change current scene
     * @return void 
     */
    private function changeScene() : void 
    {
        $name = "Main";
        UlScene::Load("Main", $this->tscn);
        $scene = UlScene::Change($this, $name);
        $node = UlNode::Get($scene, "/root/Main/TextEdit");
        $node->Text = "Change scene!!!";
    }
}