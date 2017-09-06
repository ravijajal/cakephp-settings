<?php

namespace Settings\Adapter;

use Settings\SettingsInterface;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class DbAcl implements SettingsInterface {

    public function __construct() {
        $this->Settings = TableRegistry::get('Settings');
    }

    public function initialize(Component $component) {
        $component->Setting = $this->Settings;
    }

    public function setting($name, $value = null, $descrption = null) {
        return $this->Settings->setting($name, $value, $descrption);
    }

}
