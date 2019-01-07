<?php

namespace Core;


class Request
{
    public $param;
    public $method;
    public $errors;

    public function __construct($_method)
    {
        $this->method = $_method;
        $this->errors = [];
    }

    public function setParams($_param) {
        $this->param = $_param;
    }

    public function validate($arr) {
        foreach ($arr as $key=>$param) {
            switch ($param) {
                case "required":
                    if(!isset($this->param[$key]) || $this->param[$key] == '') {
                        $this->errors[] = 'Field '.$key.' is required!';
                    }
                    break;
            }
        }

        if(empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }
}