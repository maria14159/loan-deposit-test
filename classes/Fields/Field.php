<?php

abstract class Field
{
    private $block;
    private $template;
    private $label;
    private $args;

    public function __construct($block, $template, $label, $args)
    {
        $this->block = $block;
        $this->template = $template;
        $this->label = $label;
        $this->args = $args;
    }


    public function getFields(): array
    {
        return [
            'block' => $this->block,
            'template' => $this->template,
            'label' => $this->label,
            'args' => $this->args];
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return mixed
     */
    public function getArgs()
    {
        return $this->args;
    }
}