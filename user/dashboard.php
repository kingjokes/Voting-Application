<?php
include 'headers.php';
date_default_timezone_set("Africa/Lagos"); //set default time zone


if(isset($_POST['save'])){ //submit user's vote per candidate
    $submit = $user->saveVote([
            "president" => $_POST["president"] ?? '',
            "vice_president" => $_POST["vice_president"] ?? '',
            "vp_diaspora" => $_POST["vp_diaspora"] ?? '',
            "general_secretary" => $_POST["general_secretary"] ?? '',
            "assistant_secretary" => $_POST["assistant_secretary"] ?? '',
            "treasurer" => $_POST["treasurer"] ?? '',
            "financial_secretary" => $_POST["financial_secretary"] ?? '',
            "publicity_secretary" => $_POST["publicity_secretary"] ?? '',
    ],$_SESSION['voterLogger']);

    //if vote was submitted successfully
    if($submit){
        echo "<script>
                window.alert('Vote submitted successfully');
                window.location.href='dashboard.php';
        </script>";
        exit;
    }

    //error submitting vote
    echo "<script>
                 window.alert('Unable to submit vote , kindly try again');
                window.location.href='dashboard.php';
            
        </script>";


}
$settings = $admin->getSettings();//gets the voting time setting
$start= strtotime($settings[1]['start_date']);//converts start date to string time
$end= strtotime($settings[1]['end_date']);//converts end date to string time
$today = strtotime(date('Y-m-d H:i:s'));//gets the current string time

if($today< $start){
    header("location:countdown.php"); //if voting is yet to start redirect users to countdown page
    exit;
}



?>
<div class="w3-top  w3-card mb-4" style="background: #1c2a39;">
    <div class="w3-container">
        <div class="w3-bar">
            <div class="w3-left">
                <div class="w3-bar-item">
                    <img src="../images/acu-logo3-2-1.png" class="w3-image" style="width:100px; height: 40px ">
                </div>
            </div>
            <div class="w3-right">
                <div class="w3-bar-item w3-hide-small" style="margin-top: 6px">
                    <span class="w3-text-white">
                        <i class="fa fa-user"></i>
                        <!--display voters fullname-->
                        <span class="text-capitalize"><?php echo $details['surname'].' '.$details['other_names'] ?></span>
                    </span>
                </div>
                <div class="w3-bar-item" style="margin-top: 6px">
                    <a href="logout.php" class="w3-text-white">
                        Logout
                    </a>
                </div>



            </div>
        </div>

    </div>

</div>
<br>

