# Godot project (PeachPie)

An example Godot project using PeachPie/php.


# vscode launch (php script)
```json
{
       "version": "0.2.0",
       "configurations": [
              {
                     "name": "Player (Godot)",
                     "type": "php",
                     "request": "launch",
                     //path to php executable
                     "program": "E:/Godot4/Godot/GodotPeachpieProject/GodotLibrary/run",
                     //["projectName", "aplicationName"]
                     "args": ["GodotApplication", "Godot_v4.0.3-stable_mono_win64.exe"],
                     "cwd": "${fileDirname}",
                     "externalConsole": false,
                     "port": 9003
              }

       ]
}
```