<?php

use Cake\Core\Configure;

if (!Configure::read('Settings.classname')) {
    Configure::write('Settings.classname', 'DbSettings');
}
if (!Configure::read('Settings.database')) {
    Configure::write('Settings.database', 'default');
}
