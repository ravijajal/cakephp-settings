<?php

use Cake\Core\Configure;

if (!Configure::read('PluginSettings.classname')) {
    Configure::write('PluginSettings.classname', 'DbSettings');
}
if (!Configure::read('PluginSettings.database')) {
    Configure::write('PluginSettings.database', 'default');
}
