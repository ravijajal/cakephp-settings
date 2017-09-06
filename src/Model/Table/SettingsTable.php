<?php

namespace Settings\Model\Table;

use Cake\ORM\Table;

class SettingsTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->alias('Settings');
        $this->table('settings');
        $this->addBehavior('Timestamp');
    }

    public function setting($name, $value = null, $descrption = null) {
        if ($value !== null) {
            $save = [
                'value' => $value,
                'descrption' => $descrption !== null ? $descrption : '',
            ];
            $entityClass = $this->entityClass();
            $entity = new $entityClass($save);
            $this->save($entity);
        } else {
            $entity = $this->find('all')
                    ->where([$this->alias() . '.name' => $name])
                    ->first();
        }
        return $entity->value;
    }

}
