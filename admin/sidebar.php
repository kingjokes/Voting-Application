
<div  style="   background: #1c2a39;">
    <div class="w3-bar-block">
        <div class="w3-bar-item " style="background-color: #0bacfa; padding:1.3em 1em;">
            <span class="w3-text-white"> <i class="fa fa-link"></i> Menu Links</span>
        </div>
        <div class="w3-bar-item w3-text navigation-link  <?php echo $admin->compareNavLink('dashboard',$path) ?>"
             style="color: hsla(0,0%,100%,.8); font-size: 1em;">
            <a href="dashboard.php" class="w3-block " style="padding:8px 10px">

                <i class="fa fa-home" style="font-size: 1.1em; margin-right: 0.3rem"></i>
                Dashboard
            </a>
        </div>
        <div class="w3-bar-item w3-text navigation-link  <?php echo $admin->compareNavLink('candidates',$path) ?>"
             style="color: hsla(0,0%,100%,.8); font-size: 1em;">
            <a href="candidates.php" class="w3-block " style="padding:8px 10px">

                <i class="fa fa-users" style="font-size: 1.1em; margin-right: 0.3rem"></i>
                Candidates
            </a>
        </div>
        <div class="w3-bar-item w3-text navigation-link  <?php echo $admin->compareNavLink('voters',$path) ?>"
             style="color: hsla(0,0%,100%,.8); font-size: 1em;">
            <a href="voters.php" class="w3-block " style="padding:8px 10px">

                <i class="fa fa-user" style="font-size: 1.1em; margin-right: 0.3rem"></i>
                Voters
            </a>
        </div>
        <div class="w3-bar-item w3-text navigation-link  <?php echo $admin->compareNavLink('results',$path) ?>"
             style="color: hsla(0,0%,100%,.8); font-size: 1em;">
            <a href="results.php" class="w3-block " style="padding:8px 10px">

                <i class="fa fa-list-alt" style="font-size: 1.1em; margin-right: 0.3rem"></i>
                Results
            </a>
        </div>
        <div class="w3-bar-item w3-text navigation-link  <?php echo $admin->compareNavLink('settings',$path) ?>"
             style="color: hsla(0,0%,100%,.8); font-size: 1em;">
            <a href="settings.php" class="w3-block " style="padding:8px 10px">

                <i class="fa fa-gears" style="font-size: 1.1em; margin-right: 0.3rem"></i>
                Settings
            </a>
        </div>
        <div class="w3-bar-item w3-text navigation-link  <?php echo $admin->compareNavLink('logout',$path) ?>"
             style="color: hsla(0,0%,100%,.8); font-size: 1em;">
            <a href="logout.php" class="w3-block " style="padding:8px 10px">

                <i class="fa fa-sign-out" style="font-size: 1.1em; margin-right: 0.3rem"></i>
                Logout
            </a>
        </div>

    </div>

</div>
