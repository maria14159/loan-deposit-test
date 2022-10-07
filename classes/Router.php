<?php

class Router
{
    private $pages;

    public function addRoute($url, $path)
    {
        $this->pages[$url] = $path;
    }

    public function route($url)
    {
        $path = $this->pages[$url];
        $fileDir = $_SERVER['DOCUMENT_ROOT'] . '/pages/' . $path;

        if($path == '')
            die();

        if (file_exists($fileDir))
            require $fileDir;
        else die();
    }
}