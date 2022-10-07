<?php

class Form
{
    protected $fields;

    public function __construct(array $fields)
    {
        foreach ($fields as $key => $field) {
            $fields[$key] = $field->getFields();
        }

        $this->fields = $fields;
    }

    public function render() {
        $fields = $this->fields;
        include 'templates/form.php';
    }


}