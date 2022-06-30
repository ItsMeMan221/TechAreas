<?php
session_start();
include '../components/dbconn.php';
$reqT = $_REQUEST['req'];
$data = array();
if (isset($reqT)) {
    if ($reqT == 'dataArtikel') {
        $id_artikel = $_POST['id'];
        $query = $conn->prepare("SELECT A.*, 
                                DA.nama 
                                FROM artikel A  
                                LEFT JOIN detail_admin DA ON A.admin_id = DA.id_admin
                                WHERE id = $id_artikel");
        if ($query->execute()) {
            $res = $query->get_result();
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
    }
    if ($reqT == 'dataTerkait') {
        $id_artikel = $_POST['id'];
        $id_segmen = $_POST['id_segmen'];
        $query = $conn->prepare("SELECT A.*, 
                                DA.nama 
                                FROM artikel A  
                                LEFT JOIN detail_admin DA ON A.admin_id = DA.id_admin
                                WHERE id != $id_artikel AND segmentasi_id = $id_segmen AND status_id = 2  ORDER BY tanggal_dibuat desc LIMIT 5");
        if ($query->execute()) {
            $res = $query->get_result();
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
    }
    if ($reqT == 'dataBacaJuga') {
        $id_artikel = $_POST['id'];
        $id_segmen = $_POST['id_segmen'];
        $query = $conn->prepare("SELECT A.*, 
                                DA.nama 
                                FROM artikel A  
                                LEFT JOIN detail_admin DA ON A.admin_id = DA.id_admin
                                WHERE id != $id_artikel AND segmentasi_id != $id_segmen AND status_id = 2  ORDER BY tanggal_dibuat desc LIMIT 5");
        if ($query->execute()) {
            $res = $query->get_result();
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
    }
    if ($reqT == 'dataSpek') {
        $id_spek = $_POST['id'];
        $query = $conn->prepare("SELECT S.*,
                                SE.description tipe_gadget,
                                B.description nama_brand,
                                DA.nama
                                FROM spesifikasi S
                                LEFT JOIN segmen SE ON SE.id = S.segmentasi_id
                                LEFT JOIN brand B ON B.id = S.brand_id 
                                LEFT JOIN detail_admin DA ON S.admin_id = DA.id_admin
                                WHERE S.id = '$id_spek'");
        if ($query->execute()) {
            $res = $query->get_result();
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
    }
    if ($reqT == 'dataLainnya') {
        $id_spek = $_POST['id'];
        $query = $conn->prepare("SELECT S.*,
                                SE.description tipe_gadget,
                                B.description nama_brand,
                                DA.nama
                                FROM spesifikasi S
                                LEFT JOIN segmen SE ON SE.id = S.segmentasi_id
                                LEFT JOIN brand B ON B.id = S.brand_id 
                                LEFT JOIN detail_admin DA ON S.admin_id = DA.id_admin
                                WHERE S.id != '$id_spek' AND status_id = 2 ORDER BY dibuat_tanggal DESC LIMIT 8 ");
        if ($query->execute()) {
            $res = $query->get_result();
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
    }
    echo json_encode($data);
}
