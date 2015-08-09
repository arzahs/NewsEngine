<?php

abstract class AbstractModel
{
    protected static $table;
    //protected static $class;

    public static function getTable(){
        return static::$table;
    }

    /*static public function getAll(){
        $db = new DB;
        $sql = 'SELECT * FROM '.static::$table;
        return $db->queryAll($sql, static::$class);
    }

    static public function getOne($id){
        $db = new DB;
        $sql = 'SELECT * FROM '.static::$table.' WHERE id='.$id;
        return $db->queryOne($sql, static::$class);
    }*/
}