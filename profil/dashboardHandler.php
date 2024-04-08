<?php
session_start();

if($_SESSION['super_Admin']){
    header("Location: super_dashboard_map.php");
    exit();
}

else if($_SESSION['admin']){
    header("Location: profil\dashboard.php");
    exit();
}
else{
    header("Location: profil_user.php");
    exit();
}