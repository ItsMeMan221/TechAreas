<?php
session_start();
include '../functions/cleaner.php';
require '../components/dbconn.php';
if (isset($_POST['action']) == 'edit') {
    $id_artikel = cleaner($_POST['id_artikel']);
    $id_status = cleaner($_POST['id_status']);
    $segmen = cleaner($_POST['segmen']);
    $judul = cleaner($_POST['judul']);
    $isi = cleaner($_POST['isi']);
    //Validasi 
    $error = array(
        'error_status' => 0
    );
    if (empty($judul)) {
        $error['error_status'] = 1;
        $error['judul'] = 'Field model wajib diisi!';
    }
    if (!empty($judul)) {
        if (strlen($judul) < 15) {
            $error['error_status'] = 1;
            $error['judul'] = 'Panjang karakter setidaknya 15 karakter!';
        }
    }
    if (empty($isi)) {
        $error['error_status'] = 1;
        $error['isi'] = 'Field Isi Artikel wajib diisi!';
    }
    if (!empty($isi)) {
        if (strlen($isi) < 200) {
            $error['error_status'] = 1;
            $error['isi'] = 'Panjang karakter setidaknya 200 karakter!';
        }
    }
    if ($error['error_status'] > 0) {
        echo json_encode($error);
        exit();
    }
    //gambar tidak upload
    if ($_FILES['gambar']['name'] == '') {
        if ($id_status == 1) {
            $query = $conn->prepare("UPDATE artikel SET segmentasi_id = ?, judul = ?, isi = ? WHERE id = ?");
            $query->bind_param("issi", $segmen, $judul, $isi, $id_artikel);
            if ($query->execute()) {
                $response = array(
                    'status' => 1,
                    'msg' => 'Berhasil Mengedit Artikel'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'msg' => 'Gagal mengedit artikel'
                );
            }
        } else if ($id_status == 3) {
            $query = $conn->prepare("UPDATE artikel SET status_id = 1 ,segmentasi_id = ?, judul = ?, isi = ? WHERE id = ?");
            $query->bind_param("issi", $segmen, $judul, $isi, $id_artikel);
            if ($query->execute()) {
                $response = array(
                    'status' => 1,
                    'msg' => 'Berhasil Mengedit Artikel'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'msg' => 'Gagal mengedit artikel'
                );
            }
        }
    } else {
        // upload file 
        $dir = "../uploads/gambarArtikel/";
        $avatarName = md5(uniqid(mt_rand(), true));
        $tar_upl = $dir . basename(($_FILES['gambar']['name']));
        $docType = strtolower(pathinfo($tar_upl, PATHINFO_EXTENSION));
        $avatarName .= "." . $docType;
        $tar_upl = $dir . $avatarName;

        if ($id_status == 1) {
            $query = $conn->prepare("UPDATE artikel SET segmentasi_id = ?, judul = ?, isi = ?, gambar = ? WHERE id = ?");
            $query->bind_param("isssi", $segmen, $judul, $isi, $tar_upl, $id_artikel);
            if ($query->execute()) {
                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $tar_upl)) {
                }
                $response = array(
                    'status' => 1,
                    'msg' => 'Berhasil Mengedit Artikel'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'msg' => 'Gagal Mengedit Artikel'
                );
            }
        } else if ($id_status == 3) {
            $query = $conn->prepare("UPDATE artikel SET status_id = 1 ,segmentasi_id = ?, judul = ?, isi = ?, gambar = ? WHERE id = ?");
            $query->bind_param("isssi", $segmen, $judul, $isi, $tar_upl, $id_artikel);
            if ($query->execute()) {
                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $tar_upl)) {
                }
                $response = array(
                    'status' => 1,
                    'msg' => 'Berhasil Mengedit Artikel'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'msg' => 'Gagal Mengedit Artikel'
                );
            }
        }
    }
    echo json_encode($response);
    exit();
    $conn->close();
}
