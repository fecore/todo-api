<?php


namespace App\System;


use League\Route\Http\Exception\BadRequestException;

class ValidateField
{
    protected $value;
    protected $field_name;
    protected $errors = [];

    public function __construct($value, $field_name)
    {
        $this->value = trim($value);
        $this->field_name = trim($field_name);
    }

    public function required()
    {
        if (empty($this->value) || $this->value == "") {
            array_push($this->errors, "Field '{$this->field_name}' is required!");
        }
        return $this;
    }

    public function max ($max_length)
    {
        if (strlen ($this->value) > $max_length) {
            array_push($this->errors, "Field '{$this->field_name}' must be maximum $max_length characters long");
        }
        return $this;
    }

    public function boolean ($max_length)
    {
        if (!empty($this->value))
        {
            // Because it's string
            if ($this->value == 1 || $this->value === 0) {

            } else {
                array_push($this->errors, "Field '{$this->field_name}' is not boolean!");
            }
        } else {
            $this->value = 0;
        }
        return $this;
    }

    function getValue ()
    {
        return $this->value;
    }

    function validate ()
    {
        return $this->errors;
    }
}