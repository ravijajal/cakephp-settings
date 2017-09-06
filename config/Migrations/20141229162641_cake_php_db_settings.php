<?php

use Phinx\Migration\AbstractMigration;

class CakePhpDbAcl extends AbstractMigration {

    public function change() {
        $table = $this->table('settings');
        $table
                ->addColumn('name', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => false,
                ])
                ->addColumn('value', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => false,
                ])
                ->addColumn('description', 'text', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('created', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('modified', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->create();
    }

    public function up() {
        
    }

    public function down() {
        
    }

}
