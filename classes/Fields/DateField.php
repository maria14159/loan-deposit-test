<?php

class DateField extends Field
{
    public function __construct($block, $label, $name)
    {
        $args = ['name' => $name,
            'type' => 'date',
            'class' => 'form-control mt-2'];
        parent::__construct($block, "input", $label, $args);
    }
}