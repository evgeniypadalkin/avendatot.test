<?php
/**
 * Created by PhpStorm.
 * User: evgen
 * Date: 06.01.2019
 * Time: 12:38
 */

namespace App\Controllers;


class MainController
{
    protected $data;
    protected $template;

    protected function render() {
        $file = dirname(__DIR__). '/template/' . $this->template;

        if (file_exists($file)) {
            extract($this->data);
            require($file);

        } else {
            trigger_error('Error: Not template ' . $file);
            exit();
        }
    }

}