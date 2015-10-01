<?php


namespace view;


class Member
{
    private $repository;
    private $boatView;
    private $navView;

    private static $name = "MemberView::Name";
    private static $ssn = "MemberView::Ssn";
    private static $registration = "MemberView::Register";
    private static $messageId = "MemberView::MessageId";

    private static $memberPosition = "member";
    private $message;

    public function __construct(\model\dal\MemberRepository $repo, NavigationView $navView ,Boat $boatView){
        $this->repository = $repo;
        $this->boatView = $boatView;
        $this->navView = $navView;
    }

    public function ViewAll(){
        $ret = '<h1>En lista på alla medlemmar</h1>';
        $ret .= '<ul>';

        foreach($this->repository->GetAll() as $member){
            /* @var $member \model\Member */
            $ret .= '<li>Name: ' . $member->GetName() . '  - ID: ' . $member->GetID() . ' - Boats: ' . $member->GetBoatCount() . ' ' . $this->GetAdminLinks($member) . '</li>';
        }
        $ret .= '</ul>';

        return $ret;
    }

    public function ViewAllVerbose(){
        $ret = '<h1>En lista på alla medlemmar</h1>';
        $ret .= '<ul>';

        foreach($this->repository->GetAll() as $member){
            /* @var $member \model\Member */
            $ret .= '<li>Name: ' . $member->GetName() . ' - Personal identification number: ' . $member->GetSSN() . ' - ID: ' . $member->GetID() . ' ' . $this->GetAdminLinks($member) . PHP_EOL;
            $ret .= '<ul>';
            foreach($member->GetAllBoats() as $boat){
                $ret .= '<li>' . $this->boatView->GetBoatDetails($boat) . '</li>';
            }
            $ret .= '</ul>';
            $ret .= '</li>';
        }
        $ret .= '</ul>';
        return $ret;
    }

    private function GetAdminLinks(\model\Member $member){
        $ret = '';
        $ret .= $this->navView->GetViewMemberLink(self::$memberPosition . '=' . $member->GetID(), "View " . $member->GetName()) . ' ';
        $ret .= $this->navView->GetEditMemberLink(self::$memberPosition . '=' . $member->GetID(), "Edit") . ' ';
        $ret .= $this->navView->GetDeleteMemberLink(self::$memberPosition . '=' . $member->GetID(), "Delete");
        return $ret;
    }

    public function ViewMember(){
        $id = $_GET['member'];
        $userToShow = $this->repository->GetUserById($id);

        $ret = '<h1>'.$userToShow->GetName().'</h1>';
        $ret .= '<ul>';
        $ret .= '<li>Id: ' . $userToShow->GetID().'</li>';
        $ret .= '<li>Personal identification number: ' . $userToShow->GetSSN(). '</li>';
        $ret .= '<li>Boats assigned to this user: </li>';
        $ret .= '<ul>';
        foreach($userToShow->GetAllBoats() as $boat){
            $ret .= '<li>' . $this->boatView->GetBoatDetails($boat) . '</li>';
        }
        $ret .= '</ul>';
        $ret .= '</li>';
        $ret .= '</ul>';
        return $ret;
    }

    public function EditMember(){
        return "";
    }

    public function AddMember(){
        return "
          <h2>Add new member</h2>
            <form method='post' >
            <fieldset>
            <legend>Register a new user - Write name and social security number</legend>
              <p id='" . self::$messageId . "'>" . $this->message ."</p>
              <label for='" . self::$name . "' >Name :</label>
              <input type='text' size='20' name='" . self::$name . "' id='" . self::$name . "' value='" . strip_tags($this->getRegisterName())  ."' />
              <br/>
              <label for='" . self::$ssn . "' >Social security number  :</label>
              <input type='text' size='20' name='" . self::$ssn . "' id='" . self::$ssn . "' value='' />
              <br/>
              <input id='submit' type='submit' name='" . self::$registration . "'  value='Register' />
              <br/>
            </fieldset>
    			</form>

    		";
    }

    public function getRegisterName(){
        if(isset($_POST[self::$name])) {
            return $_POST[self::$name];
        }
        return null;
    }

    public function getRegisterSsn(){
        if(isset($_POST[self::$ssn])) {
            return $_POST[self::$ssn];
        }
    }

    public function AddedSuccess(){
        return "<p>A new member has been added!</p>";
    }

    public function UpdateSuccess(){
        return "";
    }

    public function GetUpdatedMember(){
        return new \model\Member("Kalle Anka", "8202020202");
    }

    public function HasEditedMember(){
        //Check if member has been submitted and no errors occur
        return false;
    }

    public function HasAddedMember(){
        //Check if member has been submitted and no errors occur
        if(isset($_POST[self::$registration])) {

            $canIRegisterNewUser = true;

            if (strlen($this->getRegisterName()) < 3) {
                $this->message = "Name must be atleast 3 characters long.";
                $canIRegisterNewUser = false;
            }
            if (strlen($this->getRegisterSsn()) < 9) {
                $this->message = "Social security number must be 10 characters long.";
                $canIRegisterNewUser = false;
            }
            if ($this->getRegisterName() !== strip_tags($this->getRegisterName())) {
                $this->message = "Name contains invalid characters.";
                $canIRegisterNewUser = false;
            }
            return $canIRegisterNewUser;
        }else{
            return false;
        }
    }

    public function GetNewMember(){
        //Check if member has been submitted and no errors occur
        return new \model\Member($this->getRegisterName(), $this->getRegisterSsn());
    }

    public function WantsToDeleteMember(){
        return false;
    }

    public function GetMemberToDelete(){
        return new \model\Member("Kalle Anka", "8202020202");
    }

    public function DeletedSuccess(){
        return "";
    }

    public function DeleteMember(){
        return "
        <p>Vill du radera den här användaren?</p>
        ";
    }

}