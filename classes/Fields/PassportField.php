<?php

class PassportField extends Field
{
    public function __construct()
    {
        $args = [
            ['name' => 'passportSeries',
            'type' => 'text',
            'class' => 'form-control',
            'placeholder' => 'Серия'],
            ['name' => 'passportNumber',
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Номер'],
            ['name' => 'passportDate',
                'type' => 'date',
                'class' => 'form-control']
            ];
        parent::__construct(1,"inputGroup", 'Парспортные данные (серия, номер и дата выдачи)', $args);
    }
}