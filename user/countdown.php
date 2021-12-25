<?php
include 'headers.php';

date_default_timezone_set("Africa/Lagos"); //set default time zone to africa/lagos, can be changed

$settings = $admin->getSettings(); //gets the voting time setting
$start= strtotime($settings[1]['start_date']); //converts start date to string time
$end= strtotime($settings[1]['end_date']);//converts end date to string time
$today = strtotime(date('Y-m-d H:i:s')); //gets the current string time
if($today> $start){
    header("location:dashboard.php"); //if current time is greater than the start date, redirect users into voting page
    exit;
}


?>

<div class="w3-padding-64">

    <div class="row mt-5">
        <div class="col-12 col-md-4 col-lg-3 col-sm-3">
            &nbsp;
        </div>
        <div class="col-12 col-md-4 col-lg-6 col-sm-6">
           <div class="text-center p-3">
               <div class=" w3-center">
                   <img class="w3-image " style="height:90px; width:90px" src="../images/logo.png">
               </div>
               <br>
               <div class="w3-xxlarge  p-2"  style="border: 1px dashed #141d28">
                   COUNT DOWN
               </div>
               <br>
               <div class="w3-jumbo font-weight-bold"  style="color: #141d28;">
                   <span class="hour">00</span> :
                   <span class="min">00</span> :
                   <span class="sec">00</span>

               </div>
               <br>
               <b class="w3-large">
                   <?php echo date('d-m-Y, H:i A', $start) ?>
               </b>
           </div>
        </div>
    </div>

</div>



    <script>

        /*script to display the countdown time for voting if the voting is yet to start*/
        $(document).ready(function (){
            $(window).on('load', function(){
                let timer = <?php echo $start - $today ?>; //get the time difference between start date and current date
                let hour = Math.floor(timer/3600);  //extract hour from the time difference
                let min = Math.floor((timer%3600)/60); //extract min from the time difference
                let sec = timer% 3600 % 60; //extract seconds from the time difference

                //function to update time countdown on DOM
                function setTime(id, value){
                    if(value <= 9){
                        let newTime =String(value); //convert value to string format
                        return  id.text(newTime.padStart(2,0)) //if time is less than 9, add a zero to the left e.g 9 becomes 09
                    }
                      return  id.text(value);

                }
                setTime($('.hour'),hour); //applies function for time format
                setTime($('.min'),min); //applies function for time format
                setTime($('.sec'),sec); //applies function for time format

                localStorage.setItem('timer', timer); //store time into local storage


                //interval of 1s to decrement time
                setInterval(function(){
                    let newTime =  localStorage.getItem('timer') //get time from local storage
                    let countdown = parseInt(newTime)-1; //reduce time by 1
                    let hour = Math.floor(countdown/3600); //extract hour from the countdown
                    let min = Math.floor((countdown%3600)/60); //extract min from the countdown
                    let sec = countdown% 3600 % 60;  //extract secs from the countdown

                    setTime($('.hour'),hour);//applies function for time format
                    setTime($('.min'),min);//applies function for time format
                    setTime($('.sec'),sec);//applies function for time format
                    localStorage.setItem('timer',countdown); //update local storage with new timer

                    if(countdown <=1){ //if countdown timer is < 1, redirect user to voting page
                        window.alert("Voting has started")
                        window.localStorage.clear();//clear local storage
                        window.location.reload();// reload web page
                    }
                }, 1000);





            });
        })

    </script>

<?php

include "footer.php";
