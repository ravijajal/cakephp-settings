<?php

namespace Settings\Shell;

use Settings\Settings;
use Cake\Console\ConsoleIo;
use Cake\Console\Shell;

class SettingsShell extends Shell {

    /**
     * Contains arguments parsed from the command line.
     *
     * @var array
     */
    public $args;

    /**
     * Settings instance
     *
     * @var \Settings\Settings
     */
    public $Settings;

    /**
     * Constructor
     *
     * @param \Cake\Console\ConsoleIo $io An io instance.
     */
    public function __construct(ConsoleIo $io = null) {
        parent::__construct($io);
        $this->Settings = new Settings();
    }

    /**
     * Start up And load Settings Component
     *
     * @return void
     */
    public function startup() {
        parent::startup();
        $this->Settings->startup();
        $this->Settings->Shell = $this;

        if ($this->command) {
            try {
                \Cake\ORM\TableRegistry::get('Aros')->schema();
            } catch (\Cake\Database\Exception $e) {
                $this->out(__d('cake_settings', 'Settings database tables not found. To create them, run:'));
                $this->out();
                $this->out('  bin/cake Migrations.migrations migrate -p Settings');
                $this->out();
                $this->_stop();
            }
        }
    }

    /**
     * Sync the ACO table
     *
     * @return void
     */
    public function setting() {
        $args = $this->args;
        $countArgs = count($args);
        $name = '';
        $value = null;
        $description = null;
        if ($countArgs == 1) {
            list($name) = $args;
            $value = null;
            $description = null;
        } elseif ($countArgs == 2) {
            list($name, $value) = $args;
            $description = null;
        } elseif ($countArgs == 3) {
            list($name, $value, $description) = $args;
        }
        $this->out($this->Settings->setting($name, $value, $description));
    }

    public function updateValue() {
        $args = $this->args;
        list($name, $value) = $args;
        $this->Settings->updateValue($name, $value);
        $this->out('Setting value updated successfully');
    }

    public function updateDescription() {
        $args = $this->args;
        list($name, $description) = $args;
        $this->Settings->updateDescription($name, $description);
        $this->out('Setting description updated successfully');
    }

    public function deleteSetting() {
        $args = $this->args;
        list($name) = $args;
        $this->Settings->deleteSetting($name);
        $this->out('Setting deleted successfully');
    }

    public function listSettings() {
        $list = $this->Settings->listSettings();
        $this->hr();
        $this->out('List of All Settings');
        $this->hr();
        if (count($list) > 0) {
            foreach ($list as $name => $value) {
                $this->out($name . ' ==> ' . $value);
            }
        } else {
            $this->out('No Settings found.');
        }
        $this->hr();
    }

    /**
     * Get the option parser for this shell.
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser() {
        $parser = parent::getOptionParser();

        $parser->description(__("Better manage, and easily synchronize you application's Settings"))
                ->addSubcommand('setting', [
                    'help' => __('Set/Get a setting based on name'),
                    'parser' => [
                        'arguments' => [
                            'name' => [
                                'required' => true,
                                'help' => __('The name of setting'),
                            ],
                            'value' => [
                                'required' => false,
                                'help' => __('The value of setting. If value provided it will be inserted or updated.'),
                            ],
                            'description' => [
                                'required' => false,
                                'help' => __('The description of setting'),
                            ]
                        ]
                    ]
                ])
                ->addSubcommand('delete_setting', [
                    'help' => __('Delete a setting based on name'),
                    'parser' => [
                        'arguments' => [
                            'name' => [
                                'required' => true,
                                'help' => __('The name of setting'),
                            ]
                        ]
                    ]
                ])
                ->addSubcommand('update_value', [
                    'help' => __('Set value based on name'),
                    'parser' => [
                        'arguments' => [
                            'name' => [
                                'required' => true,
                                'help' => __('The name of setting'),
                            ],
                            'value' => [
                                'required' => true,
                                'help' => __('The value of setting'),
                            ]
                        ]
                    ]
                ])
                ->addSubcommand('update_description', [
                    'help' => __('Set description based on name'),
                    'parser' => [
                        'arguments' => [
                            'name' => [
                                'required' => true,
                                'help' => __('The name of setting'),
                            ],
                            'description' => [
                                'required' => true,
                                'help' => __('The description of setting'),
                            ]
                        ]
                    ]
                ])
                ->addSubcommand('list_settings', [
                    'help' => __('List All Settings.'),
        ]);

        return $parser;
    }

}
