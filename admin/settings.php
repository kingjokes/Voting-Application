<?php


include ("header.php");

if(isset($_POST['submit'])){
  $query = $admin->updateSettings($_POST['start_date'],$_POST['end_date']);
    if($query){
        echo "<script>
                window.alert('Settings updated successfully');
                window.location.href='settings.php';
        </script>";
        exit;
    }

    echo "<script>
                 window.alert('Unable to update settings , kindly try again');
                window.location.href='settings.php';
            
        </script>";
}

?>
<div class="py-5">
    <div class="row">
        <div class="col-12 col-md-1 col-lg-1 col-sm-1">
            &nbsp;
        </div>
        <div class="col-12 col-md-10 col-lg-10 col-sm-10">
            <div class="card card-gray mb-3">
                <h4 class="card-header" style="margin-top: -2px"><i class="fa fa-calendar"></i> Election Date</h4>
                <div class="card-body">
                    <form method="post" enctype="application/x-www-form-urlencoded" class="">
                            <!---->
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label appformlabeldangericon="" for="start_date">Start Date<i class="danger-icon icon-attention"></i></label>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    </div>
                                                    <input
                                                            name="start_date"
                                                           class="form-control"
                                                            type="datetime-local"
                                                            required=""
                                                            value="<?php echo $settings[0] !== 0 ? $settings[1]['start_date'] :'' ?>"
                                                            placeholder="Start Date">
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label appformlabeldangericon="" for="end_date">End Date<i class="danger-icon icon-attention"></i></label>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    </div>
                                                    <input
                                                            name="end_date"
                                                            class="form-control"
                                                            type="datetime-local"
                                                            required=""
                                                            value="<?php echo $settings[0] !== 0 ? $settings[1]['end_date'] :'' ?>"
                                                            placeholder="End Date">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>



                        <!---->
                        <button class="btn btn-success ladda-button ng-star-inserted" name="submit" type="submit" data-style="zoom-in">
                            <span class="ladda-label">Save </span>
                            <span class="ladda-spinner"></span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>







    <?php
    include "footer.php";
    ?>


