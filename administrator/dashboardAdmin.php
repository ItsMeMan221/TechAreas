<?php
session_start();
require '../components/dbconn.php';
$id_admin = $_SESSION['data_admin']['id'];
if ($_SESSION['data_admin']['role_id'] == 2) {
    $queryArtikel = $conn->prepare("SELECT COUNT(id) as num_artikel FROM artikel WHERE status_id = 1");
    if ($queryArtikel->execute()) {
        $res = $queryArtikel->get_result();
        $rowArtikel = $res->fetch_assoc();
    }
    $querySpek = $conn->prepare("SELECT COUNT(id) as num_spek FROM spesifikasi WHERE status_id = 1");
    if ($querySpek->execute()) {
        $resSpek = $querySpek->get_result();
        $rowSpek = $resSpek->fetch_assoc();
    }
    $notifArtikel = $rowArtikel['num_artikel'];
    $notifSpek = $rowSpek['num_spek'];
} elseif ($_SESSION['data_admin']['role_id'] == 1) {
    $queryArtikel = $conn->prepare("SELECT COUNT(id) as num_artikel FROM artikel WHERE (status_id = 1 OR status_id = 3)  AND admin_id = '$id_admin'");
    if ($queryArtikel->execute()) {
        $res = $queryArtikel->get_result();
        $rowArtikel = $res->fetch_assoc();
    }
    $querySpek = $conn->prepare("SELECT COUNT(id) as num_spek FROM spesifikasi WHERE (status_id = 1  OR status_id = 3) AND admin_id = '$id_admin' ");
    if ($querySpek->execute()) {
        $resSpek = $querySpek->get_result();
        $rowSpek = $resSpek->fetch_assoc();
    }
    $notifArtikel = $rowArtikel['num_artikel'];
    $notifSpek = $rowSpek['num_spek'];
}

if ($_SESSION['auth_admin'] == true) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <?php
        include '../framework/jquery.php';
        include '../framework/bootstrap.php';
        include '../framework/sweetalert2.php';
        ?>
        <link rel="stylesheet" href="../css/dashboardAdmin.css">
    </head>

    <body class="bcol">
        <?php include '../components/navbarAdmin.php' ?>
        <!-- Card For Buttons -->
        <section class="row">
            <?php
            if ($_SESSION['data_admin']['role_id'] == 2) {
            ?>
                <a class="card col-md-3 col-lg-3 col-xl-3" href="tambahAdmin.php">
                    <i class="bi bi-person-plus-fill text-center"></i>
                    <div class="card-body text-white">
                        <hr class="border-primary border-3 opacity-75 container-fluid">
                        <h5 class="card-title text-center">Tambah Admin</h5>
                    </div>
                </a>
                <a class="card col-md-3 col-lg-3 col-xl-3" href="listBrand.php">
                    <i class="bi bi-list-columns text-center"></i>
                    <div class="card-body text-white">
                        <hr class="border-primary border-3 opacity-75 container-fluid">
                        <h5 class="card-title text-center">List Brand</h5>
                    </div>
                </a>

                <a class="card col-md-3 col-lg-3 col-xl-3" href="listAdmin.php">
                    <i class="bi bi-card-list text-center"></i>
                    <div class="card-body text-white">
                        <hr class="border-primary border-3 opacity-75 container-fluid">
                        <h5 class="card-title text-center">List Admin</h5>
                    </div>
                </a>
            <?php } ?>
            <a class="card col-md-3 col-lg-3 col-xl-3" href="tambahSpek.php">
                <i class="bi bi-phone-vibrate-fill text-center"></i>
                <div class="card-body text-white">
                    <hr class="border-primary border-3 opacity-75 container-fluid">
                    <h5 class="card-title text-center">Tambah Spesifikasi</h5>
                </div>
            </a>
            <a class="card col-md-3 col-lg-3 col-xl-3" href="tambahArtikel.php">
                <i class="bi bi-newspaper text-center"></i>
                <div class="card-body text-white">
                    <hr class="border-primary border-3 opacity-75 container-fluid">
                    <h5 class="card-title text-center">Tambah Artikel</h5>
                </div>
            </a>
            <a class="card col-md-3 col-lg-3 col-xl-3" href="inboxArtikel.php">
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?php echo $notifArtikel; ?>
                    <span class="visually-hidden">unread messages</span>
                </span>
                <i class="bi bi-inboxes-fill text-center"></i>
                <div class="card-body text-white">
                    <hr class="border-primary border-3 opacity-75 container-fluid">
                    <h5 class="card-title text-center">Inbox Artikel</h5>
                </div>
            </a>
            <a class="card col-md-3 col-lg-3 col-xl-3" href="inboxSpek.php">
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?php echo $notifSpek; ?>
                    <span class="visually-hidden">unread messages</span>
                </span>
                <i class="bi bi-mailbox2 text-center"></i>
                <div class="card-body text-white">
                    <hr class="border-primary border-3 opacity-75 container-fluid">
                    <h5 class="card-title text-center">Inbox Spesifikasi</h5>
                </div>
            </a>
            <a class="card col-md-3 col-lg-3 col-xl-3" href="inboxKontak.php">
                <i class="bi bi-envelope-fill text-center"></i>
                <div class="card-body text-white">
                    <hr class="border-primary border-3 opacity-75 container-fluid">
                    <h5 class="card-title text-center">Inbox Kontak</h5>
                </div>
            </a>
        </section>
        <!-- End of Sections -->
    </body>

    </html>
<?php
} else {
    header('location:loginAdmin.php');
}
