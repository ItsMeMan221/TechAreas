<?php
session_start();
include '../functions/cleaner.php';
require '../components/dbconn.php';
if (isset($_POST['action']) == 'edit') {
    $id_brand = cleaner($_POST['id_brand']);
    $brand = cleaner($_POST['brand']);
    //Validasi 
    $error = array(
        'error_status' => 0
    );
    if (empty($brand)) {
        $error['error_status'] = 1;
        $error['brand'] = 'Field brand wajib diisi!';
    }
    if (!empty($brand)) {
        if (strlen($brand) < 2) {
            $error['error_status'] = 1;
            $error['brand'] = 'Panjang karakter setidaknya 2 karakter!';
        }
    }
    if ($error['error_status'] > 0) {
        echo json_encode($error);
        exit();
    }
    $query = $conn->prepare("UPDATE brand SET description = ? WHERE id = ?");
    $query->bind_param("si", $brand, $id_brand);
    if ($query->execute()) {
        $response = array(
            'status' => 1,
            'msg' => 'Berhasil Mengedit Nama Brand'
        );
    } else {
        $response = array(
            'status' => 0,
            'msg' => 'Gagal Mengedit Nama Brand'
        );
    }
    echo json_encode($response);
    exit();
    $conn->close();
}
if (isset($_REQUEST['req'])) {
    $req = $_REQUEST['req'];
    if ($req == 'delete') {
        $id_brand = cleaner($_POST['id']);
        $query = $conn->prepare("UPDATE brand SET active = 0 WHERE id = ?");
        $query->bind_param("i", $id_brand);
        if ($query->execute()) {
            $response = array(
                'status' => 1,
                'msg' => 'Berhasil Menghapus Brand'
            );
        } else {
            $response = array(
                'status' => 0,
                'msg' => 'Gagal Menghapus Brand'
            );
        }
        echo json_encode($response);
        exit();
        $conn->close();
    }
}
