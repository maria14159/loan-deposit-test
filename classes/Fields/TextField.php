<?php

class TextField extends Field
{
    public function __construct($block, $label, $name, $placeholder)
    {
        $args = ['name' => $name,
            'type' => 'text',
            'class' => 'form-control mt-2',
            'placeholder' => $placeholder];
        parent::__construct($block, "input", $label, $args);
    }
}