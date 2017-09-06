<?php

namespace Settings;

use Cake\Controller\Component;

interface SettingsInterface {

    public function initialize(Component $component);

    public function setting($name, $value = null, $description = null);

    public function updateValue($name, $value);

    public function updateDescription($name, $description);

    public function deleteSetting($name);
}
