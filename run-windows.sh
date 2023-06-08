#!/bin/sh
current_directory=$PWD
parent_directory=$(dirname "$current_directory")
application="Godot_v4.0.3-stable_mono_win64.exe"
project="GodotApplication"
echo $parent_directory/$application --path $current_directory/$project
start $parent_directory/$application --path $current_directory/$project