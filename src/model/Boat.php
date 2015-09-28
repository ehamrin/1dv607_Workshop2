<?php


namespace model;


class Boat
{
    private $id;
    private $type;
    private $length;


    public function __construct($type, $length, $id = 0){
        $this->type = $type;
        $this->length = $length;
        $this->id = $id;
    }

    public function GetType(){
        return $this->type;
    }

    public function GetLength(){
        return $this->length;
    }

    public function SetID($id){
        $this->id = $id;
    }

    public function GetID(){
        return $this->id;
    }

}