<!-- Top Bar Start -->
<div class="topbar" style="background-color: #2c3e50; padding: 15px 0; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">

    <nav class="navbar-custom" style="padding: 0 20px;">

        <ul class="list-unstyled topbar-right-menu float-right mb-0" style="margin-right: 20px;">
            <?php                                        
            $ret=mysqli_query($con,"select tblservicerequest.ServiceNumber,tblservicerequest.ID as apid, tbluser.FullName,tblservicerequest.ServicerequestDate from tblservicerequest inner join tbluser on tbluser.ID=tblservicerequest.UserId where tblservicerequest.AdminStatus is null");
            $num=mysqli_num_rows($ret); ?>
            
            <li class="dropdown notification-list" style="position: relative;">
                <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false" style="color: #ffffff;">
                    <i class="fi-bell noti-icon" style="font-size: 18px;"></i>
                    <span class="badge badge-danger badge-pill noti-icon-badge" style="position: absolute; top: -10px; right: -10px;"><?php echo $num; ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg" style="width: 300px;">

                    <div class="dropdown-item noti-title" style="padding: 10px;">
                        <h5 class="m-0" style="font-size: 16px; font-weight: bold;">Notifications</h5>
                        <hr style="margin: 5px 0;" />
                    </div>

                    <div class="slimscroll" style="max-height: 230px;">
                        <?php   
                        if($num > 0) {                                 
                        while ($row=mysqli_fetch_array($ret)) { ?>
                            <a href="view-service-request.php?aticid=<?php echo $row['apid']; ?>" class="dropdown-item notify-item" style="display: flex; padding: 10px;">
                                <div class="notify-icon bg-success" style="border-radius: 50%; padding: 10px;">
                                    <i class="mdi mdi-comment-account-outline" style="font-size: 18px; color: white;"></i>
                                </div>
                                <p class="notify-details" style="margin-left: 10px;">
                                    New Request Received <?php echo $row['ServiceNumber']; ?><br>
                                    <small class="text-muted">at <?php echo $row['ServicerequestDate']; ?></small>
                                </p>
                            </a>
                        <?php }} else { ?>
                            <p align="center" style="padding: 10px; color: #999;">No Request found</p>
                        <?php } ?>
                    </div>

                    <!-- All-->
                    <a href="pending-service.php" class="dropdown-item text-center text-primary notify-item notify-all" style="padding: 10px;">
                        View all <i class="fi-arrow-right"></i>
                    </a>

                </div>
            </li>

            <?php
            $adid=$_SESSION['adid'];
            $ret=mysqli_query($con,"select AdminName from tbladmin where ID='$adid'");
            $row=mysqli_fetch_array($ret);
            $name=$row['AdminName'];
            ?>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false" style="color: #ffffff;">
                    <img src="assets/images/user.png" alt="user" class="rounded-circle" style="width: 30px; height: 30px;">
                    <span class="ml-1"><?php echo $name; ?> <i class="mdi mdi-chevron-down"></i></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                    <!-- item-->
                    <div class="dropdown-item noti-title" style="padding: 10px;">
                        <h6 class="text-overflow m-0">Welcome!</h6>
                    </div>

                    <!-- item-->
                    <a href="admin-profile.php" class="dropdown-item notify-item" style="padding: 10px;">
                        <i class="fi-head"></i> <span>My Profile</span>
                    </a>

                    <!-- item-->
                    <a href="changepassword.php" class="dropdown-item notify-item" style="padding: 10px;">
                        <i class="fi-cog"></i> <span>Change Password</span>
                    </a>

                    <a href="logout.php" class="dropdown-item notify-item" style="padding: 10px;">
                        <i class="fi-power"></i> <span>Logout</span>
                    </a>

                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0" style="margin-left: 20px;">
            <li class="float-left">
                <button class="button-menu-mobile open-left disable-btn" style="border: none; background: none; color: #ffffff;">
                    <i class="dripicons-menu" style="font-size: 24px;"></i>
                </button>
            </li>
        </ul>

    </nav>

</div>
<!-- Top Bar End -->
