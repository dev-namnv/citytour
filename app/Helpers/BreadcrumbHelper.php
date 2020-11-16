<?php

namespace App\Helpers;

class BreadcrumbHelper {
    public $name;
    public $path;

    public function __construct($name, $path)
    {
        $this->name = $name;
        $this->path = $path;
    }
}
