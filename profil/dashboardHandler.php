<?php
session_start();

if($_SESSION['super_Admin']){
    header("Location: profil\super_dashboard.php");
    exit();
}

else if($_SESSION['admin']){
    header("Location: profil\dashboard.php");
    exit();
}
else{
    header("Location: profil\profil.php");
    exit();
}