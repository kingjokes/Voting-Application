<?php

include ("header.php");
include "../user/UserClass.php";

$voteLog = $admin->getVoteBreakDown();
?>
<div class="py-5 px-2">
    <div class="row w3-padding">

        <div class="col-12 col-md-12 col-lg-12 col-sm-12">
            <div class="w3-container mb-3">
                <div class="w3-left">
                    <a onclick="PrintDiv('print')" href="javascript:void(0)" class="print w3-teal w3-btn w3-small w3-round-medium">
                        Print All votes
                    </a>
                </div>
                <div class="w3-right">
                    <input type="text" class="w3-card w3-text-dark-gray w3-input  w3-padding w3-round-medium w3-tiny w3-border w3-text-white" id="input" placeholder="search voters">
                </div>
            </div>
            <div class="w3-responsive">

                <div id="print" style="padding:20px 5px;">
                    <table class="w3-table-all w3-card-2 data-table">
                        <thead>
                        <tr class="w3-small">
                            <th class="w3-border w3-border-light-gray">SN</th>
                            <th class="w3-border w3-border-light-gray">Matric</th>
                            <th class="w3-border w3-border-light-gray">Fullname</th>
                            <th class="w3-border w3-border-light-gray">Grade</th>
                            <th class="w3-border w3-border-light-gray">Dept</th>
                            <th class="w3-border w3-border-light-gray">Pres</th>
                            <th class="w3-border w3-border-light-gray">VPres</th>
                            <th class="w3-border w3-border-light-gray">VP Diaspora</th>
                            <th class="w3-border w3-border-light-gray">Gen Sec</th>
                            <th class="w3-border w3-border-light-gray">Asst Sec </th>
                            <th class="w3-border w3-border-light-gray">Treasurer </th>
                            <th class="w3-border w3-border-light-gray"> Fin Sec </th>
                            <th class="w3-border w3-border-light-gray">Pub Sec </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($voteLog[0]===0){
                            ?>
                            <tr class="w3-small">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>No data found</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <?php
                        }else{
                            $count=1;
                            while ($result = $voteLog[1]->fetch_assoc()){
                                ?>
                                <tr style="font-size: 12px">

                                    <td class=" w3-border w3-border-light-gray"><?php echo $count ?></td>
                                    <td class="text-uppercase w3-border w3-border-light-gray"><?php echo $result['matric_no'] ?></td>
                                    <td class="text-capitalize w3-border w3-border-light-gray">
                                        <?php echo $result['surname'].' '.$result['other_names'] ?>
                                    </td>
                                    <td class="text-capitalize w3-border w3-border-light-gray">
                                        <?php echo str_replace('_',' ',$result['grade']) ?>
                                    </td>
                                    <td class="text-capitalize w3-border w3-border-light-gray">
                                        <?php echo str_replace('_',' ',$result['dept']) ?>
                                    </td>

                                    <td class="w3-border w3-border-light-gray">
                                        <?php
                                        echo $result['president']==''
                                            ? '<span class="w3-text-red">no vote</span>'
                                            : '<span class="text-success">'.($admin->candidateDetails($result['president']))['candidate_name'].'</span>'
                                        ?>
                                    </td>
                                    <td class="w3-border w3-border-light-gray">
                                        <?php
                                        echo $result['vice_president']==''
                                            ? '<span class="w3-text-red">no vote</span>'
                                            : '<span class="text-success">'.($admin->candidateDetails($result['vice_president']))['candidate_name'].'</span>'
                                        ?>
                                    </td>
                                    <td class="w3-border w3-border-light-gray">
                                        <?php
                                        echo $result['vp_diaspora']==''
                                            ? '<span class="w3-text-red">no vote</span>'
                                            : '<span class="text-success">'.($admin->candidateDetails($result['vp_diaspora']))['candidate_name'].'</span>'
                                        ?>
                                    </td>
                                    <td class="w3-border w3-border-light-gray">
                                        <?php
                                        echo $result['general_secretary']==''
                                            ? '<span class="w3-text-red">no vote</span>'
                                            : '<span class="text-success">'.($admin->candidateDetails($result['general_secretary']))['candidate_name'].'</span>'
                                        ?>
                                    </td>
                                    <td class="w3-border w3-border-light-gray">
                                        <?php
                                        echo $result['assistant_secretary']==''
                                            ? '<span class="w3-text-red">no vote</span>'
                                            : '<span class="text-success">'.($admin->candidateDetails($result['assistant_secretary']))['candidate_name'].'</span>'
                                        ?>
                                    </td>
                                    <td class="w3-border w3-border-light-gray">
                                        <?php
                                        echo $result['treasurer']==''
                                            ? '<span class="w3-text-red">no vote</span>'
                                            : '<span class="text-success">'.($admin->candidateDetails($result['treasurer']))['candidate_name'].'</span>'
                                        ?>
                                    </td>
                                    <td class="w3-border w3-border-light-gray">
                                        <?php
                                        echo $result['financial_secretary']==''
                                            ? '<span class="w3-text-red">no vote</span>'
                                            : '<span class="text-success">'.($admin->candidateDetails($result['financial_secretary']))['candidate_name'].'</span>'
                                        ?>
                                    </td>
                                    <td class="w3-border w3-border-light-gray">
                                        <?php
                                        echo $result['publicity_secretary']==''
                                            ? '<span class="w3-text-red">no vote</span>'
                                            : '<span class="text-success">'.($admin->candidateDetails($result['publicity_secretary']))['candidate_name'].'</span>'
                                        ?>
                                    </td>


                                </tr>
                                <?php
                                $count++;
                            }
                        }
                        ?>
                        </tbody>

                    </table>
                </div>

            </div>

        </div>

    </div>
</div>




<script>
    function PrintDiv(id) {
        //generate pdf format
        var data=document.getElementById(id).innerHTML;
        var myWindow = window.open('', 'my div', 'height=900,width=1000');
        myWindow.document.write('<html><head><title>Ajayi Crowther Alumni Voting Log</title>');
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
    $(document).ready(function () {


        $('#input').on('keyup', function () {
            let value = $(this).val().toLowerCase();
            $('.data-table tbody tr').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

    })
</script>


<?php
include "footer.php";
?>


