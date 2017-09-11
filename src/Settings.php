<?php

namespace Settings;

use Cake\Controller\ComponentRegistry;
use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Network\Request;
use Settings\Controller\Component\SettingsComponent;

class Settings {

    /**
     * Contains instance of AclComponent
     *
     * @var \Settings\Controller\Component\SettingsComponent
     */
    public $Settings;

    /**
     * Contains arguments parsed from the command line.
     *
     * @var array
     */
    public $args;

    /**
     * Contains database source to use
     *
     * @var string
     */
    public $dataSource = 'default';

    /**
     * Start up And load Settings Component 
     *
     * @param \Cake\Controller\Controller $controller Controller instance
     * @return void
     */
    public function startup($controller = null) {
        if (!$controller) {
            $controller = new Controller(new Request());
        }
        $registry = new ComponentRegistry();
        $this->Settings = new SettingsComponent($registry, Configure::read('PluginSettings'));
        $this->controller = $controller;
    }

    /**
     * Output a message.
     *
     * Will either use shell->out, or controller->Flash->success()
     *
     * @param string $msg The message to output.
     * @return void
     */
    public function out($msg) {
        if (!empty($this->controller->Flash)) {
            $this->controller->Flash->success($msg);
        } else {
            $this->Shell->out($msg);
        }
    }

    /**
     * Output an error message.
     *
     * Will either use shell->err, or controller->Flash->error()
     *
     * @param string $msg The message to output.
     * @return void
     */
    public function err($msg) {
        if (!empty($this->controller->Flash)) {
            $this->controller->Flash->error($msg);
        } else {
            $this->Shell->err($msg);
        }
    }

    public function setting($name, $value, $description) {
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
