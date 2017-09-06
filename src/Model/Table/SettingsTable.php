<?php

namespace Settings\Model\Table;

use Cake\ORM\Table;
use Cake\Utility\Inflector;

class SettingsTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->alias('Settings');
        $this->table('settings');
        $this->addBehavior('Timestamp');
    }

    public function setting($name, $value = null, $description = null) {
        $name = $this->convertName($name);
        $entity = $this->find('all')
                ->where([$this->alias() . '.name' => $name])
                ->first();
        if ($value !== null) {
            $save = [
                'name' => $name,
                'value' => $value,
            ];
            if ($description !== null) {
                $save['description'] = $description;
            }
            if (empty($entity)) {
                $entity = $this->newEntity($save);
            } else {
                $entity = $this->patchEntity($entity, $save);
            }
            $this->save($entity);
        }
        return isset($entity->value) ? $entity->value : '';
    }

    public function updateValue($name, $value) {
        $name = $this->convertName($name);
        $entity = $this->find('all')
                ->where([$this->alias() . '.name' => $name])
                ->first();
        if (!empty($entity)) {
            $save = [
                'value' => $value,
            ];
            $entity = $this->patchEntity($entity, $save);
            $this->save($entity);
        }
    }

    public function updateDescription($name, $description) {
        $name = $this->convertName($name);
        $entity = $this->find('all')
                ->where([$this->alias() . '.name' => $name])
                ->first();
        if (!empty($entity)) {
            $save = [
                'description' => $description,
            ];
            $entity = $this->patchEntity($entity, $save);
            $this->save($entity);
        }
    }

    public function deleteSetting($name) {
        $name = $this->convertName($name);
        $entity = $this->find('all')
                ->where([$this->alias() . '.name' => $name])
                ->first();
        if (!empty($entity)) {
            $this->delete($entity);
        }
    }

    public function listSettings() {
        $list = $this->find('list', [
                    'keyField' => 'name',
                    'valueField' => 'value'
                ])->toArray();
        return $list;
    }

    private function convertName($name) {
        return strtoupper(Inflector::underscore(Inflector::camelize(strtolower($name))));
    }

}
