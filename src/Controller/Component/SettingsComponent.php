<?php


namespace Settings\Controller\Component;

use Settings\SettingsInterface;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Core\Exception\Exception;

class SettingsComponent extends Component {

    protected $_Instance = null;

    public function __construct(ComponentRegistry $collection, array $config = []) {
        parent::__construct($collection, $config);
        $className = $name = Configure::read('Settings.classname');
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

    public function setting($name, $value = null, $descrption = null) {
        return $this->_Instance->setting($name, $value, $descrption);
    }

}
