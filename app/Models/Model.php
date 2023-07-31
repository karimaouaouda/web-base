<?php


namespace App\Models;
use App\System\Database\Connection;


class Model extends Connection{


    protected string $table ;

    private string $modelName;

    protected $fillable;

    public function __construct(array $attributes = array()){
        $db_data = config("connection");
        parent::__construct($db_data["DB_HOST"] , $db_data['USERNAME'] , $db_data['DB_NAME'] , $db_data['DB_PASS']);

        $this->setTableName();
        

        if( count($attributes) > 0 ){
            $this->matchAttributes($attributes);
        }
    }

    public function setTableName(string $table = ""){
        $tablename = (new \ReflectionClass($this))->getShortName();

        $tablename = strtolower($tablename)."s";

        $this->table = $tablename;
    }

    public function matchAttributes(array $attributes){
        foreach( $this->fillable as $key => $val ){
            if( array_key_exists($val , $attributes) ){
                $this->{$val} = $attributes[$val];
            }else{
                $this->{$val} = null;
            }
            //we don't want to do an exception
        }
    }

    public function table(){
        return  $this->table;
    }


}




?>