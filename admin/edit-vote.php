<?php

include ("header.php");
include "../user/UserClass.php";
if($details['level']!=='super-admin'){?>
    <script type="text/javascript">
        window.location.href = 'dashboard.php';
    </script>

    <?php
}
if(isset($_POST['submit'])){
    $submit = (new UserClass($conn))->saveVote([
        "president" => $_POST["president"] ?? '',
        "vice_president" => $_POST["vice_president"] ?? '',
        "vp_diaspora" => $_POST["vp_diaspora"] ?? '',
        "general_secretary" => $_POST["general_secretary"] ?? '',
        "assistant_secretary" => $_POST["assistant_secretary"] ?? '',
        "treasurer" => $_POST["treasurer"] ?? '',
        "financial_secretary" => $_POST["financial_secretary"] ?? '',
        "publicity_secretary" => $_POST["publicity_secretary"] ?? '',
    ],$_POST['voter_id']);

    if($submit){
        echo "<script>
                window.alert('Vote updated successfully');
                window.location.href='edit-vote.php';
        </script>";
        exit;
    }

    echo "<script>
                 window.alert('Unable to edit vote , kindly try again');
                window.location.href='edit-vote.php';
            
        </script>";


}

$voteLog = $admin->getVoteBreakDown();
?>
<div class="py-5 px-2">
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12 col-sm-12">
            <div class="w3-responsive">
                <div class="w3-container mb-3">
                    <div class="w3-right">
                        <input type="text" class="w3-card w3-text-dark-gray w3-input  w3-padding w3-round-medium w3-tiny w3-border w3-text-white" id="input" placeholder="search voters">


                    </div>
                </div>
                <table class="w3-table-all w3-card-2 data-table">
                    <thead>
                    <tr class="w3-small">
                        <th class="w3-border w3-border-light-gray">SN</th>
                        <th class="w3-border w3-border-light-gray">Fullname</th>
                        <th class="w3-border w3-border-light-gray">Email</th>
                        <th class="w3-border w3-border-light-gray">Pres</th>
                        <th class="w3-border w3-border-light-gray">VPres</th>
                        <th class="w3-border w3-border-light-gray">VP Diaspora</th>
                        <th class="w3-border w3-border-light-gray">Gen Sec</th>
                        <th class="w3-border w3-border-light-gray">Asst Sec </th>
                        <th class="w3-border w3-border-light-gray">Treasurer </th>
                        <th class="w3-border w3-border-light-gray"> Fin Sec </th>
                        <th class="w3-border w3-border-light-gray">Pub Sec </th>
                        <th class="w3-border w3-border-light-gray">Status</th>
                        <th class="w3-border w3-border-light-gray">Action</th>
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
                                <td class="text-capitalize w3-border w3-border-light-gray">
                                    <?php echo $result['surname'].' '.$result['other_names'] ?>
                                </td>
                                <td class="text-lowercase w3-border w3-border-light-gray"><?php echo $result['email'] ?></td>
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

                                <td class="w3-border w3-border-light-gray">
                                    <?php
                                    echo  $result['status']== 1
                                        ? ' <span class="text-success">voted</span'
                                        :' <span class="text-danger">not voted</span'
                                    ?>
                                </td>
                                <td class="">
                                    <a href="javascript:void(0)" data-name="<?php echo $result['surname'].' '.$result['other_names'] ?>"  data-voter="<?php echo $result['id']  ?>" class="w3-text-gray w3-hover-text-dark-gray ml-1 edit" title="edit vote">
                                        <i class="fa fa-pencil"></i>
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
        </div>

    </div>
</div>

