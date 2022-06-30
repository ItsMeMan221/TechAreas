<?php
session_start();
include '../functions/cleaner.php';
require '../components/dbconn.php';
if (isset($_POST['action']) == 'edit') {
    $id_spek = cleaner($_POST['id_spek']);
    $id_status = cleaner($_POST['id_status']);
    $segmen = cleaner($_POST['segmen']);
    $brand = cleaner($_POST['brand']);
    $model = cleaner($_POST['model']);
    $processor = cleaner($_POST['processor']);
    $OS = cleaner($_POST['OS']);
    $RAM = cleaner($_POST['RAM']);
    $GPU = cleaner($_POST['GPU']);
    $layar = cleaner($_POST['layar']);
    $berat = cleaner($_POST['berat']);
    $penyimpanan = cleaner($_POST['penyimpanan']);
    $harga = cleaner($_POST['harga']);

    //Amankan Form 
    $segmen = strip_tags(mysqli_real_escape_string($conn, trim($segmen)));
    $brand = strip_tags(mysqli_real_escape_string($conn, trim($brand)));
    $model = strip_tags(mysqli_real_escape_string($conn, trim($model)));
    $processor = strip_tags(mysqli_real_escape_string($conn, trim($processor)));
    $OS = strip_tags(mysqli_real_escape_string($conn, trim($OS)));
    $RAM = strip_tags(mysqli_real_escape_string($conn, trim($RAM)));
    $GPU = strip_tags(mysqli_real_escape_string($conn, trim($GPU)));
    $layar = strip_tags(mysqli_real_escape_string($conn, trim($layar)));
    $berat = strip_tags(mysqli_real_escape_string($conn, trim($berat)));
    $penyimpanan = strip_tags(mysqli_real_escape_string($conn, trim($penyimpanan)));
    $harga = strip_tags(mysqli_real_escape_string($conn, trim($harga)));
    //Validasi 
    $error = array(
        'error_status' => 0
    );
    if (empty($model)) {
        $error['error_status'] = 1;
        $error['model'] = 'Field model wajib diisi!';
    }
    if (!empty($model)) {
        if (strlen($model) < 5) {
            $error['error_status'] = 1;
            $error['model'] = 'Panjang karakter setidaknya 5 karakter!';
        }
    }
    if (empty($processor)) {
        $error['error_status'] = 1;
        $error['processor'] = 'Field processor wajib diisi!';
    }
    if (!empty($processor)) {
        if (strlen($processor) < 5) {
            $error['error_status'] = 1;
            $error['processor'] = 'Panjang karakter setidaknya 5 karakter!';
        }
    }
    if (empty($OS)) {
        $error['error_status'] = 1;
        $error['OS'] = 'Field OS wajib diisi!';
    }
    if (!empty($OS)) {
        if (strlen($OS) < 5) {
            $error['error_status'] = 1;
            $error['OS'] = 'Panjang karakter setidaknya 5 karakter!';
        }
    }
    if (empty($RAM)) {
        $error['error_status'] = 1;
        $error['RAM'] = 'Field RAM wajib diisi!';
    }
    if (empty($GPU)) {
        $error['error_status'] = 1;
        $error['GPU'] = 'Field GPU wajib diisi!';
    }
    if (!empty($GPU)) {
        if (strlen($GPU) < 5) {
            $error['error_status'] = 1;
            $error['GPU'] = 'Panjang karakter setidaknya 5 karakter!';
        }
    }
    if (empty($layar)) {
        $error['error_status'] = 1;
        $error['layar'] = 'Field layar wajib diisi!';
    }
    if (!empty($layar)) {
        if (strlen($layar) < 5) {
            $error['error_status'] = 1;
            $error['layar'] = 'Panjang karakter setidaknya 5 karakter!';
        }
    }
    if (empty($berat)) {
        $error['error_status'] = 1;
        $error['berat'] = 'Field berat wajib diisi!';
    }
    if (!empty($berat)) {
        if (strlen($berat) < 2) {
            $error['error_status'] = 1;
            $error['berat'] = 'Panjang karakter setidaknya 5 karakter!';
        }
    }
    if (empty($penyimpanan)) {
        $error['error_status'] = 1;
        $error['penyimpanan'] = 'Field penyimpanan wajib diisi!';
    }
    if (!empty($penyimpanan)) {
        if (strlen($penyimpanan) < 2) {
            $error['error_status'] = 1;
            $error['penyimpanan'] = 'Panjang karakter setidaknya 5 karakter!';
        }
    }
    if (empty($harga)) {
        $error['error_status'] = 1;
        $error['harga'] = 'Field harga wajib diisi!';
    }
    if (!empty($harga)) {
        if (strlen($harga) < 5) {
            $error['error_status'] = 1;
            $error['harga'] = 'Panjang karakter setidaknya 5 karakter!';
        }
    }
    if ($error['error_status'] > 0) {
        echo json_encode($error);
        exit();
    }

    //gambar tidak upload
    if ($_FILES['gambar']['name'] == '') {
        if ($id_status == 1) {
            $query = $conn->prepare("UPDATE spesifikasi SET segmentasi_id = ?, nama_model = ?,  brand_id = ?, processor = ?,  OS = ?, RAM = ?, GPU = ?, dimensi_layar = ?, berat = ?, penyimpanan = ?, harga = ?  WHERE id = ?");
            $query->bind_param("isissssssssi", $segmen, $model, $brand, $processor, $OS, $RAM, $GPU, $layar, $berat, $penyimpanan, $harga, $id_spek);
            if ($query->execute()) {
                $response = array(
                    'status' => 1,
                    'msg' => 'Berhasil Mengedit Spesifikasi'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'msg' => 'Gagal mengedit Spesifikasi'
                );
            }
        } else if ($id_status == 3) {
            $query = $conn->prepare("UPDATE spesifikasi SET status_id = 1,segmentasi_id = ?, nama_model = ?,  brand_id = ?, processor = ?,  OS = ?, RAM = ?, GPU = ?, dimensi_layar = ?, berat = ?, penyimpanan = ?, harga = ?  WHERE id = ?");
            $query->bind_param("isissssssssi", $segmen, $model, $brand, $processor, $OS, $RAM, $GPU, $layar, $berat, $penyimpanan, $harga, $id_spek);
            if ($query->execute()) {
                $response = array(
                    'status' => 1,
                    'msg' => 'Berhasil Mengedit Spesifikasi!'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'msg' => 'Gagal mengedit Spesifikasi!'
                );
            }
        }
    } else {
        // upload file 
        $dir = "../uploads/gambarModel/";
        $avatarName = md5(uniqid(mt_rand(), true));
        $tar_upl = $dir . basename(($_FILES['gambar']['name']));
        $docType = strtolower(pathinfo($tar_upl, PATHINFO_EXTENSION));
        $avatarName .= "." . $docType;
        $tar_upl = $dir . $avatarName;

        if ($id_status == 1) {
            $query = $conn->prepare("UPDATE spesifikasi SET segmentasi_id = ?, nama_model = ?,  brand_id = ?, processor = ?,  OS = ?, RAM = ?, GPU = ?, dimensi_layar = ?, berat = ?, penyimpanan = ?, harga = ?, gambar = ?  WHERE id = ?");
            $query->bind_param("isisssssssssi", $segmen, $model, $brand, $processor, $OS, $RAM, $GPU, $layar, $berat, $penyimpanan, $harga, $tar_upl, $id_spek);
            if ($query->execute()) {
                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $tar_upl)) {
                }
                $response = array(
                    'status' => 1,
                    'msg' => 'Berhasil Mengedit Spesifikasi!'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'msg' => 'Gagal mengedit Spesifikasi!'
                );
            }
        } else if ($id_status == 3) {
            $query = $conn->prepare("UPDATE spesifikasi SET status_id = 1, segmentasi_id = ?, nama_model = ?,  brand_id = ?, processor = ?,  OS = ?, RAM = ?, GPU = ?, dimensi_layar = ?, berat = ?, penyimpanan = ?, harga = ?, gambar = ?  WHERE id = ?");
            $query->bind_param("isisssssssssi", $segmen, $model, $brand, $processor, $OS, $RAM, $GPU, $layar, $berat, $penyimpanan, $harga, $tar_upl, $id_spek);
            if ($query->execute()) {
                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $tar_upl)) {
                }
                $response = array(
                    'status' => 1,
                    'msg' => 'Berhasil Mengedit Spesifikasi!'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'msg' => 'Gagal mengedit Spesifikasi!'
                );
            }
        }
    }
    echo json_encode($response);
    exit();
    $conn->close();
}
