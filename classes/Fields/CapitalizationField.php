<?php

class CapitalizationField extends Field
{
    public function __construct()
    {
        $args = [
            ['value' => '1',
                'selected' => 'true',
                'name' => 'В конце срока'],
            ['value' => '2',
                'selected' => 'false',
                'name' => 'Ежемесячно']
        ];
        parent::__construct(3,"select", 'Периодичность капитализации %%', $args);
    }
}