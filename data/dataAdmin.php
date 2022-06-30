<?php
$data = array();
if (isset($_POST['req'])) {
    require '../components/dbconn.php';
    $req = $_REQUEST['req'];
    if ($req == 'dataAdmin') {
        $query = $conn->prepare("SELECT LA.id, 
                                        LA.role_id, 
                                        LA.username, 
                                        DA.nama, 
                                        DA.tanggal_lahir, 
                                        DA.email, 
                                        DA.no_handphone,
                                        R.description descr_role, 
                                        G.description descr_gender 
                                        FROM login_admin LA
                                        LEFT JOIN detail_admin DA ON DA.id_admin = LA.id
                                        LEFT JOIN role R ON R.id = LA.role_id 
                                        LEFT JOIN gender G ON G.id = DA.gender_id WHERE active=1");
        if ($query->execute()) {
            $res = $query->get_result();
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
    }
    echo json_encode($data);
}
