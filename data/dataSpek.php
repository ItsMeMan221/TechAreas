<?php
session_start();
$data = array();
$tempArtikel = array();
$id_admin = $_SESSION['data_admin']['id'];
if (isset($_POST['req'])) {
    $reqT = $_REQUEST['req'];
    require '../components/dbconn.php';
    //data untuk memenuhi table
    if ($reqT == 'rows') {
        if ($_SESSION['data_admin']['role_id'] == 2) {
            $query = $conn->prepare("SELECT SP.*,
                                        S.description status_descr,
                                        LA.username,
                                        B.description brand_descr
                                        FROM spesifikasi SP
                                        LEFT JOIN Brand B ON B.id = SP.brand_id
                                        LEFT JOIN login_admin LA ON LA.id = SP.admin_id 
                                        LEFT JOIN status S ON s.id = SP.status_id");
        } elseif ($_SESSION['data_admin']['role_id'] == 1) {
            $query = $conn->prepare("SELECT SP.*,
            S.description status_descr,
            LA.username,
            B.description brand_descr
            FROM spesifikasi SP
            LEFT JOIN Brand B ON B.id = SP.brand_id
            LEFT JOIN login_admin LA ON LA.id = SP.admin_id 
            LEFT JOIN status S ON s.id = SP.status_id WHERE SP.admin_id =  $id_admin");
        }
        if ($query->execute()) {
            $res = $query->get_result();
            while ($rows = $res->fetch_assoc()) {
                $data[] = $rows;
            }
        }
    } elseif ($reqT == 'segmen') {
        $query = $conn->prepare("SELECT * FROM segmen");
        if ($query->execute()) {
            $res = $query->get_result();
            while ($rows = $res->fetch_assoc()) {
                $data[] = $rows;
            }
        }
    } elseif ($reqT == 'brand') {
        $query = $conn->prepare("SELECT * FROM brand WHERE active = 1");
        if ($query->execute()) {
            $res = $query->get_result();
            while ($rows = $res->fetch_assoc()) {
                $data[] = $rows;
            }
        }
    } else if ($reqT == 'delete') {
        $id = $_POST['id'];
        $query = $conn->prepare("DELETE FROM spesifikasi WHERE id = ? ");
        $query->bind_param("i", $id);
        if ($query->execute()) {
            $data[] = '1';
        } else {
            $data[] = '0';
        }
    }
    echo json_encode($data);
}
