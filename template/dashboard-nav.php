<?php

$type = "admin";

// include "../../template/user-data.php";

$this_profile_url = "";

if(isset($_SESSION['id']) && isset($_SESSION['account_type'])){

    

    if ($_SESSION['account_type'] == "customer") {
        $this_profile_url = "../assets/images/customer/".$user_profile_url;
    } else if ($_SESSION['account_type'] == "cashier") {
        $this_profile_url = "../assets/images/cashier/".$user_profile_url;
    } else if ($_SESSION['account_type'] == "technician") {
        $this_profile_url = "../assets/images/technician/".$user_profile_url;
    } else if ($_SESSION['account_type'] == "delivery_boy") {
        $this_profile_url = "../assets/images/delivery-boy/".$user_profile_url;
    } else if ($_SESSION['account_type'] == "admin") {
        $this_profile_url = "../assets/images/admin/".$user_profile_url;
    } else if ($_SESSION['account_type'] == "technical_team") {
        $this_profile_url = "../assets/images/technical_team/".$user_profile_url;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav class="active nav">
        <div class="nav-content">
            <div class="nav-content-1">
                <i class="ri-menu-line " id="dashboard-menu-icon"></i>
                <p>Dashboard</p>
            </div>
            <div class="nav-content-2">
                <!-- <a href="./message.php">
                    <i class="ri-mail-line"></i>
                </a>
                <a href="">
                    <i class="ri-notification-3-line"></i>
                </a> -->

                <a href="./settings.php" style="display: flex; align-items:center;">
                    <img src="<?php echo $this_profile_url?>" alt="">
                    <h1 style="margin-left:10px; font-family:sans-serif; font-size:14px; color:black;"><?php echo $user_first_name ." "; echo $user_last_name;?></h1>
                </a>

            </div>
        </div>
    </nav>
</body>

</html>