<div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0 h3">Edit Vote - <span class="text-info" id="voter_name">1</span> </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mt-2">
                <form action="edit-vote.php" method="post">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label for="president">President</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <select name="president"  class="form-control" >
                                    <option value="">select president</option>
                                    <?php
                                    $query = $admin->getCandidatePerPosition('president');
                                    if($query[0]=== 0){
                                        echo '<option value="">No candidate found</option>';
                                    }else{
                                    while($result = $query[1]->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $result['id'] ?>"> <?php echo $result['candidate_name'] ?></option>
                                        <?php
                                    }
                                    }
                                    ?>
                                </select>
                            </div>
                            <span id="amt_msg"></span>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label for="vice_president">Vice President </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <select name="vice_president"  class="form-control" >
                                    <option value="">select vice president</option>
                                    <?php
                                    $query = $admin->getCandidatePerPosition('vice_president');
                                    if($query[0]=== 0){
                                        echo '<option value="">No candidate found</option>';
                                    }else{
                                    while($result = $query[1]->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $result['id'] ?>"> <?php echo $result['candidate_name'] ?></option>
                                        <?php
                                    }
                                    }
                                    ?>
                                </select>
                            </div>
                            <span id="amt_msg"></span>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label for="vp_diaspora"> VP Diaspora </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <select name="vp_diaspora"  class="form-control" >
                                    <option value="">select  vp diaspora</option>
                                    <?php
                                    $query = $admin->getCandidatePerPosition('vp_diaspora');
                                    if($query[0]=== 0){
                                        echo '<option value="">No candidate found</option>';
                                    }else{
                                    while($result = $query[1]->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $result['id'] ?>"> <?php echo $result['candidate_name'] ?></option>
                                        <?php
                                    }
                                    }
                                    ?>
                                </select>
                            </div>
                            <span id="amt_msg"></span>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label for="general_secretary">  General Secretary </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <select name="general_secretary"  class="form-control" >
                                    <option value="">select  general secretary</option>
                                    <?php
                                    $query = $admin->getCandidatePerPosition('general_secretary');
                                    if($query[0]=== 0){
                                        echo '<option value="">No candidate found</option>';
                                    }else{
                                    while($result = $query[1]->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $result['id'] ?>"> <?php echo $result['candidate_name'] ?></option>
                                        <?php
                                    }
                                    }
                                    ?>
                                </select>
                            </div>
                            <span id="amt_msg"></span>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label for="assistant_secretary">  Assistant Secretary </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <select name="assistant_secretary"  class="form-control" >
                                    <option value="">select  general secretary</option>
                                    <?php
                                    $query = $admin->getCandidatePerPosition('general_secretary');
                                    if($query[0]=== 0){
                                        echo '<option value="">No candidate found</option>';
                                    }else{
                                    while($result = $query[1]->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $result['id'] ?>"> <?php echo $result['candidate_name'] ?></option>
                                        <?php
                                    }
                                    }
                                    ?>
                                </select>
                            </div>
                            <span id="amt_msg"></span>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label for="treasurer">  Treasurer </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <select name="treasurer"  class="form-control" >
                                    <option value="">select  treasurer</option>
                                    <?php
                                    $query = $admin->getCandidatePerPosition('treasurer');
                                    if($query[0]=== 0){
                                        echo '<option value="">No candidate found</option>';
                                    }else{
                                    while($result = $query[1]->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $result['id'] ?>"> <?php echo $result['candidate_name'] ?></option>
                                        <?php
                                    }
                                    }
                                    ?>
                                </select>
                            </div>
                            <span id="amt_msg"></span>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label for="financial_secretary">  Financial Secretary </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <select name="financial_secretary"  class="form-control" >
                                    <option value="">select  financial secretary</option>
                                    <?php
                                    $query = $admin->getCandidatePerPosition('financial_secretary');
                                    if($query[0]=== 0){
                                        echo '<option value="">No candidate found</option>';
                                    }else{
                                    while($result = $query[1]->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $result['id'] ?>"> <?php echo $result['candidate_name'] ?></option>
                                        <?php
                                    }
                                    }
                                    ?>
                                </select>
                            </div>
                            <span id="amt_msg"></span>
                        </div>

                    </div>
                    <input type="text" name="voter_id" class="form-group d-none " value="" id="voter_id">


                    <div class="text-right mb-3">
                        <button type="submit" id="sub_btn" name="submit"  class="btn btn-success btn-block">Update Vote</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {

        $('.edit').click(function(){
            $('#voter_name').text($(this).attr('data-name'))
            $('#voter_id').val($(this).attr('data-voter'))
            $('#modal-formx').modal('show')

        });
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


