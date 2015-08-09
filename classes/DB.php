<?php

class DB
{
    private $dbh;
    private $className ='stdClass';

    public function __construct(){
        /*mysql_connect('localhost', 'root', 'admin');
        mysql_select_db('test');
        mysql_query("SET NAMES 'utf8';");
        mysql_query("SET CHARACTER SET 'utf8';");
        mysql_query("SET SESSION collation_connection = 'utf8_general_ci';");
        */
        $this->dbh = new PDO('mysql:dbname=test;host=localhost','root','admin');

    }
    public function setClassName($className)
    {
        $this->className = $className;
    }
    public function query($sql, $params=[])
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll(PDO::FETCH_CLASS, $this->className);
    }

    public function execute($sql, $params=[])
    {
        $sth = $this->dbh->prepare($sql);
        return  $sth->execute($params);
    }



    /*public function queryAll($sql, $class='stdClass'){

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
    }*/
}