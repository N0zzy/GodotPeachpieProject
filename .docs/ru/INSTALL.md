### Установка и настройка
---
* [скачать](https://dotnet.microsoft.com/en-us/download/dotnet/7.0) и установить .NET Core 7
* [скачать](https://downloads.tuxfamily.org/godotengine/4.1/) последнюю версию редактора Godot 4 (```на момент написания версия 4.1-beta```) 
* распаковать в любую директорию 
* выполнить клонирование проекта <br> *`git clone https://github.com/N0zzy/GodotPeachpieProject.git`*

> ![Alt text](../.images/image.png) <br>
> при желании можете переименовать директорию в `GDProject`

<br>

### VSCode
---
* установить [VSCode](https://code.visualstudio.com/) 
* установить плагины для VSCode
     - .NET Install Tool for Extension Authors<br>
      ![.NET Install Tool for Extension Authors](../.images/image2.png)
     - C# Tools for Godot<br>
      ![C# Tools for Godot](../.images/image3.png)
     - csproj Extensions | VS Code .csproj <br>
      ![csproj Extensions](../.images/image4.png)<br>
      ![VS Code .csproj](../.images/image5.png)
     - vscode-solution-explorer<br>
      ![vscode-solution-explorer](../.images/image6.png)
     - PHP | PHP Intelephense<br>
       ![PHP](../.images/image7.png)<br>
       ![PHP Intelephense](../.images/image8.png)
     - любые расширения Nuget, с которыми вам будет удобно работать
* в файле `GDProject.code-workspace` найдите и проверьте опцию `"omnisharp.sdkPath": "/Program Files/dotnet/sdk/7.0.304"` (если ее не будет добавь согласно примеру)