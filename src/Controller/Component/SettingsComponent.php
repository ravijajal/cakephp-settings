<?php

namespace Settings\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Core\Exception\Exception;
use Settings\SettingsInterface;

class SettingsComponent extends Component {

    protected $_Instance = null;

    public function __construct(ComponentRegistry $collection, array $config = []) {
        parent::__construct($collection, $config);
        $className = $name = Configure::read('PluginSettings.adapter');
        if (!class_exists($className)) {
            $className = App::className('Settings.' . $name, 'Adapter');
            if (!$className) {
                throw new Exception(sprintf('Could not find {0}.', [$name]));
            }
        }
        $this->adapter($className);
    }

    public function adapter($adapter = null) {
        if ($adapter) {
            if (is_string($adapter)) {
                $adapter = new $adapter();
            }
            if (!$adapter instanceof SettingsInterface) {
                throw new Exception('SettingsComponent adapters must implement SettingsInterface');
            }
            $this->_Instance = $adapter;
            $this->_Instance->initialize($this);

            return;
        }

        return $this->_Instance;
    }

    public function setting($name, $value = null, $description = null) {
        return $this->_Instance->setting($name, $value, $description);
    }

    public function deleteSetting($name) {
        return $this->_Instance->deleteSetting($name);
    }

    public function updateValue($name, $value) {
        return $this->_Instance->updateValue($name, $value);
    }

    public function updateDescription($name, $description) {
        return $this->_Instance->updateDescription($name, $description);
    }

    public function listSettings() {
        return $this->_Instance->listSettings();
    }

}
