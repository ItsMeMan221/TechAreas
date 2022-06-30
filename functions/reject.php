<?php
session_start();
require '../components/dbconn.php';
if ($_SESSION['auth_admin'] == true && $_SESSION['data_admin']['role_id'] == 2 && $_GET['page'] == 'artikel') {
    if (isset($_GET['id'])) {
        $id_artikel = $_GET['id'];
        $queryAppr = $conn->prepare("UPDATE artikel SET status_id = 3 WHERE id = ?");
        $queryAppr->bind_param("i", $id_artikel);
        if ($queryAppr->execute()) {
            header("location:../administrator/inboxArtikel.php?s=1");
        } else {
            header("location:../administrator/inboxArtikel.php?s=0");
        }
    }
}
if ($_SESSION['auth_admin'] == true && $_SESSION['data_admin']['role_id'] == 2 && $_GET['page'] == 'spek') {
    if (isset($_GET['id'])) {
        $id_spek = $_GET['id'];
        $queryAppr = $conn->prepare("UPDATE spesifikasi SET status_id = 3 WHERE id = ?");
        $queryAppr->bind_param("i", $id_spek);
        if ($queryAppr->execute()) {
            header("location:../administrator/inboxSpek.php?s=1");
        } else {
            header("location:../administrator/inboxSpek.php?s=0");
        }
    }
}
