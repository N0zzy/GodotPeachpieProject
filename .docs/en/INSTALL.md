### Установка и настройка
---
* [download](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) and install .NET Core 7
* [download](https://downloads.tuxfamily.org/godotengine/4.1/) latest version of Godot 4 editor (```at the time of writing version 4.1-beta```) 
* unpack to any directory 
* clone the project (as mentioned below)<br>
```
git clone https://github.com/N0zzy/GodotPeachpieProject.git
``` 
> ![Alt text](../.images/image.png) <br>
> if you want you can rename the directory to `GDProject`

<br>

### VSCode
---
* install [VSCode](https://code.visualstudio.com/) 
* install plugins for VSCode
     - ***.NET Install Tool for Extension Authors***<br>
      ![.NET Install Tool for Extension Authors](../.images/image2.png)
     - ***.C# Tools for Godot***.<br>
      ![C# Tools for Godot](../.images/image3.png)
     - ***.csproj Extensions | VS Code .csproj***. <br>
      ![csproj Extensions](../.images/image4.png)<br>
      ![VS Code .csproj](../.images/image5.png)
     - ***.vscode-solution-explorer***.<br>
      ![vscode-solution-explorer](../.images/image6.png)
     - ***.PHP | PHP Intelephense***.<br>
       ![PHP](../.images/image7.png)<br>
       ![PHP Intelephense](../.images/image8.png)
     - any Nuget extensions you feel comfortable working with

<br>

### VSCode (additional settings)
---
* in the file `GDProject.code-workspace` find and check the option<br> 
``` 
"omnisharp.sdkPath": "/Program Files/dotnet/sdk/7.0.304"
```
`if there is no option, add as in the example`
* open the file
```
/.vscode/launch.json
```
> look for the `"executable file" option: "../application_name.exe"`. change the values to match your current project...
* open the file 
```
/.vscode/tasks.json
```` 
> look for the option `"command": "../application_name.exe"`. change the values to match your current project...

<br>  

### VSCode (project start and debug)

![run](../.images/image9.png) 

if the installation of all necessary extensions is done correctly, including settings, the editor will provide several options for launching applications and utilities
