<?php

namespace Settings;

use Cake\Controller\Component;

interface SettingsInterface {

    public function setting($name, $value = null, $descrption = null);

    public function initialize(Component $component);
}
