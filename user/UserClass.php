<?php
//user class which contains all the methods performed by user or voters
class UserClass{
    private $conn;

    //construct method to initialize db connection
    public function __construct($conn)
    {
        $this->conn = $conn;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    //method to register new voter
    public function registration(string $surname, string $otherNames,string $email, string $grade,string $faculty, string $dept,  string $year):string
    {
        //check if voter already exist using email
        $checker = $this->conn->query("select * from voters where email='$email'");


        if($checker->num_rows >0){
            return "User details already exist"; //voter already exist
        }

        //insert new voter into db
        $query = $this->conn->query("insert into voters (surname,other_names,email,grade,dept,faculty,graduation) 
        values ('$surname','$otherNames','$email','$grade','$dept','$faculty','$year')");

        if($query){
            return "ok"; //return ok if insertion was successful
        }
        return "Error submitting details, please try again..."; //return if error occurred

    }

    //method gets the sum of voters who have cast their votes
    public function getAllVotes()
    {
        return ($this->conn->query("select SUM(status) as total from voters where status=1"))->fetch_assoc();
    }

    //method gets voter's details
    public function getUserDetails(int $userId)
    {
        return ($this->conn->query("select * from voters where id=$userId"))->fetch_assoc();
    }

    //method gets vote per candidate using id
    public function getCandidateVote(int $id){
        $query = ($this->conn->query("select * from candidates where id=$id"))->fetch_assoc();
        return $query['candidate_cvotes']; //returns candidates cumulative vote

    }

    //method saves each votes submitted by voters
    public function saveVote(array $votes,$id):bool
    {
        //for each vote submitted, increase the vote per candidate
        foreach ($votes as $vote=>$value){
            if($value !== ''){
                $getVote = $this->getCandidateVote($value);
                $newVote = 1+ (int)$getVote;
                $this->conn->query("update candidates set candidate_cvotes=$newVote where id=$value");

            }
        }
        //mark voter's voting status as voted
        $updater = $this->conn->query("update voters set status=1 where id=$id");
        if($updater){

            //submit the voter's votes into a voting log for record purposes
            $president=$votes['president']?? 0;
            $vice_president=$votes['vice_president']?? 0;
            $vp_diaspora=$votes['vp_diaspora']?? 0;
            $general_secretary=$votes['general_secretary']?? 0;
            $assistant_secretary=$votes['assistant_secretary']?? 0;
            $treasurer=$votes['treasurer']?? 0;
            $financial_secretary=$votes['financial_secretary']?? 0;
            $publicity_secretary=$votes['publicity_secretary']?? 0;
            $checker= $this->conn->query("select * from voting_log where voter_id = $id")->num_rows; //check if voter's log already exist
            if($checker>0){
                //if yes, update voter's voting log
                $query = $this->conn->query("update voting_log set president='$president',vice_president='$vice_president',vp_diaspora='$vp_diaspora',general_secretary='$general_secretary',assistant_secretary='$assistant_secretary',treasurer='$treasurer',financial_secretary='$financial_secretary',publicity_secretary='$publicity_secretary' where voter_id=$id");
            }
            else{
                //insert voter's votes into the voting log
                $query= $this->conn->query("insert into voting_log (president, vice_president, vp_diaspora, general_secretary, assistant_secretary, treasurer, financial_secretary, publicity_secretary,voter_id)
                values('$president','$vice_president','$vp_diaspora','$general_secretary','$assistant_secretary','$treasurer','$financial_secretary','$publicity_secretary',$id)");
            }
            return  true; //return a bool response
        }
        return false;

    }

    //method updates voter's voting status
    public function updateVoterStatus(int $id):bool{
        $query = $this->conn->query("update voters set status=1 where id=$id");
        if($query){
            return true;
        }
        return false;
    }



}