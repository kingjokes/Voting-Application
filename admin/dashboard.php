<?php

include ("header.php");
?>
<div class="py-5">
    <div class="row w3-padding">
        <div class="col-12 col-md-2 col-lg-2 col-sm-2">
            &nbsp;
        </div>
        <div class="col-12 col-md-8 col-lg-8 col-sm-8 w3-padding">
            <div class="row">
                <div class="col-12 col-md-6 mb-4 ">
                    <div class="card card-widget w3-card-4 card-widget-warning" style="background: #ff6900;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-users w3-jumbo" style="color: #ffb480;"></i>
                                <div class="ml-auto d-flex flex-column align-items-end">
                                    <!----><h2 class="w3-text-white"><?php echo $voters[0] ?></h2>
                                    <!---->
                                    <span class="w3-text-white">Voters</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-4 ">
                    <div class="card card-widget w3-card-4 card-widget-warning" style="background: #ef0872;;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-users w3-jumbo" style="color: #fb7cb6;;"></i>
                                <div class="ml-auto d-flex flex-column align-items-end">
                                    <!----><h2 class="w3-text-white"><?php echo $candidates[0] ?></h2>
                                    <!---->
                                    <span class="w3-text-white">Candidates</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <div class="card w3-card">
                        <h5 class="card-header w3-light-gray" style="margin-top: -2px">
                            <!----><i class="fa fa-calendar"></i>
                            Start Date
                        </h5>
                        <div class="card-body">

                            <h6 class="mb-3" id="startDate">
                                <?php
                                  echo  $settings[0] === 0
                                ? 'Not Yet Set' : date('d-M-Y, h:i A',strtotime($settings[1]['start_date']))
                                ?>


                            </h6>

                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-6 mb-4">
                    <div class="card w3-card">
                        <h5 class="card-header w3-light-gray" style="margin-top: -2px">
                            <!----><i class="fa fa-calendar"></i>
                            End Date
                        </h5>
                        <div class="card-body">

                            <h6 class="mb-3" id="startDate">
                                <?php
                                echo  $settings[0] === 0
                                    ? 'Not Yet Set' : date('d-M-Y, h:i A',strtotime($settings[1]['end_date']))
                                ?>
                            </h6>

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
