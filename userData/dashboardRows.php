<?php
session_start();
include '../components/dbconn.php';
$reqT = $_REQUEST['req'];
$data = array();
if (isset($reqT)) {
    if ($reqT == 'dataArtikel') {
        $query = $conn->prepare("SELECT * FROM artikel WHERE status_id = 2 ORDER BY tanggal_dibuat DESC LIMIT 6 ");
        if ($query->execute()) {
            $res = $query->get_result();
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
    }
    if ($reqT == 'dataSpek') {
        $query = $conn->prepare("SELECT * FROM spesifikasi WHERE status_id = 2 ORDER BY dibuat_tanggal DESC LIMIT 10 ");
        if ($query->execute()) {
            $res = $query->get_result();
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
    }
    echo json_encode($data);
}
