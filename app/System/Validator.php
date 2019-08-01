<?php


namespace App\System;


class Validator
{

    protected $rules = [];

    protected $errors = [];

    protected $values = [];

    public function __construct(array $rules)
    {
        $this->rules = $rules;

        $this->validate();
    }

    public function validate()
    {
        // Put method & delete support
        if ($_SERVER['REQUEST_METHOD'] == 'PUT')
        {
            parse_str(file_get_contents("php://input"), $_PUT);

            foreach ($_PUT as $key => $value)
            {
                unset($_PUT[$key]);

                $_PUT[str_replace('amp;', '', $key)] = $value;
            }

            $_REQUEST = array_merge($_REQUEST, $_PUT);
        }

        // Loop each field
        foreach ($this->rules as $fieldName => $rule)
        {
            // Create ValidateField instance with
            // Value and FieldName




            $validateField = new ValidateField($_POST[$fieldName] ?? $_REQUEST[$fieldName], $fieldName);

            // Loop each rule
            foreach ($rule as $ruleName => $ruleValue)
            {
                $validateField->$ruleName($ruleValue);
            }


            // Only if not empty
            if (!empty($validateField->validate()))
            {
                $this->errors[$fieldName] =  $validateField->validate();
            }

            $this->values[$fieldName] =  $validateField->getValue();

        }
        // Validation failed
        // return false
        if(!empty($this->getErrors())) {
            return false;
        }

        return true;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getValues()
    {
        return $this->values;
    }
}