<div class="w3-padding-48">
    <div class="text-right mr-4 d-lg-none d-sm-none d-md-none">
        <span class="" style="color:#1c2a39">
            <i class="fa fa-user"></i>
            <!--display voter's full name on mobile screen-->
            <span class="text-capitalize"><?php echo 'Welcome, '. $details['surname'].' '.$details['other_names'] ?></span>
        </span>
    </div>
    <div class="w3-row-padding">
        <div class="w3-col l3 m2 s12">
            &nbsp;
        </div>
        <div class="w3-col l6 m8 s12">
            <div class="text-left ">
                <div class="w3-bar-block">
                    <div class="w3-bar-item">
                        <!--display count of registered voters-->
                        <h5  class="font-weight-bold"><i>Registered Voters: <?php echo number_format($voters[0]) ?></i></h5>
                    </div>
                    <div class="w3-bar-item text-success"  style="margin-top: -12px">
                        <!--display sum of votes casted-->
                        <h5 class="font-weight-bold"><i>Votes Casted:  <?php echo number_format((float)$totalVotes['total']) ?></i></h5>
                    </div>
                    <div class="w3-bar-item text-danger" style="margin-top: -12px" >
                        <!--displays sum of voters who are yet to vote-->
                        <h5  class="font-weight-bold"><i>Uncast Votes: <?php echo number_format($uncastedVotes) ?></i></h5>
                    </div>
                </div>
            </div>
            <div class="w3-container mt-3">
                <div class="w3-left mt-2">
                    <b >
                           <?php
                           //display voting time status for voters
                           if($today < $start){
                               echo 'Voting is yet to start, kindly check back.';
                           }else if($today > $end){
                               echo "Voting period has expired.";
                           }else{
                               echo 'Voting in progress';
                           }
                           ?>
                    </b>

                </div>
                <div class="w3-right" style="">
                    <!--voting countdown progress diplay-->
                    <button class="w3-btn w3-card-4 w3-round-medium w3-text-white" id="timer" style="background: #141d28;">
                        <span class="hour">00</span> :
                        <span class="min">00</span> :
                        <span class="sec">00</span>
                    </button>
                </div>
            </div>

            <br><br>
            <form method="post" enctype="application/x-www-form-urlencoded" action="dashboard.php">
                <div id="accordion">

                    <!-- getCandidatePerPosition method gets candidates per position-->
                    <?php
                    $positions= [
                        'president',
                        'vice_president',
                        'vp_diaspora',
                        'general_secretary',
                        'assistant_secretary',
                        'treasurer',
                        'financial_secretary',
                        'publicity_secretary'
                    ];
                    $count=1;
                    foreach ($positions as $position): ?>
                        <div class="card">
                            <div class="card-header  w3-white-text" style="background: #0bacfa !important; color:white!important;">
                                <a class="card-link w3-block text-capitalize" data-toggle="collapse" href="#collapse<?php echo $count?>" >
                                    Vote  <?php echo str_replace('_',' ',$position) ?>
                                </a>
                            </div>
                            <div id="collapse<?php echo $count?>" class="collapse show" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="w3-responsive">
                                        <table class="w3-table  w3-left-align">
                                            <tr class="w3-border-bottom w3-border-light-gray">
                                                <th>&nbsp;</th>
                                                <th>Candidate</th>
                                                <th>Count</th>
                                                <th>Vote</th>
                                            </tr>
                                            <?php
                                            $query = $admin->getCandidatePerPosition($position);
                                            if($query[0]===0){
                                                ?>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>No candidate found</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <?php
                                            }else{
                                                $sn=1;
                                                while ($result = $query[1]->fetch_assoc()){?>
                                                    <tr class="w3-border-bottom w3-border-light-gray">
                                                        <td><?php echo $sn; ?></td>
                                                        <td>
                                                            <img src="../candidates/<?php echo $result['image'] ?>" alt="<?php echo $result['candidate_name'] ?>" class="" style="width:30px; height: 30px; border-radius: 50%">
                                                            <span class="text-capitalize"> <?php echo $result['candidate_name'] ?></span>
                                                        </td>
                                                        <td><button class="btn w3-small btn-info">  <?php echo $admin->getCandidateVoteCount($result['id'],$position);?></button></td>
                                                        <td>
                                                            <input type="checkbox" class="w3-check" name="<?php echo $position ?>" value="<?php echo $result['id'] ?>"
                                                            "<?php echo $position ?>"
                                                            <?php echo $details['status'] == 1 ? 'disabled': ' ' ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $sn++;
                                                }
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $count++;
                    endforeach;



                    ?>
                 <!--   <div class="card">
                        <div class="card-header  w3-white-text" style="background: #0bacfa !important; color:white!important;">
                            <a class="card-link w3-block" data-toggle="collapse" href="#collapseOne" >
                                Vote President
                            </a>
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <div class="w3-responsive">
                                    <table class="w3-table  w3-left-align">
                                        <tr class="w3-border-bottom w3-border-light-gray">
                                            <th>&nbsp;</th>
                                            <th>Candidate</th>
                                            <th>Count</th>
                                            <th>Vote</th>
                                        </tr>
                                        <?php
/*                                        $president = $admin->getCandidatePerPosition('president');
                                        if($president[0]===0){
                                            */?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>No candidate found</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php
/*                                        }else{
                                            $count=1;
                                            while ($result = $president[1]->fetch_assoc()){*/?>
                                                <tr class="w3-border-bottom w3-border-light-gray">
                                                    <td><?php /*echo $count; */?></td>
                                                    <td>
                                                        <img src="../candidates/<?php /*echo $result['image'] */?>" alt="<?php /*echo $result['candidate_name'] */?>" class="" style="width:30px; height: 30px; border-radius: 50%">
                                                        <span class="text-capitalize"> <?php /*echo $result['candidate_name'] */?></span>
                                                    </td>
                                                    <td><button class="btn w3-small btn-info"><?php /*echo $result['candidate_cvotes'] */?></button></td>
                                                    <td>
                                                        <input type="checkbox" class="w3-check" name="president" value="<?php /*echo $result['id'] */?>" "president" <?php /*echo $details['status'] == 1 ? 'disabled': ' ' */?>>
                                                    </td>
                                                </tr>
                                                <?php
/*                                                $count++;
                                            }
                                        }
                                        */?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" style="background: #0bacfa !important; color:white!important;">
                            <a class="collapsed card-link w3-block" data-toggle="collapse" href="#collapseTwo">
                                Vote Vice President
                            </a>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <div class="w3-responsive">
                                    <table class="w3-table  w3-left-align">
                                        <tr class="w3-border-bottom w3-border-light-gray">
                                            <th>&nbsp;</th>
                                            <th>Candidate</th>
                                            <th>Count</th>
                                            <th>Vote</th>
                                        </tr>
                                        <?php
/*                                        $president = $admin->getCandidatePerPosition('vice_president');
                                        if($president[0]===0){
                                            */?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>No candidate found</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php
/*                                        }else{
                                            $count=1;
                                            while ($result = $president[1]->fetch_assoc()){*/?>
                                                <tr class="w3-border-bottom w3-border-light-gray">
                                                    <td><?php /*echo $count; */?></td>
                                                    <td>
                                                        <img src="../candidates/<?php /*echo $result['image'] */?>" alt="<?php /*echo $result['candidate_name'] */?>" class="" style="width:30px; height: 30px; border-radius: 50%">
                                                        <span class="text-capitalize"> <?php /*echo $result['candidate_name'] */?></span>
                                                    </td>
                                                    <td><button class="btn w3-small btn-info"><?php /*echo $result['candidate_cvotes'] */?></button></td>
                                                    <td>
                                                        <input type="checkbox" class="w3-check" name="vice_president" value="<?php /*echo $result['id'] */?>" "vice_president" <?php /*echo $details['status'] == 1 ? 'disabled': ' ' */?>>
                                                    </td>
                                                </tr>
                                                <?php
/*                                                $count++;
                                            }
                                        }
                                        */?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" style="background: #0bacfa !important; color:white!important;">
                            <a class="collapsed card-link w3-block" data-toggle="collapse" href="#diaspora">
                                Vote VP Diaspora
                            </a>
                        </div>
                        <div id="diaspora" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <div class="w3-responsive">
                                    <table class="w3-table  w3-left-align">
                                        <tr class="w3-border-bottom w3-border-light-gray">
                                            <th>&nbsp;</th>
                                            <th>Candidate</th>
                                            <th>Count</th>
                                            <th>Vote</th>
                                        </tr>
                                        <?php
/*                                        $query = $admin->getCandidatePerPosition('vp_diaspora');
                                        if($query[0]===0){
                                            */?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>No candidate found</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php
/*                                        }else{
                                            $count=1;
                                            while ($result = $query[1]->fetch_assoc()){*/?>
                                                <tr class="w3-border-bottom w3-border-light-gray">
                                                    <td><?php /*echo $count; */?></td>
                                                    <td>
                                                        <img src="../candidates/<?php /*echo $result['image'] */?>" alt="<?php /*echo $result['candidate_name'] */?>" class="" style="width:30px; height: 30px; border-radius: 50%">
                                                        <span class="text-capitalize"> <?php /*echo $result['candidate_name'] */?></span>
                                                    </td>
                                                    <td><button class="btn w3-small btn-info"><?php /*echo $result['candidate_cvotes'] */?></button></td>
                                                    <td>
                                                        <input type="checkbox" class="w3-check" name="vp_diaspora" value="<?php /*echo $result['id'] */?>" "vp_diaspora" <?php /*echo $details['status'] == 1 ? 'disabled': ' ' */?>>
                                                    </td>
                                                </tr>
                                                <?php
/*                                                $count++;
                                            }
                                        }
                                        */?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" style="background: #0bacfa !important; color:white!important;">
                            <a class="collapsed card-link w3-block" data-toggle="collapse" href="#gen">
                                Vote General Secretary
                            </a>
                        </div>
                        <div id="gen" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <div class="w3-responsive">
                                    <table class="w3-table  w3-left-align">
                                        <tr class="w3-border-bottom w3-border-light-gray">
                                            <th>&nbsp;</th>
                                            <th>Candidate</th>
                                            <th>Count</th>
                                            <th>Vote</th>
                                        </tr>
                                        <?php
/*                                        $query = $admin->getCandidatePerPosition('general_secretary');
                                        if($query[0]===0){
                                            */?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>No candidate found</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php
/*                                        }else{
                                            $count=1;
                                            while ($result = $query[1]->fetch_assoc()){*/?>
                                                <tr class="w3-border-bottom w3-border-light-gray">
                                                    <td><?php /*echo $count; */?></td>
                                                    <td>
                                                        <img src="../candidates/<?php /*echo $result['image'] */?>" alt="<?php /*echo $result['candidate_name'] */?>" class="" style="width:30px; height: 30px; border-radius: 50%">
                                                        <span class="text-capitalize"> <?php /*echo $result['candidate_name'] */?></span>
                                                    </td>
                                                    <td><button class="btn w3-small btn-info"><?php /*echo $result['candidate_cvotes'] */?></button></td>
                                                    <td>
                                                        <input type="checkbox" class="w3-check" name="general_secretary" value="<?php /*echo $result['id'] */?>" "general_secretary" <?php /*echo $details['status'] == 1 ? 'disabled': ' ' */?>>
                                                    </td>
                                                </tr>
                                                <?php
/*                                                $count++;
                                            }
                                        }
                                        */?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" style="background: #0bacfa !important; color:white!important;">
                            <a class="collapsed card-link w3-block" data-toggle="collapse" href="#ass">
                                Vote Assistant Secretary
                            </a>
                        </div>
                        <div id="ass" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <div class="w3-responsive">
                                    <table class="w3-table  w3-left-align">
                                        <tr class="w3-border-bottom w3-border-light-gray">
                                            <th>&nbsp;</th>
                                            <th>Candidate</th>
                                            <th>Count</th>
                                            <th>Vote</th>
                                        </tr>
                                        <?php
/*                                        $query = $admin->getCandidatePerPosition('assistant_secretary');
                                        if($query[0]===0){
                                            */?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>No candidate found</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php
/*                                        }else{
                                            $count=1;
                                            while ($result = $query[1]->fetch_assoc()){*/?>
                                                <tr class="w3-border-bottom w3-border-light-gray">
                                                    <td><?php /*echo $count; */?></td>
                                                    <td>
                                                        <img src="../candidates/<?php /*echo $result['image'] */?>" alt="<?php /*echo $result['candidate_name'] */?>" class="" style="width:30px; height: 30px; border-radius: 50%">
                                                        <span class="text-capitalize"> <?php /*echo $result['candidate_name'] */?></span>
                                                    </td>
                                                    <td><button class="btn w3-small btn-info"><?php /*echo $result['candidate_cvotes'] */?></button></td>
                                                    <td>
                                                        <input type="checkbox" class="w3-check" name="assistant_secretary" value="<?php /*echo $result['id'] */?>" "assistant_secretary" <?php /*echo $details['status'] == 1 ? 'disabled': ' ' */?>>
                                                    </td>
                                                </tr>
                                                <?php
/*                                                $count++;
                                            }
                                        }
                                        */?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" style="background: #0bacfa !important; color:white!important;">
                            <a class="collapsed card-link w3-block" data-toggle="collapse" href="#treasurer">
                                Vote Treasurer
                            </a>
                        </div>
                        <div id="treasurer" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <div class="w3-responsive">
                                    <table class="w3-table  w3-left-align">
                                        <tr class="w3-border-bottom w3-border-light-gray">
                                            <th>&nbsp;</th>
                                            <th>Candidate</th>
                                            <th>Count</th>
                                            <th>Vote</th>
                                        </tr>
                                        <?php
/*                                        $query = $admin->getCandidatePerPosition('treasurer');
                                        if($query[0]===0){
                                            */?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>No candidate found</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php
/*                                        }else{
                                            $count=1;
                                            while ($result = $query[1]->fetch_assoc()){*/?>
                                                <tr class="w3-border-bottom w3-border-light-gray">
                                                    <td><?php /*echo $count; */?></td>
                                                    <td>
                                                        <img src="../candidates/<?php /*echo $result['image'] */?>" alt="<?php /*echo $result['candidate_name'] */?>" class="" style="width:30px; height: 30px; border-radius: 50%">
                                                        <span class="text-capitalize"> <?php /*echo $result['candidate_name'] */?></span>
                                                    </td>
                                                    <td><button class="btn w3-small btn-info"><?php /*echo $result['candidate_cvotes'] */?></button></td>
                                                    <td>
                                                        <input type="checkbox" class="w3-check" name="treasurer" value="<?php /*echo $result['id'] */?>" "treasurer" <?php /*echo $details['status'] == 1 ? 'disabled': ' ' */?>>
                                                    </td>
                                                </tr>
                                                <?php
/*                                                $count++;
                                            }
                                        }
                                        */?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" style="background: #0bacfa !important; color:white!important;">
                            <a class="collapsed card-link w3-block" data-toggle="collapse" href="#financial_secretary">
                                Vote Financial Secretary
                            </a>
                        </div>
                        <div id="financial_secretary" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <div class="w3-responsive">
                                    <table class="w3-table  w3-left-align">
                                        <tr class="w3-border-bottom w3-border-light-gray">
                                            <th>&nbsp;</th>
                                            <th>Candidate</th>
                                            <th>Count</th>
                                            <th>Vote</th>
                                        </tr>
                                        <?php
/*                                        $query = $admin->getCandidatePerPosition('financial_secretary');
                                        if($query[0]===0){
                                            */?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>No candidate found</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php
/*                                        }else{
                                            $count=1;
                                            while ($result = $query[1]->fetch_assoc()){*/?>
                                                <tr class="w3-border-bottom w3-border-light-gray">
                                                    <td><?php /*echo $count; */?></td>
                                                    <td>
                                                        <img src="../candidates/<?php /*echo $result['image'] */?>" alt="<?php /*echo $result['candidate_name'] */?>" class="" style="width:30px; height: 30px; border-radius: 50%">
                                                        <span class="text-capitalize"> <?php /*echo $result['candidate_name'] */?></span>
                                                    </td>
                                                    <td><button class="btn w3-small btn-info"><?php /*echo $result['candidate_cvotes'] */?></button></td>
                                                    <td>
                                                        <input type="checkbox" class="w3-check" name="financial_secretary" value="<?php /*echo $result['id'] */?>" "financial_secretary" <?php /*echo $details['status'] == 1 ? 'disabled': ' ' */?>>
                                                    </td>
                                                </tr>
                                                <?php
/*                                                $count++;
                                            }
                                        }
                                        */?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" style="background: #0bacfa !important; color:white!important;">
                            <a class="collapsed card-link w3-block" data-toggle="collapse" href="#publicity_secretary">
                                Vote Publicity Secretary
                            </a>
                        </div>
                        <div id="publicity_secretary" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <div class="w3-responsive">
                                    <table class="w3-table  w3-left-align">
                                        <tr class="w3-border-bottom w3-border-light-gray">
                                            <th>&nbsp;</th>
                                            <th>Candidate</th>
                                            <th>Count</th>
                                            <th>Vote</th>
                                        </tr>
                                        <?php
/*                                        $query = $admin->getCandidatePerPosition('publicity_secretary');
                                        if($query[0]===0){
                                            */?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>No candidate found</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php
/*                                        }else{
                                            $count=1;
                                            while ($result = $query[1]->fetch_assoc()){*/?>
                                                <tr class="w3-border-bottom w3-border-light-gray">
                                                    <td><?php /*echo $count; */?></td>
                                                    <td>
                                                        <img src="../candidates/<?php /*echo $result['image'] */?>" alt="<?php /*echo $result['candidate_name'] */?>" class="" style="width:30px; height: 30px; border-radius: 50%">
                                                        <span class="text-capitalize"> <?php /*echo $result['candidate_name'] */?></span>
                                                    </td>
                                                    <td><button class="btn w3-small btn-info"><?php /*echo $result['candidate_cvotes'] */?></button></td>
                                                    <td>
                                                        <input type="checkbox" class="w3-check" name="publicity_secretary" value="<?php /*echo $result['id'] */?>" "publicity_secretary" <?php /*echo $details['status'] == 1 ? 'disabled': ' ' */?>>
                                                    </td>
                                                </tr>
                                                <?php
/*                                                $count++;
                                            }
                                        }
                                        */?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>-->


                </div>
                <br><br>
                <?php
                if($details['status']==0){ //display voting status for voters
                    if($today> $start && $today<$end){
                    echo ' <button name="save" class="w3-btn w3-block w3-text-white w3-hover-shadow w3-round-medium" style="background-color: #2ecd10 !important;">
                    Submit Vote
                        </button>
                       ';
                    }
                    else if($today< $start){
                        echo ' <a href="javascript:void(0)"  class="w3-btn w3-blue w3-block w3-text-white w3-hover-shadow w3-round-medium" style="">
                                   Voting is yet to start
                                </a>';
                    }
                    else{
                        echo '  <a href="javascript:void(0)" class="btn w3-block w3-text-white  w3-round-medium btn-danger" style="">
                                Voting already expired
                            </a>';
                    }
                }else{
                    echo '  <a href="javascript:void(0)" class="btn w3-block w3-text-white  w3-round-medium btn-danger" style="">
                    Vote already casted
                </a>';
                }
                ?>



                <script>
                    //script to allow voters to select preferred candidate using check box
                    //the scripts also prevents multiple candidate selection in a given category
                    $(document).ready(function(){
                        $('.w3-check').on('change', function(){ //on change of each checkbox input
                            let name = $(this).attr("name") //get the category name attribute
                            if($(this).prop("checked")){ //if the checkbox was checked
                                let others =  $('.w3-check').not($(this)) //get other checkboxes
                                others.each(function(index){ //foreach checkbox, any check box with the same category will be unchecked
                                    if($(this).attr("name")=== name){
                                        $(this).prop("checked",false)
                                    }
                                })

                            }
                        })
                    })
                </script>
            </form>



        </div>
    </div>
</div>




<?php
echo strtotime($start);
if($today<=$end){ ?>
<script>

    //timer countdown explaination
    //refer to coutdown.php for line by line explaination
    $(document).ready(function (){
        $(window).on('load', function(){
            let timer = <?php echo $end - $today ?>;
            let hour = Math.floor(timer/3600);
            let min = Math.floor((timer%3600)/60);
            let sec = timer% 3600 % 60;
            function setTime(id, value){
                if(value <= 9){
                    let newTime = String(value);
                    id.text(newTime.padStart(2,0))
                }else{
                    id.text(value);
                }
            }
            setTime($('.hour'),hour);
            setTime($('.min'),min);
            setTime($('.sec'),sec);
            localStorage.setItem('timer', timer);


            setInterval(function(){
                let newTime =  localStorage.getItem('timer')
                let countdown = parseInt(newTime)-1;
                let hour = Math.floor(countdown/3600);
                let min = Math.floor((countdown%3600)/60);
                //  let min = Math.floor(countdown/60);
                let sec = countdown% 3600 % 60;
                setTime($('.hour'),hour);
                setTime($('.min'),min);
                setTime($('.sec'),sec);
                localStorage.setItem('timer',countdown);
                if(countdown <=1){
                    $.ajax({
                        type:'POST',
                        url:'save-vote.php',
                        data:{
                            userID :<?php echo $_SESSION['voterLogger'] ?>
                             },
                        dataType:'text',
                            beforeSend: function () {
                            setTime($('.hour'),0);
                            setTime($('.min'),0);
                            setTime($('.sec'),0);

                        },
                          success: function () {
                        setTime($('.hour'),0);
                        setTime($('.min'),0);
                        setTime($('.sec'),0);
                        window.localStorage.clear();
                        window.location.reload();
                    }
                })
                }
            }, 1000);





        });
    })
</script>
<?php
}

include "footer.php";
