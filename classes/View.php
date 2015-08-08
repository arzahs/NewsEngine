<?php

/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 08.08.15
 * Time: 22:08
 */
class View
{
    protected $data = [];

    public function assign($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function display($template)
    {
        foreach ($this->data as $key=>$val){
            $$key = $val;
        }
        include __DIR__.'/../views/'.$template;
    }

}