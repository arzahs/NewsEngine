<?php

abstract class AbstractModel
{
    protected static $table;
    //protected static $class;
    protected $data = [];
    public static function getTable(){
        return static::$table;
    }
    public function __set($k, $v){
        $this->data[$k] = $v;
    }
    public function __get($k){
        return $this->data[$k];
    }
    public static function findAll(){

        $class = get_called_class();
        $table = static::getTable();
        $sql = 'SELECT * FROM '. $table;
        $db = new DB();
        $db->setClassName($class);
        return $db->query($sql);

    }

    public static function findOne($id){
        $class = get_called_class();
        $sql = 'SELECT * FROM '.static::getTable().' WHERE id=:id';
        $db = new DB();
        $db->setClassName($class);
        return $db->query($sql, [':id' => $id])[0];

    }

    public function insert(){
        $cols = array_keys($this->data);
        $ins = [];
        $data = [];
        foreach ($cols as $col){
            $ins[] = ':'.$col;
            $data[':'.$col] =  $this->data[$col];
        }

        $sql = 'INSERT INTO '.static::$table.'
        ('.implode(', ',$cols).')
        VALUES
        ('.implode(', ',$ins).')
        ';
        $db = new DB();
        $db->execute($sql, $data);


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