<?php

include ("header.php");
$width=1;
?>
<div class="py-5">
    <div class="row w3-padding">
        <div class="col-12 col-md-1 col-lg-1 col-sm-1">
            &nbsp;
        </div>
        <div class="col-12 col-md-10 col-lg-10 col-sm-10">
            <div class="w3-container mb-3">
                <div class="w3-left">
                    <a onclick="PrintDiv('print')" href="javascript:void(0)" class="print w3-teal w3-btn w3-small w3-round-medium">
                        Print Result
                    </a>
                </div>
            </div>
         <div id="accordion">
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
                    <div class="card-header  w3-white-text" style="background: #1c2a39; !important; color:white!important;">
                        <a class="card-link w3-block text-capitalize" data-toggle="collapse" href="#collapse<?php echo $count?>" >
                            <?php echo str_replace('_',' ',$position) ?> Candidates
                        </a>
                    </div>
                    <div id="collapse<?php echo $count?>" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="p-3">
                                <?php
                                $query = $admin->getCandidatePerPosition($position);

                                if($query[0]=== 0){
                                    echo 'No candidate found';
                                }else{
                                    ?>
                                    <div class="row">
                                        <?php
                                        while($result = $query[1]->fetch_assoc()){

                                            ?>
                                            <div class="col-12 col-md-4 col-lg-4 col-sm-4 w3-margin-bottom">
                                                <div class="card ">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6 col-lg-5 col-sm-6 w3-margin-bottom">
                                                                <img
                                                                        src="../candidates/<?php echo $result['image'] ?>"
                                                                        alt="<?php echo $result['candidate_name'] ?>"
                                                                        class="" style="     cursor: pointer; height: 100px; width: 100%; max-height: 200px;     border-radius: 0.25rem;">
                                                            </div>
                                                            <div class="col-12 col-md-6 col-lg-7 col-sm-6">
                                                                <h6 class="option-name font-weight-bold mb-0">
                                                                    <span class="text-capitalize">
                                                                    <?php echo $result['candidate_name'] ?>
                                                                </span>
                                                                </h6>
                                                                <p class=" mb-0 mt-1 w3-text-gray" style="font-size: .85em;">
                                                                    Total Votes:
                                                                    <span class="badge badge-secondary ml-1">
                                                                        <?php echo $admin->getCandidateVoteCount($result['id'],$position);?>
                                                                    </span>
                                                                </p>
                                                                <div class=" mb-1 mt-2 " style="font-size: .85em;" >
                                                                    <div
                                                                            class=" bg-white w3-white w3-card w3-round-medium
                                                                             <?php
                                                                            $width =$query[3]===0
                                                                                ? 0
                                                                                :100 * round( $admin->getCandidateVoteCount($result['id'],$position) / $query[3], 2);
                                                                            echo
                                                                                $admin->getCandidateVoteCount($result['id'],$position) ===0
                                                                                ? 'd-none' :'d-block'
                                                                            ?>"
                                                                            style=""
                                                                    >
                                                                        <div class="bg-success w3-container text-center small  text-white " style="width: <?php echo $width.'%' ?>; padding: 2px 1px; height: 100% ">
                                                                            <?php
                                                                          echo $width.'%'
                                                                            ?>
                                                                        </div>
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
                <?php
                $count++;
                endforeach;



                ?>
            </div>
            <div id="print" style="display: none">
                <table class="w3-table-all data-table">
                    <thead>
                    <tr class="w3-small">
                      <th class="w3-border w3-border-light-gray">SN</th>
                      <th class="w3-border w3-border-light-gray">Position</th>
                      <th class="w3-border w3-border-light-gray">Result BreakDown</th>
                      <th class="w3-border w3-border-light-gray">Total Votes</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $count=1;
                    foreach ($positions as $position):
                        $query = $admin->getCandidatePerPosition($position);
                    ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td style="text-transform: capitalize"><?php echo str_replace('_',' ',$position) ?></td>
                            <td>
                                <?php
                                if($query[0]=== 0){
                                    echo 'No candidate found';
                                }else{
                                    ?>
                                    <div class="d-flex flex-column" style="margin-bottom: 5px;">
                                        <?php
                                        while($result = $query[1]->fetch_assoc()){?>
                                            <div>
                                                <span class="text-capitalize">
                                                    <?php echo $result['candidate_name'] ?> :
                                                      <?php echo $admin->getCandidateVoteCount($result['id'],$position);?>
                                                </span>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <?php
                                }
                                ?>

                            </td>
                            <td><b><?php echo $query[3] ?></b></td>
                        </tr>
                    <?php
                    $count++;
                    endforeach;
                    ?>
                    </tbody>


                </table>
            </div>
        <script>
            function PrintDiv(id) {
                //generate pdf format
                const data=document.getElementById(id).innerHTML;
                const myWindow = window.open('', 'my div', 'height=900,width=1000');
                myWindow.document.write('<html><head><title>Ajayi Crowther Alumni Voting Result</title>');
                myWindow.document.write('<link rel="stylesheet" href="../w3.css" type="text/css" />');
                myWindow.document.write('</head><body >');
                myWindow.document.write(data);
                myWindow.document.write('</body></html>');
                myWindow.document.close(); // necessary for IE >= 10

                myWindow.onload=function(){ // necessary if the div contain images

                    myWindow.focus(); // necessary for IE >= 10
                    myWindow.print();
                    myWindow.close();
                };
            }
        </script>
    </div>
</div>






<?php
include "footer.php";
?>


