<?php

namespace App\Traits;

trait Scaffolded {

    // === Scaffolding schema, options, sorting etc ==========================

    public function getScaffoldOption($optionName) {
        $model = $this;
        $modelName = $this->getModelName($model);

        if (isset($modelName::$scaffoldOptions) && array_get($modelName::$scaffoldOptions, $optionName) !== null) {
            return array_get($modelName::$scaffoldOptions, $optionName);
        } else {
            return null;
        }
    }

    public function getScaffoldSchema() {
        $model = $this;

        $class = get_class($model);
        $modelName = $this->getModelName($model);

        if (isset($modelName::$scaffoldFields)) {
            return $class::$scaffoldFields;
        } else {
            return [];
        }
    }

    // === Public ============================================================

    /**
     * Transforms raw array of model attributes so they can be displayed easily.
     * Most notably it populates select options.
     */
    public function getScaffoldedObjects(array $rawObjects, $allowEmptyOption = false) {
        if (empty($rawObjects)) {
            return [];
        }

        $scaffoldedObjects = [];
        $selectOptionsByModels = $this->getSelectOptionsByModels($rawObjects[0], $allowEmptyOption);
        $schema = $this->getScaffoldSchema();

        // =========================================================================

        foreach ($rawObjects as $rawObject) {
            $scaffoldedObject = [];

            foreach ($schema as $fieldName => $fieldDetails) {

                // Look for select fields
                if ($this->isFieldSelect($fieldDetails)) {
                    $valuesModelName = $fieldDetails['values-from-model']['model'];
                    $selectArray = $selectOptionsByModels[$valuesModelName];
                    $scaffoldedObject[$fieldName] = $selectArray;
                }

                // Normal field
                else {
                    $scaffoldedObject[$fieldName] = @$rawObject[$fieldName];
                }
            }

            $scaffoldedObjects[] = $scaffoldedObject;
        }

        // =========================================================================

        return $scaffoldedObjects;
    }

    public function isFieldSelect($fieldArray) {
        return isset($fieldArray['type']) && $fieldArray['type'] === 'select';
    }

    // === Private ===========================================================

    private function getModelName($model) {
        return "App\\" . class_basename($model);
    }

    // === Aux ===============================================================

    private function getSelectOptionsByModels($rawObject, $allowEmptyOption) {
        $selectOptions = [];

        // =========================================================================
//        $modelName = $this->getModelName($this);
        $schema = $this->getScaffoldSchema();
        foreach ($schema as $fieldName => $fieldDetails) {

            // Look for select fields
            if ($this->isFieldSelect($fieldDetails)) {
                $valuesConfig = $fieldDetails['values-from-model'];
                $valuesModelName = $valuesConfig['model'];
                $valuesModelFieldOption = $valuesConfig['field-option'];
                $valuesModelFieldValue = $valuesConfig['field-value'];
                if (!isset($selectOptions[$valuesModelName])) {
                    $values = $valuesModelName::all()
                            ->pluck($valuesModelFieldOption, $valuesModelFieldValue)->toArray();

                    asort($values);

                    if ($allowEmptyOption) {
                        $values = array_merge(["" => ""], $values);
                    }

                    $selectOptions[$valuesModelName] = $values;
                }
            }
        }

        // =========================================================================

        return $selectOptions;
    }

}
