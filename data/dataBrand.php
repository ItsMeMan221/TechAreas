<?php
$data = array();
if (isset($_POST['req'])) {
    require '../components/dbconn.php';
    $req = $_REQUEST['req'];
    if ($req == 'rows') {
        $query = $conn->prepare("SELECT * FROM brand WHERE active = 1 ");
        if ($query->execute()) {
            $res = $query->get_result();
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
    }
    if ($req == 'brand') {
        $id_brand = $_POST['id'];
        $query = $conn->prepare("SELECT * FROM brand WHERE id = ? ");
        $query->bind_param("i", $id_brand);
        if ($query->execute()) {
            $res = $query->get_result();
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
    }
    echo json_encode($data);
}
