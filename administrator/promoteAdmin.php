<?php
session_start();
require '../components/dbconn.php';
if ($_SESSION['auth_admin'] == true && $_SESSION['data_admin']['role_id'] == 2) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $queryLogin = $conn->prepare("UPDATE login_admin SET role_id = 2  WHERE id = ?");
        $queryLogin->bind_param("i", $id);
        if ($queryLogin->execute()) {
            header('location: listAdmin.php?m=1');
        } else {
            header('location: listAdmin.php?m=0');
        }
    }
}
