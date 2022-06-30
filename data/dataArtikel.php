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
            $query = $conn->prepare("SELECT A.id,
                                        A.isi,
                                        A.admin_id, 
                                        A.segmentasi_id,
                                        A.judul, 
                                        A.status_id,
                                        A.gambar,
                                        S.description status_descr,
                                        LA.username
                                        FROM artikel A
                                        LEFT JOIN login_admin LA ON LA.id = A.admin_id 
                                        LEFT JOIN status S ON s.id = A.status_id");
        } elseif ($_SESSION['data_admin']['role_id'] == 1) {
            $query = $conn->prepare("SELECT A.id,
        A.isi,
        A.admin_id, 
        A.segmentasi_id,
        A.judul, 
        A.status_id,
        A.gambar,
        S.description status_descr,
        LA.username
        FROM artikel A
        LEFT JOIN login_admin LA ON LA.id = A.admin_id 
        LEFT JOIN status S ON s.id = A.status_id WHERE A.admin_id =  $id_admin");
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
    } elseif ($reqT == 'search') {
        $search = $_POST['search'];
        if ($_SESSION['data_admin']['role_id'] == 2) {
            $query = $conn->prepare("SELECT A.id,
                                        A.isi,
                                        A.admin_id, 
                                        A.segmentasi_id,
                                        A.judul, 
                                        A.status_id,
                                        A.gambar,
                                        S.description status_descr,
                                        LA.username
                                        FROM artikel A
                                        LEFT JOIN login_admin LA ON LA.id = A.admin_id 
                                        LEFT JOIN status S ON s.id = A.status_id
                                        WHERE S.description LIKE '%" . $search . "'
                                        ");
        } elseif ($_SESSION['data_admin']['role_id'] == 1) {
            $query = $conn->prepare("SELECT A.id,
        A.isi,
        A.admin_id, 
        A.segmentasi_id,
        A.judul, 
        A.status_id,
        A.gambar,
        S.description status_descr,
        LA.username
        FROM artikel A
        LEFT JOIN login_admin LA ON LA.id = A.admin_id 
        LEFT JOIN status S ON s.id = A.status_id WHERE A.admin_id =  $id_admin 
        AND ( S.description LIKE '%" . $search . "') ");
        }
        if ($query->execute()) {
            $res = $query->get_result();
            while ($rows = $res->fetch_assoc()) {
                $data[] = $rows;
            }
        }
    } else if ($reqT = 'delete') {
        $id = $_POST['id']; 
        $query = $conn->prepare("DELETE FROM artikel WHERE id = ?");
        $query->bind_param("i", $id); 
        if($query->execute()) {
            $data[] = '1';
        } else { 
            $data[] = '0';
        }
    }
    echo json_encode($data);
}
