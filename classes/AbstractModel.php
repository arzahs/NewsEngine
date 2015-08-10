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

    public function __isset($k){
        return isset($this->data[$k]);
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

    public static function findOneByColumn($column, $value)
    {
        $class = get_called_class();
        $db = new DB();
        $db->setClassName($class);
        $sql = 'SELECT * FROM '.static::getTable().' WHERE '.$column. '=:value';
        $res = $db->query($sql, [':value' => $value]);
        if(empty($res)){
            throw new ModelException('Ничего не найдено...');
        }
        return $res[0];
;
    }

    protected function insert(){
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
        $this->id = $db->lastInsertId();

    }

    protected function update(){
        $cols = [];
        $data = [];
        foreach($this->data as $k => $v){
            $data[':'.$k] = $v;
            if('id'==$k){
               continue;
           }

           $cols[] = $k . '=:' . $k;
       }

       $sql = 'UPDATE '.static::$table.'
        SET '.implode(', ', $cols).'
        WHERE id=:id
        ';
        $db = new DB();
        $db->execute($sql, $data);


    }

    public function save()
    {
        if(!isset($this->id)){
            $this->insert();
        }else{
            $this->update();
        }
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