<?php

include ("header.php");
$width=1;
?>
<div class="py-5">
    <div class="row">
        <div class="col-12 col-md-1 col-lg-1 col-sm-1">
            &nbsp;
        </div>
        <div class="col-12 col-md-10 col-lg-10 col-sm-10">
            <div id="accordion">

                <div class="card">
                    <div class="card-header  w3-white-text" style="background: #1c2a39; !important; color:white!important;">
                        <a class="card-link w3-block" data-toggle="collapse" href="#collapseOne" >
                            Presidential Candidates
                        </a>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="p-3">
                                <?php
                                $president = $admin->getCandidatePerPosition('president');
                                if($president[0]=== 0){
                                    echo 'No candidate found';
                                }else{
                                    ?>
                                    <div class="row">
                                        <?php
                                        while($result = $president[1]->fetch_assoc()){
                                            $width = $president[2]['total']==0 ? 0 :100 * round( $result["candidate_cvotes"] / $president[2]['total'], 2);
                                            ?>
                                            <div class="col-12 col-md-4 col-lg-4 col-sm-4 w3-margin-bottom">
                                                <div class="card ">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-md-4 col-lg-4 col-sm-4">
                                                                <img src="../candidates/<?php echo $result['image'] ?>" alt="<?php echo $result['candidate_name'] ?>" class="" style="     cursor: pointer; width: 100%; height: 90px;     border-radius: 0.25rem;">
                                                            </div>
                                                            <div class="col-12 col-md-8 col-lg-8 col-sm-8">
                                                                <h6 class="option-name font-weight-bold mb-0" "> <span class="text-capitalize"> <?php echo $result['candidate_name'] ?></span></h6>
                                                                <p class=" mb-0 mt-1 w3-text-gray" style="font-size: .85em;">Total Votes: <span class="badge badge-secondary ml-1"><?php echo $result['candidate_cvotes'] ?></span></p>
                                                                <div class=" mb-1 mt-2 " style="font-size: .85em;" >
                                                                    <div class=" bg-white w3-white w3-card w3-round-medium <?php echo $result['candidate_cvotes']==0 ? 'd-none' :'d-block'  ?>" style="">
                                                                        <div class="bg-success w3-container text-center w3-small  text-white " style="width: <?php echo $width.'%' ?>; padding: 2px 1px; height: 100% "><?php echo $width.'%' ?></div>
                                                                    </div>

                                                                </div>
                                                            </div>




                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header  w3-white-text" style="background: #1c2a39; !important; color:white!important;">
                        <a class="collapsed card-link w3-block" data-toggle="collapse" href="#collapseTwo">
                            Vice President Candidates
                        </a>
                    </div>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <div class="p-3">
                                <?php
                                $vice_president = $admin->getCandidatePerPosition('vice_president');
                                if($vice_president[0]=== 0){
                                    echo 'No candidate found';
                                }else{
                                    ?>
                                    <div class="row">
                                        <?php
                                        while($result = $vice_president[1]->fetch_assoc()){
                                            $width = $vice_president[2]['total']==0 ? 0 :100 * round( $result["candidate_cvotes"] / $vice_president[2]['total'], 2);
                                            ?>
                                            <div class="col-12 col-md-4 col-lg-4 col-sm-4 w3-margin-bottom">
                                                <div class="card ">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-md-4 col-lg-4 col-sm-4">
                                                                <img src="../candidates/<?php echo $result['image'] ?>" alt="<?php echo $result['candidate_name'] ?>" class="" style="     cursor: pointer; width: 100%; height: 90px;     border-radius: 0.25rem;">
                                                            </div>
                                                            <div class="col-12 col-md-8 col-lg-8 col-sm-8">
                                                                <h6 class="option-name font-weight-bold mb-0" "> <span class="text-capitalize"> <?php echo $result['candidate_name'] ?></span></h6>
                                                                <p class=" mb-0 mt-1 w3-text-gray" style="font-size: .85em;">Total Votes: <span class="badge badge-secondary ml-1"><?php echo $result['candidate_cvotes'] ?></span></p>
                                                                <div class=" mb-1 mt-2 " style="font-size: .85em;" >
                                                                    <div class=" bg-white w3-white w3-card w3-round-medium <?php echo $result['candidate_cvotes']==0 ? 'd-none' :'d-block'  ?>" style="">
                                                                        <div class="bg-success w3-container text-center w3-small  text-white " style="width: <?php echo $width.'%' ?>; padding: 2px 1px; height: 100% "><?php echo $width.'%' ?></div>
                                                                    </div>

                                                                </div>
                                                            </div>




                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header  w3-white-text" style="background: #1c2a39; !important; color:white!important;">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                            VP Diaspora Candidates
                        </a>
                    </div>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <div class="p-3">
                                <?php
                                $vp_diaspora = $admin->getCandidatePerPosition('vp_diaspora');
                                if($vp_diaspora[0]=== 0){
                                    echo 'No candidate found';
                                }else{
                                    ?>
                                    <div class="row">
                                        <?php
                                        while($result = $vp_diaspora[1]->fetch_assoc()){
                                            $width = $vp_diaspora[2]['total']==0 ? 0 :100 * round( $result["candidate_cvotes"] / $vp_diaspora[2]['total'], 2);
                                            ?>
                                            <div class="col-12 col-md-4 col-lg-4 col-sm-4 w3-margin-bottom">
                                                <div class="card ">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-md-4 col-lg-4 col-sm-4">
                                                                <img src="../candidates/<?php echo $result['image'] ?>" alt="<?php echo $result['candidate_name'] ?>" class="" style="     cursor: pointer; width: 100%; height: 90px;     border-radius: 0.25rem;">
                                                            </div>
                                                            <div class="col-12 col-md-8 col-lg-8 col-sm-8">
                                                                <h6 class="option-name font-weight-bold mb-0" "> <span class="text-capitalize"> <?php echo $result['candidate_name'] ?></span></h6>
                                                                <p class=" mb-0 mt-1 w3-text-gray" style="font-size: .85em;">Total Votes: <span class="badge badge-secondary ml-1"><?php echo $result['candidate_cvotes'] ?></span></p>
                                                                <div class=" mb-1 mt-2 " style="font-size: .85em;" >
                                                                    <div class=" bg-white w3-white w3-card w3-round-medium <?php echo $result['candidate_cvotes']==0 ? 'd-none' :'d-block'  ?>" style="">
                                                                        <div class="bg-success w3-container text-center w3-small  text-white " style="width: <?php echo $width.'%' ?>; padding: 2px 1px; height: 100% "><?php echo $width.'%' ?></div>
                                                                    </div>

                                                                </div>
                                                            </div>




                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header  w3-white-text" style="background: #1c2a39; !important; color:white!important;">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
                            General Secretary Candidates
                        </a>
                    </div>
                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <div class="p-3">
                                <?php
                                $general_secretary = $admin->getCandidatePerPosition('general_secretary');
                                if($general_secretary[0]=== 0){
                                    echo 'No candidate found';
                                }else{
                                    ?>
                                    <div class="row">
                                        <?php
                                        while($result = $general_secretary[1]->fetch_assoc()){
                                            $width = $general_secretary[2]['total']==0 ? 0 :100 * round( $result["candidate_cvotes"] / $general_secretary[2]['total'], 2);
                                            ?>
                                            <div class="col-12 col-md-4 col-lg-4 col-sm-4">
                                                <div class="card ">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-md-4 col-lg-4 col-sm-4">
                                                                <img src="../candidates/<?php echo $result['image'] ?>" alt="<?php echo $result['candidate_name'] ?>" class="" style="     cursor: pointer; width: 100%; height: 70px;     border-radius: 0.25rem;">
                                                            </div>
                                                            <div class="col-12 col-md-8 col-lg-8 col-sm-8">
                                                                <h6 class="option-name font-weight-bold mb-0" "> <span class="text-capitalize"> <?php echo $result['candidate_name'] ?></span></h6>
                                                                <p class=" mb-0 mt-1 w3-text-gray" style="font-size: .85em;">Total Votes: <span class="badge badge-secondary ml-1"><?php echo $result['candidate_cvotes'] ?></span></p>
                                                                <div class=" mb-1 mt-2 " style="font-size: .85em;" >
                                                                    <div class=" bg-white w3-white w3-card w3-round-medium <?php echo $result['candidate_cvotes']==0 ? 'd-none' :'d-block'  ?>" style="">
                                                                        <div class="bg-success w3-container text-center w3-small  text-white " style="width: <?php echo $width.'%' ?>; padding: 2px 1px; height: 100% "><?php echo $width.'%' ?></div>
                                                                    </div>

                                                                </div>
                                                            </div>




                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header  w3-white-text" style="background: #1c2a39; !important; color:white!important;">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseFive">
                            Assistant Secretary Candidates
                        </a>
                    </div>
                    <div id="collapseFive" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <div class="p-3">
                                <?php
                                $assistant_secretary = $admin->getCandidatePerPosition('assistant_secretary');
                                if($assistant_secretary[0]=== 0){
                                    echo 'No candidate found';
                                }else{
                                    ?>
                                    <div class="row">
                                        <?php
                                        while($result = $assistant_secretary[1]->fetch_assoc()){
                                            $width = $assistant_secretary[2]['total']==0 ? 0 :100 * round( $result["candidate_cvotes"] / $assistant_secretary[2]['total'], 2);
                                            ?>
                                            <div class="col-12 col-md-4 col-lg-4 col-sm-4 w3-margin-bottom">
                                                <div class="card ">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-md-4 col-lg-4 col-sm-4">
                                                                <img src="../candidates/<?php echo $result['image'] ?>" alt="<?php echo $result['candidate_name'] ?>" class="" style="     cursor: pointer; width: 100%; height: 90px;     border-radius: 0.25rem;">
                                                            </div>
                                                            <div class="col-12 col-md-8 col-lg-8 col-sm-8">
                                                                <h6 class="option-name font-weight-bold mb-0" "> <span class="text-capitalize"> <?php echo $result['candidate_name'] ?></span></h6>
                                                                <p class=" mb-0 mt-1 w3-text-gray" style="font-size: .85em;">Total Votes: <span class="badge badge-secondary ml-1"><?php echo $result['candidate_cvotes'] ?></span></p>
                                                                <div class=" mb-1 mt-2 " style="font-size: .85em;" >
                                                                    <div class=" bg-white w3-white w3-card w3-round-medium <?php echo $result['candidate_cvotes']==0 ? 'd-none' :'d-block'  ?>" style="">
                                                                        <div class="bg-success w3-container text-center w3-small  text-white " style="width: <?php echo $width.'%' ?>; padding: 2px 1px; height: 100% "><?php echo $width.'%' ?></div>
                                                                    </div>

                                                                </div>
                                                            </div>




                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header  w3-white-text" style="background: #1c2a39; !important; color:white!important;">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseSix">
                            Treasurer Candidates
                        </a>
                    </div>
                    <div id="collapseSix" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <div class="p-3">
                                <?php
                                $treasurer = $admin->getCandidatePerPosition('treasurer');
                                if($treasurer[0]=== 0){
                                    echo 'No candidate found';
                                }else{
                                    ?>
                                    <div class="row">
                                        <?php
                                        while($result = $treasurer[1]->fetch_assoc()){
                                            $width = $treasurer[2]['total']==0 ? 0 :100 * round( $result["candidate_cvotes"] / $treasurer[2]['total'], 2);
                                            ?>
                                            <div class="col-12 col-md-4 col-lg-4 col-sm-4 w3-margin-bottom">
                                                <div class="card ">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-md-4 col-lg-4 col-sm-4">
                                                                <img src="../candidates/<?php echo $result['image'] ?>" alt="<?php echo $result['candidate_name'] ?>" class="" style="     cursor: pointer; width: 100%; height: 90px;     border-radius: 0.25rem;">
                                                            </div>
                                                            <div class="col-12 col-md-8 col-lg-8 col-sm-8">
                                                                <h6 class="option-name font-weight-bold mb-0" "> <span class="text-capitalize"> <?php echo $result['candidate_name'] ?></span></h6>
                                                                <p class=" mb-0 mt-1 w3-text-gray" style="font-size: .85em;">Total Votes: <span class="badge badge-secondary ml-1"><?php echo $result['candidate_cvotes'] ?></span></p>
                                                                <div class=" mb-1 mt-2 " style="font-size: .85em;" >
                                                                    <div class=" bg-white w3-white w3-card w3-round-medium <?php echo $result['candidate_cvotes']==0 ? 'd-none' :'d-block'  ?>" style="">
                                                                        <div class="bg-success w3-container text-center w3-small  text-white " style="width: <?php echo $width.'%' ?>; padding: 2px 1px; height: 100% "><?php echo $width.'%' ?></div>
                                                                    </div>

                                                                </div>
                                                            </div>




                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="card">
                    <div class="card-header  w3-white-text" style="background: #1c2a39; !important; color:white!important;">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseSeven">
                            Financial Secretary Candidates
                        </a>
                    </div>
                    <div id="collapseSeven" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <div class="p-3">
                                <?php
                                $financial_secretary = $admin->getCandidatePerPosition('financial_secretary');
                                if($financial_secretary[0]=== 0){
                                    echo 'No candidate found';
                                }else{
                                    ?>
                                    <div class="row">
                                        <?php
                                        while($result = $financial_secretary[1]->fetch_assoc()){
                                            $width = $financial_secretary[2]['total']==0 ? 0 :100 * round( $result["candidate_cvotes"] / $financial_secretary[2]['total'], 2);
                                            ?>
                                            <div class="col-12 col-md-4 col-lg-4 col-sm-4 w3-margin-bottom">
                                                <div class="card ">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-md-4 col-lg-4 col-sm-4">
                                                                <img src="../candidates/<?php echo $result['image'] ?>" alt="<?php echo $result['candidate_name'] ?>" class="" style="     cursor: pointer; width: 100%; height: 90px;     border-radius: 0.25rem;">
                                                            </div>
                                                            <div class="col-12 col-md-8 col-lg-8 col-sm-8">
                                                                <h6 class="option-name font-weight-bold mb-0" "> <span class="text-capitalize"> <?php echo $result['candidate_name'] ?></span></h6>
                                                                <p class=" mb-0 mt-1 w3-text-gray" style="font-size: .85em;">Total Votes: <span class="badge badge-secondary ml-1"><?php echo $result['candidate_cvotes'] ?></span></p>
                                                                <div class=" mb-1 mt-2 " style="font-size: .85em;" >
                                                                    <div class=" bg-white w3-white w3-card w3-round-medium <?php echo $result['candidate_cvotes']==0 ? 'd-none' :'d-block'  ?>" style="">
                                                                        <div class="bg-success w3-container text-center w3-small  text-white " style="width: <?php echo $width.'%' ?>; padding: 2px 1px; height: 100% "><?php echo $width.'%' ?></div>
                                                                    </div>

                                                                </div>
                                                            </div>




                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="card">
                    <div class="card-header  w3-white-text" style="background: #1c2a39; !important; color:white!important;">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseEight">
                            Publicity Secretary Candidates
                        </a>
                    </div>
                    <div id="collapseEight" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <div class="p-3">
                                <?php
                                $publicity_secretary = $admin->getCandidatePerPosition('publicity_secretary');
                                if($publicity_secretary[0]=== 0){
                                    echo 'No candidate found';
                                }else{
                                    ?>
                                    <div class="row">
                                        <?php
                                        while($result = $publicity_secretary[1]->fetch_assoc()){
                                            $width = $publicity_secretary[2]['total']==0 ? 0 :100 * round( $result["candidate_cvotes"] / $publicity_secretary[2]['total'], 2);
                                            ?>
                                            <div class="col-12 col-md-4 col-lg-4 col-sm-4 w3-margin-bottom">
                                                <div class="card ">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-md-4 col-lg-4 col-sm-4">
                                                                <img src="../candidates/<?php echo $result['image'] ?>" alt="<?php echo $result['candidate_name'] ?>" class="" style="     cursor: pointer; width: 100%; height: 90px;     border-radius: 0.25rem;">
                                                            </div>
                                                            <div class="col-12 col-md-8 col-lg-8 col-sm-8">
                                                                <h6 class="option-name font-weight-bold mb-0" "> <span class="text-capitalize"> <?php echo $result['candidate_name'] ?></span></h6>
                                                                <p class=" mb-0 mt-1 w3-text-gray" style="font-size: .85em;">Total Votes: <span class="badge badge-secondary ml-1"><?php echo $result['candidate_cvotes'] ?></span></p>
                                                                <div class=" mb-1 mt-2 " style="font-size: .85em;" >
                                                                    <div class=" bg-white w3-white w3-card w3-round-medium <?php echo $result['candidate_cvotes']==0 ? 'd-none' :'d-block'  ?>" style="">
                                                                        <div class="bg-success w3-container text-center w3-small  text-white " style="width: <?php echo $width.'%' ?>; padding: 2px 1px; height: 100% "><?php echo $width.'%' ?></div>
                                                                    </div>

                                                                </div>
                                                            </div>




                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


    </div>
</div>






<?php
include "footer.php";
?>


