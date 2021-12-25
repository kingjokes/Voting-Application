<?php

include ("header.php");
if(isset($_GET['delete'])){
    $query = $admin->deleteVoter($_GET['delete']);
    if($query){
        echo "<script>
                window.alert('voter deleted successfully');
                window.location.href='voters.php';
        </script>";
        exit;
    }

    echo "<script>
                 window.alert('Unable to delete voter, kindly try again');
                window.location.href='voters.php';
            
        </script>";
}
?>
<div class="py-5">
    <div class="row">
        <div class="col-12 col-md-1 col-lg-1 col-sm-1">
            &nbsp;
        </div>
        <div class="col-12 col-md-10 col-lg-10 col-sm-10">
            <div class="w3-responsive">
                <div class="w3-container mb-3">
                    <div class="w3-right">
                        <input type="text" class="w3-card w3-text-dark-gray w3-input  w3-padding w3-round-medium w3-tiny w3-border w3-text-white" id="input" placeholder="search voters">


                    </div>
                </div>
                <div id="print">
                    <h6 class="font-weight-bold">Voters List</h6>
                    <table class="w3-table-all data-table">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Dept</th>
                            <th>Faculty</th>
                            <th>Grade</th>
                            <th>Graduation</th>
                            <th>Vote status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($voters[0]===0){
                            ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>No data found</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <?php
                        }else{
                            $count=1;
                            while ($result = $voters[1]->fetch_assoc()){
                                ?>
                                <tr style="font-size: 14px">
                                    <td><?php echo $count ?></td>
                                    <td class="text-capitalize">
                                        <?php echo $result['surname'].' '.$result['other_names'] ?>
                                    </td>
                                    <td class="text-lowercase"><?php echo $result['email'] ?></td>
                                    <td>	<?php echo $result['dept']?></td>
                                    <td>	<?php echo $result['faculty']?></td>
                                    <td class="text-capitalize">	<?php echo str_replace('_',' ',$result['grade'])?></td>
                                    <td>	<?php echo $result['graduation']?></td>
                                    <td>
                                        <?php
                                        echo  $result['status']== 1
                                            ? ' <span class="text-success">voted</span'
                                            :' <span class="text-danger">not voted</span'
                                        ?>
                                        >
                                    </td>
                                    <td class="w3-hide">
                                        <a href="voters.php?delete=<?php echo $result['id'] ?>" class="w3-text-gray w3-hover-text-dark-gray ml-1" title="delete voter">
                                            <i class="fa fa-times"></i>
                                        </a>
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


                <br>
                <button class="w3-btn w3-teal w3-small w3-padding w3-card w3-round-medium " onclick="PrintDiv('print')">
                    <i class="fa fa-file-pdf"></i>
                    Print List
                </button>
            </div>
        </div>

    </div>
</div>

<script>
    function PrintDiv(id) {
        //generate pdf format
        var data=document.getElementById(id).innerHTML;
        var myWindow = window.open('', 'my div', 'height=900,width=1000');
        myWindow.document.write('<html><head><title>Ajayi Crowther Alumni Voters List</title>');
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


