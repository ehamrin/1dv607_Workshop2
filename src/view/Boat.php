<?php


namespace view;


class Boat
{
    public function GetBoatDetails(\model\Boat $boat){
        return 'Type: ' . $boat->GetType() . ' - Length: ' . $boat->GetLength() . PHP_EOL;
    }
}