<?php

namespace Settings\Adapter;

use Settings\SettingsInterface;
use Cake\Controller\Component;
use Cake\Core\App;
use Cake\ORM\TableRegistry;

class DbSettings implements SettingsInterface {

    public function __construct() {
        $config = [];
        if (!TableRegistry::exists('Settings')) {
            $config = ['className' => App::className('Settings.SettingsTable', 'Model/Table')];
        }
        $this->Settings = TableRegistry::get('Settings', $config);
    }

    public function initialize(Component $component) {
        $component->Setting = $this->Settings;
    }

    public function setting($name, $value = null, $description = null) {
        return $this->Settings->setting($name, $value, $description);
    }

    public function updateValue($name, $value) {
        return $this->Settings->updateValue($name, $value);
    }

    public function updateDescription($name, $description) {
        return $this->Settings->updateDescription($name, $description);
    }

    public function deleteSetting($name) {
        return $this->Settings->deleteSetting($name);
    }

    public function listSettings() {
        return $this->Settings->listSettings();
    }

}
