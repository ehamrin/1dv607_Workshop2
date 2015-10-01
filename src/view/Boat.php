<?php


namespace view;


class Boat
{

    private static $length = "BoatView::Length";
    private static $type = "BoatView::Type";
    private static $save = "BoatView::SaveBoat";

    public function GetBoatDetails(\model\Boat $boat){
        return 'Type: ' . $boat->GetType() . ' - Length: ' . $boat->GetLength() . PHP_EOL;
    }

    public function AddBoat() {
        return "
    <h2>Add new boat</h2>
    <form method='post' >
        <fieldset>
        <legend>Register a new boat - Write the length and pick a type:</legend>
            <label for='" . self::$length . "' >Length :</label>
            <input type='text' size='20' name='" . self::$length . "' id='" . self::$length . "' value='' />
            <br/>
            <label for='" . self::$type . "' >Type :</label>
            <select>
                <option value='Sailboat'>Sailboat</option>
                <option value='Motorsailer'>Motorsailer</option>
                <option value='Kayak'>Kayak</option>
                <option value='Canoe'>Canoe</option>
                <option value='Other'>Other</option>
            </select>
            <br/>
          <input id='submit' type='submit' name='" . self::$save . "'  value='Save' />
          <br/>
        </fieldset>
    </form>
    ";
    }
}
