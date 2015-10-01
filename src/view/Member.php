<?php


namespace view;


class Member
{
    private $repository;
    private $boatView;
    private $navView;

    private static $memberPosition = "member";

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
        $ret .= $this->navView->GetDeleteMemberLink(self::$memberPosition . '=' . $member->GetID(), "Delete" . ' ');
        $ret .= $this->navView->GetAddBoatLink(self::$memberPosition . '=' . $member->GetID(), "Add boat");
        return $ret;
    }

    public function ViewMember(){
        return "";
    }

    public function EditMember(){
        return "";
    }

    public function AddMember(){
        return "";
    }

    public function AddedSuccess(){
        return "";
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
        return false;
    }

    public function GetNewMember(){
        //Check if member has been submitted and no errors occur
        return new \model\Member("Kalle Anka", "8202020202");
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
        return "";
    }

}
