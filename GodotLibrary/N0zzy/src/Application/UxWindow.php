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

trait GetButtonPathArray {
    protected function getButton(array $paths) {
        return False;
    }
}

trait GetButtonPathString {
    protected function getButton(string $path) {
        return null;
    }
}

class UxWindow extends UxWindowAbstract {

    use GetButtonPathArray;
    use GetButtonPathString;
             
    public function _Ready() : void {	
        /**$this->injectSdk(); //only built-in**/
    }    
    /**
     * @arg int|float=>string $delta
     * @arg mixed=>string $delta
     */
    public function _Process($delta) : void  {
               
    }
    
    /** only built-in
    protected function injectSdk(){try { new \Php\Sdk\Sdk(); } catch (Exception $e) {}}
    */
}