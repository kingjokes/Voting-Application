<?php
include "../config.php";
include "../admin/AdminVoterClass.php";
$admin = new AdminVoterClass($conn);

if(!isset($_GET['voterID'])){ //if voter id is not found in the link, redirect voters to home page
    header('location:../index.php');
}

$voters = $admin->getVoters(); //get all voters

if($voters[0] === 0){ //if no voters' data are found
    echo "<script>
            window.alert('Unable to fetch voter details');
    </script>";
}

//if voters are found
while($result = $voters[1]->fetch_assoc()){
    if($_GET['voterID'] === md5($result['email'])){ //cross-check each voter email to confirm voter

        $_SESSION['voterLogger'] = $result['id']; //if voter was found, store in  session
        echo "<script>
            window.alert('Logging voter in.....');
            window.location.href='dashboard.php'; //redirect user to voter's dashboard
    </script>";
        break;
    }
}
echo "<script>
            window.alert('Unable to fetch voter details'); //unable to fetch voter
             window.location.href='../index.php'; //redirect voter to home page
    </script>";
