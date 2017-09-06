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
        $this->Settings->setting($this->params);
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
                            ]
                        ]
                    ]
        ]);

        return $parser;
    }

}
