<?php

include ("header.php");
if($details['level']!=='super-admin'){?>
    <script type="text/javascript">
        window.location.href = 'dashboard.php';
    </script>

<?php
}
if(isset($_POST['submit'])){
    $query = $admin->uploadVoters($_FILES['file']);

    if($query === "ok"){
        echo "<script>
                window.alert('voters uploaded successfully');
                window.location.href='voters.php';
        </script>";
        exit;
    }

    echo "<script>
                 window.alert('{$query}');
                window.location.href='upload-voters.php';
            
        </script>";
}
?>
<div class="py-5">
    <div class="row w3-padding">
        <div class="col-12 col-md-3 col-lg-3 col-sm-3">
            &nbsp;
        </div>
        <div class="col-12 col-md-6 col-lg-6 col-sm-6">

            <form action="upload-voters.php" class="w3-border w3-round-medium py-5 px-4" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-file"></i>
                                    </span>
                                    </div>
                                    <input name="file" type="file" accept=".xls,.xlsx,.csv" class="form-control" required="" placeholder="">
                                </div>
                                <span id="amt_msg"></span>
                            </div>

                        </div>

                        <div class="text-right mb-3">
                            <button type="submit" id="sub_btn" name="submit"  class="btn btn-success btn-block">Upload File</button>
                        </div>
                    </form>
        </div>

    </div>
</div>






<?php
include "footer.php";
?>