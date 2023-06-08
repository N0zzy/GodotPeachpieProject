<?php
namespace N0zzy\Application;

use Godot\GD;
use Godot\NodePath;
use Godot\SceneTree;
use Godot\Engine;
use Godot\Node;
use Godot\Button;
use Godot\Node2D;
use System\Exception;
use System\Boolean;


class UxWindow extends UxWindowAbstract {

    public function _Ready() : void {	
        /**$this->injectSdk(); //only built-in**/
        $a = $this->GetTree();
        GD::Print(777);
    }    

    public function _Process($delta) : void  {

    }

    protected function getButton(){

    }
    
    /** only built-in
    protected function injectSdk(){try { new \Php\Sdk\Sdk(); } catch (Exception $e) {}}
    */
}