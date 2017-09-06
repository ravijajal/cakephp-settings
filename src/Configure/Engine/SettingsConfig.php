<?php

namespace Settings\Configure\Engine;

use Cake\Core\Configure\ConfigEngineInterface;
use Cake\Core\Exception\Exception;
use Settings\Settings;

class SettingsConfig implements ConfigEngineInterface {

    public function __construct($path = null) {
        if ($path === null) {
            $path = CONFIG;
        }
        $this->_path = $path;
    }

    public function read($key) {

        try {
            $settings = new Settings;
            $settings->startup();
            $return[$key] = $settings->listSettings();
            if (is_array($return)) {
                return $return;
            }
        } catch (Exception $e) {
            return [];
        }
    }

    public function dump($key, array $data) {
        return true;
    }

}
