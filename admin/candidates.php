<?php

include ("header.php");

if(isset($_GET['delete'])){
    $query = $admin->deleteCandidate($_GET['delete']);
    if($query){
        echo "<script>
                window.alert('Candidate deleted successfully');
                window.location.href='candidates.php';
        </script>";
        exit;
    }

    echo "<script>
                 window.alert('Unable to delete candidate, kindly try again');
                window.location.href='candidates.php';
            
        </script>";
}
if(isset($_POST['submit'])){
    $query = $admin->addCandidate($_POST['fullname'],$_POST['position'],$_FILES['avatar']);
    if($query){
        echo "<script>
                window.alert('Candidate added successfully');
                window.location.href='candidates.php';
        </script>";
        exit;
    }

    echo "<script>
                 window.alert('Unable to add candidate , kindly try again');
                window.location.href='candidates.php';
            
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
                       <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm w3-small text-white btn-success mb-2">
                           <i class="fa fa-plus"></i>
                           Add New Candidate
                       </a>

                   </div>
               </div>

               <table class="w3-table-all">
                   <tr>
                       <th>SN</th>
                       <th>Fullname</th>
                       <th>Position</th>
                       <th>Action</th>
                   </tr>
                       <?php
                       if($candidates[0]===0){
                       ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>No data found</td>
                            <td>&nbsp;</td>
                        </tr>
                   <?php
                       }else{
                           $count=1;
                           while ($result = $candidates[1]->fetch_assoc()){
                   ?>
                   <tr>
                       <td><?php echo $count ?></td>
                       <td>
                           <img src="../candidates/<?php echo $result['image'] ?>" alt="<?php echo $result['candidate_name'] ?>" class="" style="width:30px; height: 30px; border-radius: 50%">
                           <span class="text-capitalize"> <?php echo $result['candidate_name'] ?></span>
                       </td>
                       <td class="text-capitalize"><?php echo str_replace('_',' ',$result['candidate_position']) ?></td>
                       <td>
                           <a href="edit-candidate.php?editID=<?php echo $result['id'] ?>" class="w3-text-gray w3-hover-text-dark-gray mr-1" title="edit candidate">
                               <i class="fa fa-pencil"></i>
                               Edit
                           </a>
                           |
                           <a href="candidates.php?delete=<?php echo $result['id'] ?>" class="w3-text-gray w3-hover-text-dark-gray ml-1" title="delete candidate">
                               <i class="fa fa-times"></i>
                               Delete
                           </a>
                       </td>

                   </tr>
                   <?php
                               $count++;
                           }
                       }
                   ?>
               </table>
           </div>
        </div>

    </div>
</div>

<div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0 h3">New Candidate</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mt-2">
                <form action="candidates.php" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input name="fullname"  class="form-control" required="" placeholder="Delegate's Name">
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
                                <select name="position" class="form-control select" data-dropdown-css-class="bg-primary" data-fouc required>
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
                                <input name="avatar[]"  class="form-control" type="file" accept="image/*" required="" placeholder="Passport">
                            </div>
                            <span id="amt_msg"></span>
                        </div>

                    </div>

                    <div class="text-right mb-3">
                        <button type="submit" id="sub_btn" name="submit"  class="btn btn-success btn-block">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<?php
include "footer.php";
?>

