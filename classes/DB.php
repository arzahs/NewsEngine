<?php

class DB
{
    public function __construct(){
        mysql_connect('localhost', 'root', 'admin');
        mysql_select_db('test');
        mysql_query("SET NAMES 'utf8';");
        mysql_query("SET CHARACTER SET 'utf8';");
        mysql_query("SET SESSION collation_connection = 'utf8_general_ci';");
    }

    public function queryAll($sql, $class='stdClass'){

        $res = mysql_query($sql);
        if (false === $res){
            return false;
        }

        $ret = [];
        while ($row = mysql_fetch_object($res, $class)){
            $ret[] = $row;
        }
        return $ret;
    }

    public function queryOne($sql, $class = 'stdClass')
    {
        return $this->queryAll($sql, $class)[0];
    }
}