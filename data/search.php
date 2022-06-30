<?php
session_start();
$tempArtikel = array();
$id_admin = $_SESSION['data_admin']['id'];
if (isset($_POST['req'])) {
    $reqT = $_REQUEST['req'];
    require '../components/dbconn.php';
    if ($reqT == 'search') {
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
                                        WHERE S.description LIKE '%" . $search . "%' OR A.judul LIKE '%" . $search . "%' OR LA.username LIKE '%" . $search . "%'
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
        AND ( S.description LIKE '%" . $search . "%' OR A.judul LIKE '%" . $search . "%' OR LA.username LIKE '%" . $search . "%') ");
        }
        $count = 1;
        if ($query->execute()) {
            $res = $query->get_result();
            while ($rows = $res->fetch_assoc()) {
                if ($_SESSION['data_admin']['role_id'] == 1) {
?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $rows["username"]; ?></td>
                        <td><?php echo $rows["judul"]; ?></td>
                        <td><?php echo $rows["status_descr"]; ?></td>
                        <td>
                            <button class='btn btn-warning' id='btn-detail' data-bs-toggle='modal' data-segmen="<?php echo $rows['segmentasi_id'] ?>" data-id="<?php echo $rows['id'] ?>">Detail<i class='bi bi-pencil-fill'></i></button>
                        </td>
                    </tr>
                <?php
                } elseif ($_SESSION['data_admin']['role_id'] == 2) {
                ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $rows["username"]; ?></td>
                        <td><?php echo $rows["judul"]; ?></td>
                        <td><?php echo $rows["status_descr"]; ?></td>
                        <td>
                            <button class='btn btn-warning' id='btn-detail' data-bs-toggle='modal' data-segmen="<?php echo $rows['segmentasi_id'] ?>" data-id="<?php echo $rows['id'] ?>">Detail<i class='bi bi-pencil-fill'></i> <button id='btn-delete' class='btn btn-danger ms-1' data-id='<?= $rows['id'] ?>'>Delete <i class='bi bi-trash-fill'></i></button></button>
                        </td>
                    </tr>
                <?php
                }
            }
        }
    }
    if ($reqT == 'searchSpek') {
        $search = $_POST['search'];
        if ($_SESSION['data_admin']['role_id'] == 2) {
            $query = $conn->prepare("SELECT SP.*,
                                        S.description status_descr,
                                        LA.username,
                                        B.description brand_descr
                                        FROM spesifikasi SP
                                        LEFT JOIN Brand B ON B.id = SP.brand_id
                                        LEFT JOIN login_admin LA ON LA.id = SP.admin_id 
                                        LEFT JOIN status S ON s.id = SP.status_id
                                        WHERE S.description LIKE '%" . $search . "%' OR B.description LIKE '%" . $search . "%' OR LA.username LIKE '%" . $search . "%'  OR SP.nama_model LIKE '%" . $search . "%'");
        } elseif ($_SESSION['data_admin']['role_id'] == 1) {
            $query = $conn->prepare("SELECT SP.*,
                                    S.description status_descr,
                                    LA.username,
                                    B.description brand_descr
                                    FROM spesifikasi SP
                                    LEFT JOIN Brand B ON B.id = SP.brand_id
                                    LEFT JOIN login_admin LA ON LA.id = SP.admin_id 
                                    LEFT JOIN status S ON s.id = SP.status_id WHERE SP.admin_id =  $id_admin
                                    AND ( S.description LIKE '%" . $search . "%' OR B.description LIKE '%" . $search . "%' OR LA.username LIKE '%" . $search . "%' OR SP.nama_model LIKE '%" . $search . "%')");
        }
        $count = 1;
        if ($query->execute()) {
            $res = $query->get_result();
            while ($rows = $res->fetch_assoc()) {
                if ($_SESSION['data_admin']['role_id'] == 1) {
                ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $rows["username"]; ?></td>
                        <td><?php echo $rows["brand_descr"]; ?></td>
                        <td><?php echo $rows["nama_model"]; ?></td>
                        <td><?php echo $rows["harga"]; ?></td>
                        <td><?php echo $rows["status_descr"]; ?></td>
                        <td>
                            <button class='btn btn-warning' id='btn-detail' data-bs-toggle='modal' data-segmen="<?php echo $rows['segmentasi_id'] ?>" data-id="<?php echo $rows['id'] ?>" data-brand="<?php echo $rows['brand_id'] ?>">Detail<i class='bi bi-pencil-fill'></i></button>
                        </td>
                    </tr>
                <?php
                } else if ($_SESSION['data_admin']['role_id'] == 2) {
                ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $rows["username"]; ?></td>
                        <td><?php echo $rows["brand_descr"]; ?></td>
                        <td><?php echo $rows["nama_model"]; ?></td>
                        <td><?php echo $rows["harga"]; ?></td>
                        <td><?php echo $rows["status_descr"]; ?></td>
                        <td>
                            <button class='btn btn-warning' id='btn-detail' data-bs-toggle='modal' data-segmen="<?php echo $rows['segmentasi_id'] ?>" data-id="<?php echo $rows['id'] ?>" data-brand="<?php echo $rows['brand_id'] ?>">Detail<i class='bi bi-pencil-fill'></i></button> <button id='btn-delete' class='btn btn-danger' data-id='<?php echo $rows['id']; ?>'>Delete <i class='bi bi-trash-fill'></i></button>
                        </td>
                    </tr>
<?php
                }
            }
        }
    }
}
?>