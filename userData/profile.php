<?php
require '../components/dbconn.php';
session_start();
$data = array();
if (isset($_REQUEST['req'])) {
    $req = $_REQUEST['req'];
    if ($req == 'detailUser') {
        $id = $_REQUEST['id'];
        $queryLog = $conn->prepare("SELECT * FROM login_user WHERE id = ?");
        $queryLog->bind_param("i", $id);
        if ($queryLog->execute()) {
            $resLog = $queryLog->get_result();
            $rowLog = $resLog->fetch_assoc();
            $data[] = $rowLog;
            $queryD = $conn->prepare("SELECT DA.*, G.description FROM detail_user DA LEFT JOIN gender G  ON G.id = DA.gender_id WHERE id_user = ?");
            $queryD->bind_param("i", $id);
            if ($queryD->execute()) {
                $resD = $queryD->get_result();
                $rowD = $resD->fetch_assoc();
                $data[] = $rowD;
            }
        }
    }
    if ($req == 'gender') {
        $query = $conn->prepare("SELECT * FROM gender");
        if ($query->execute()) {
            $res = $query->get_result();
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
    }
    if ($req == 'editUser') {
        $id = $_REQUEST['id'];
        $queryLog = $conn->prepare("SELECT id,email,username,avatar FROM login_user WHERE id = ?");
        $queryLog->bind_param("i", $id);
        if ($queryLog->execute()) {
            $resLog = $queryLog->get_result();
            $rowLog = $resLog->fetch_assoc();
            $data[] = $rowLog;
            $queryD = $conn->prepare("SELECT DA.*, G.description FROM detail_user DA LEFT JOIN gender G  ON G.id = DA.gender_id WHERE id_user = ?");
            $queryD->bind_param("i", $id);
            if ($queryD->execute()) {
                $resD = $queryD->get_result();
                $rowD = $resD->fetch_assoc();
                $data[] = $rowD;
            }
        }
    }
    if ($req == 'avatar') {
        $id = $_REQUEST['id'];
        $query = "SELECT avatar FROM login_user WHERE id = $id";
        $res = $conn->query($query);
        $row = $res->fetch_assoc();
        $data[] = $row;
    }
    echo json_encode($data);
}
