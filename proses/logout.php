<?php
session_start();
session_destroy();
header('Location: ../views/auth/pages/login.php');
?>