<?php


class AdminVoterClass{
    private $conn;

    //initiate class with db connection
    public function __construct($conn)
    {
        $this->conn = $conn;
        if (session_status() === PHP_SESSION_NONE) { //if session not already started, start new session
            session_start();
        }
    }

    //method to log admin in using email and password
    public function login(string $username, string $password):bool
    {
        $checker= $this->conn->query("select * from admin where (username='$username' or email='$username')");

        if($checker->num_rows ===1){
            $result = $checker->fetch_assoc();
            if( password_verify($password,$result['password']) && $result['status']==1){
                $_SESSION['adminLogger']= $result['id'];
                return true;
            }
            return false;
        }
        return false;
    }

    //method to log out admin
    public function logout(): void
    {
        session_destroy();
    }

    //method to get admin details
    public function getAdminDetails(int $userId)
    {
        return ($this->conn->query("select * from admin where id=$userId"))->fetch_assoc();
    }

    //get all voters, returns array of voters count and query row
    public function getVoters():array
    {
        $query= ($this->conn->query("select * from voters order by surname,other_names "));
        return [$query->num_rows, $query];
    }

    //method gets all candidates, returns array of candidate count and query row
    public function getCandidates():array
    {
        $query= ($this->conn->query("select * from candidates order by candidate_position asc"));
        return [$query->num_rows, $query];
    }

    //method add new candidate and uploads candidate profile picture
    public function addCandidate(string $fullname, string $position, $avatar):string
    {
        $checker = ($this->conn->query("select * from candidates where candidate_name= '$fullname'"))->num_rows; //check if candidate  exist
        if($checker>0){ //candidate exist
            return "Candidate already exist";
        }
        //add new candidate
        $query = $this->conn->query("insert into candidates (candidate_name,candidate_position) values('$fullname','$position')");

        if($query){
            $this->upload($this->conn->insert_id,$avatar,'../candidates','candidates','image'); //upload candidate avatar
            return "ok";
        }
        return "Unable to add candidate, please try again..."; //error adding new candidate
    }

    //method to delete candidate
    public function deleteCandidate(int $id):bool
    {
        $query = $this->conn->query("delete from candidates where id=$id");
        if($query){
            return true;
        }
        return false;
    }

    //method to get candidate details
    public function candidateDetails(int $id)
    {
        return ($this->conn->query("select * from candidates where id=$id"))->fetch_assoc();

    }

    //method to get candidates in a giver position,
    // returns array of candidate sum, query row, and sum of votes per position
    public function getCandidatePerPosition(string $position):array
    {
        $query = $this->conn->query("select * from candidates where candidate_position='$position'");
        $sum = $this->conn->query("SELECT SUM(candidate_cvotes) AS  total  FROM candidates WHERE candidate_position = '$position'");
        return [$query->num_rows, $query,$sum->fetch_assoc()];
    }

    //method to update candidate's details
    public function updateCandidate(int $id,string $fullname, string $position, $avatar=''):bool
    {
        $query= $this->conn->query("update candidates set candidate_name='$fullname',candidate_position='$position' where id=$id");
        if($query){
            if($avatar['size'][0] !== 0){
                echo 'yes';
                $this->upload($id,$avatar,'../candidates','candidates','image');
            }
            return true;
        }
        return false;
    }

    //method to get voting setting
    public function getSettings():array
    {
        $query = $this->conn->query("select * from settings where id=1");
        return [$query->num_rows,$query->fetch_assoc()];
    }

    //method to update voting time settings
    public function updateSettings(string $start, string $end):bool
    {
        $checker= ($this->conn->query("select * from settings where id=1"))->num_rows;
        $query = $checker===0
            ? $this->conn->query("insert into settings (start_date,end_date) values ('$start','$end')")
            :$this->conn->query("update settings set start_date='$start', end_date='$end' where id=1");
        if($query){
            return true;
        }
            return false;

    }

    //method to delete voter
    public function deleteVoter(int $id):bool
    {
        $query = $this->conn->query("delete from voters where id=$id");
        if($query){
            return true;
        }
        return false;
    }

    //method to get page url
    public function getUrl($url):string
    {
        $array = explode('/',$url);
        $path = $array[count($array)-1];
        return str_replace('.php','',$path);
    }

    //method to get the active page
    public function compareNavLink($link, $url):string
    {
        return $link===$url ? 'active-link' : '';
    }

    //method to upload images based on location
    public function upload($userID,$file,$location,$table,$column): bool
    {
        if($file!== ''){
            $name='';$tmp_name='';
            foreach ($file["error"] as $key => $error) {
                if ($error === UPLOAD_ERR_OK) {
                    $tmp_name = $file["tmp_name"][$key];
                    // basename() may prevent filesystem traversal attacks;
                    // further validation/sanitation of the filename may be appropriate
                    $name = basename($file["name"][$key]);
                    move_uploaded_file($tmp_name, "$location/$name");
                }
                $this->conn->query("update $table set $column='$name' where id=$userID ");
            }

            return true;
        }
        return false;
    }


    //method to upload voters from an Excel sheet
    public function uploadVoters($file):string
    {
        require_once('../vendor/php-excel-reader/excel_reader2.php');//include php excel reader plugin
        require_once('../vendor/SpreadsheetReader.php');
        //only Excel file formats are allowed
        $allowedFileType = ['application/vnd.ms-excel','text/xls','text/csv','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

        if(in_array($_FILES["file"]["type"],$allowedFileType)){ //if the file uploaded type matches allowed file

            $targetPath = '../uploads/'.$_FILES['file']['name'];
            $file_name=basename($_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], $targetPath); //upload file to upload folder

            $Reader = new SpreadsheetReader($targetPath); //read file

            $sheetCount = count($Reader->sheets());
            $query='';
            for($i=0;$i<$sheetCount;$i++)
            {
                $Reader->ChangeSheet($i);

                foreach ($Reader as $Row)
                {

                    $surname = $Row[0] ?? "";
                    $email = $Row[1] ?? "";
                    $other_names= $Row[2] ?? "";
                    $grade = $Row[3] ?? "";
                    $dept = $Row[4] ?? "";
                    $faculty = $Row[5] ?? "";
                    $graduation= $Row[6] ?? "";


                    //foreach row, insert candidate if details does not exist
                    $checker = ($this->conn->query("select * from voters where (surname ='$surname' and other_names='$other_names') or email = '$email'"))->num_rows;
                    if($checker === 0){
                        if($surname !== 'surname' || $email !== 'email'){
                            $query = $this->conn->query("insert into voters (surname,other_names,email,grade,dept,faculty,graduation) 
                            values ('$surname','$other_names','$surname$other_names@gmail.com','$grade','$dept','$faculty','$graduation')");
                        }
                    }


                }

            }
            if($query){
                return  "ok"; //voters added successfully
            }
            return "Voters uploaded, file contains some existing voters"; //file contains existing voters

        }
        return "Invalid document file uploaded, only excel files are allowed"; //issue uploading reading file

    }

    //method to get vote breakdown from voting log
    public function getVoteBreakDown():array
    {
        $query = $this->conn->query("select distinct voters.*, voting_log.president,voting_log.vice_president,voting_log.vp_diaspora,voting_log.general_secretary,voting_log.assistant_secretary,voting_log.treasurer,voting_log.financial_secretary,voting_log.publicity_secretary from voters left join voting_log on voters.id=voting_log.voter_id order by voters.surname ");
        return [$query->num_rows,$query];
    }
}