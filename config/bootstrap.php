<?php

use Cake\Core\Configure;

//Adapter Classname
if (!Configure::read('PluginSettings.classname')) {
    Configure::write('PluginSettings.classname', 'DbSettings');
}
//Adapter Class Database
if (!Configure::read('PluginSettings.database')) {
    Configure::write('PluginSettings.database', 'default');
}
//Adapter Class Database table
if (!Configure::read('PluginSettings.databaseTable')) {
    Configure::write('PluginSettings.databaseTable', 'settings');
}
//Adapter Class Database table Alias
if (!Configure::read('PluginSettings.databaseTableAlias')) {
    Configure::write('PluginSettings.databaseTableAlias', 'Settings');
}
