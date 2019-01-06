<?php

namespace Core;


class Request
{
    public $param;
    public $method;

    public function __construct($_method)
    {
        $this->method = $_method;
    }

    public function setParams($_param) {
        $this->param = $_param;
    }
}