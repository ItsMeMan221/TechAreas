<?php
session_start();
$data = array();
$tempArtikel = array();
$id_admin = $_SESSION['data_admin']['id'];
if (isset($_POST['req'])) {
    $reqT = $_POST['req'];
    require '../components/dbconn.php';
    //data untuk memenuhi table
    if ($reqT == 'allVal') {
        $id_spek = $_POST['id'];
        $queryTemp = $conn->prepare("SELECT * FROM spesifikasi WHERE id = $id_spek");
        if ($queryTemp->execute()) {
            $resTemp = $queryTemp->get_result();
            while ($rowTemp = $resTemp->fetch_assoc()) {
                echo json_encode($rowTemp);
            }
        }
    }
}
