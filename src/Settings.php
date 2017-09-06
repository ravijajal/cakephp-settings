<?php

/**
 * Acl Extras.
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2008-2013, Mark Story.
 * @link http://mark-story.com
 * @author Mark Story <mark@mark-story.com>
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */

namespace Settings;

use Settings\Controller\Component\SettingsComponent;
use Cake\Controller\ComponentRegistry;
use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Network\Request;

/**
 * Provides features for additional ACL operations.
 * Can be used in either a CLI or Web context.
 */
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
     * Start up And load Acl Component / Aco model
     *
     * @param \Cake\Controller\Controller $controller Controller instance
     * @return void
     */
    public function startup($controller = null) {
        if (!$controller) {
            $controller = new Controller(new Request());
        }
        $registry = new ComponentRegistry();
        $this->Settings = new SettingsComponent($registry, Configure::read('Settings'));
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

    public function setting($params = []) {
        $this->out(print_r($params, true));
    }

}
