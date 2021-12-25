<?php
include "../config.php";
include "UserClass.php";
$user = new UserClass($conn);

//update voter's voting status
$query = $user->updateVoterStatus($_POST['userID']);
if($query){
    echo "ok";
    exit;
}
echo false;
