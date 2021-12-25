<?php

include ("header.php");
if(!isset($_GET['editID'])){
    header('location:candidates.php');
}
if(isset($_POST['edit'])){
    $query = $admin->updateCandidate($_GET['editID'],$_POST['fullname'],$_POST['position'],$_FILES['avatar']);

    if($query){
        echo "<script>
                window.alert('Candidate details updated successfully');
                window.location.href='candidates.php';
        </script>";
        exit;
    }

    echo "<script>
                 window.alert('Unable to edit candidate details, kindly try again');
                window.location.href='edit-candidate.php?editID={$_GET["editID"]}';
            
        </script>";
}

$result = $admin->candidateDetails($_GET['editID']);

?>
<div class="py-5">
    <div class="row">
        <div class="col-12 col-md-3 col-lg-3 col-sm-3">
            &nbsp;
        </div>
        <div class="col-12 col-md-6 col-lg-6 col-sm-6 py-5">
            <h5> Edit- <span class="text-capitalize text-secondary " style="font-size: 15px"> <?php echo $result['candidate_name'] ?></span>
            </h5>
            <form action="edit-candidate.php?editID=<?php echo $_GET['editID']  ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                            </div>
                            <input name="fullname"  class="form-control" required="" value="<?php echo $result['candidate_name'] ?>" placeholder="Delegate's Name">
                        </div>
                        <span id="amt_msg"></span>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-list"></i>
                                    </span>
                            </div>
                            <select name="position"  class="form-control select" data-dropdown-css-class="bg-primary" data-fouc required>
                                <option value=""> Select Position</option>
                                <option value="president"> President </option>
                                <option value="vice_president"> Vice President </option>
                                <option value="vp_diaspora">  VP Diaspora </option>
                                <option value="general_secretary">  General Secretary </option>
                                <option value="assistant_secretary">Assistant Secretary </option>
                                <option value="treasurer"> Treasurer</option>
                                <option value="financial_secretary"> Financial Secretary </option>
                                <option value="publicity_secretary"> Publicity Secretary </option>


                            </select>
                        </div>
                        <span id="amt_msg"></span>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-file"></i>
                                    </span>
                            </div>
                            <input name="avatar[]"  class="form-control" type="file" accept="image/*"  placeholder="Passport">
                        </div>
                        <span id="amt_msg"></span>
                    </div>

                </div>

                <div class="text-right mb-3">
                    <button type="submit" id="sub_btn" name="edit"  class="btn btn-success btn-block">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>







<?php
include "footer.php";
?>

