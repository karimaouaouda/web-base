<?php

namespace App\System;


class View{
    private $path = __DIR__."/../../views";
    private $file_path;
    private $file_content = "no content";
    public function __construct(string $file_path)
    {
        $this->file_path = $this->path."/".$file_path;

        if(file_exists($this->file_path.".php")){
            $this->file_content = file_get_contents($this->file_path.".php" , true , null );
        }else{
            $this->file_content = $this->file_path.".php";
        }
    }


    public function start($buffer , $args){
        $content = $buffer;
        foreach($args as $arg => $val){
            $content = str_replace( "$".$arg , $val , $content );
        }

        return $content;
    }



    public function view(array $args = []){

        return $this->start($this->file_content , $args);
    }
}


?>