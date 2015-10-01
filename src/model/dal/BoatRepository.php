<?php


namespace model\dal;


class BoatRepository
{
    private $db;
    private $memberUnique;
    //TODO: Solve problem when constructing in Program.php->Main()
    //Temp-fix, default value 0
    public function __construct($memberUnique = 0){
        $this->memberUnique = $memberUnique;

        $connection = new DatabaseConnection();
        try{
            $this->db = $connection->Establish();
            $this->db->SetAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch(\Exception $e){
            throw $e;
        }
    }

    public function GetAllBoats(){
        $ret = array();

        $stmt = $this->db->prepare("SELECT * FROM boat WHERE member = ?");
        $stmt->execute(array($this->memberUnique));

        while($boat = $stmt->fetchObject()){
            $ret[] =  new \model\Boat($boat->type, $boat->length, $boat->id);
        }

        return $ret;
    }

    public function Save(\model\Boat $boat){
        if($boat->GetID() > 0){
            $this->Update($boat);
        }else{
            $this->Create($boat);
        }
    }

    private function Create(\model\Boat $boat){
        $stmt = $this->db->prepare("INSERT INTO boat (member, length, type) VALUE (?, ?, ?)");
        $stmt->execute(array($boat->getOwner(), $boat->GetLength(), $boat->GetType()));
        $boat->SetID($this->db->lastInsertId());
    }

    private function Update(\model\Boat $boat){
        $stmt = $this->db->prepare("UPDATE boat SET length = ?, type = ? WHERE id = ?");
        $stmt->execute(array($boat->GetLength(), $boat->GetType(), $boat->GetID()));
    }

    public function Delete(\model\Boat $boat){
        $stmt = $this->db->prepare("DELETE FROM boat WHERE id = ?");
        $stmt->execute(array($boat->GetID()));
    }

}
