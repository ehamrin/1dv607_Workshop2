<?php

namespace model;

class Boat
{
    private $id;
    private $type;
    private $length;
    private $owner;

    public function __construct($type, $length, $ownerID, $id = 0){
        $this->type = $type;
        $this->length = $length;
        $this->owner = $ownerID;
        $this->id = $id;
    }

    public function GetType(){
        return $this->type;
    }

    public function SetType($type){
        $this->type = $type;
    }

    public function GetLength(){
        return $this->length;
    }

    public function SetLength($length){
        $this->length = $length;
    }

    public function GetOwner(){
        return $this->owner;
    }

    public function SetOwner($ownerID){
        $this->owner = $ownerID;
    }

    public function SetID($id){
        $this->id = $id;
    }

    public function GetID(){
        return $this->id;
    }

}
