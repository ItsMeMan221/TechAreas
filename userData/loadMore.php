<?php
session_start();
require '../components/dbconn.php';
if (isset($_POST['row'])) {
    $start = $_POST['row'];
    $limit = 5;
    $query = "SELECT * FROM artikel WHERE status_id = 2 ORDER BY tanggal_dibuat desc LIMIT " . $start . "," . $limit;
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
?>
            <a href="detailArtikel.php?id=<?php echo $row['id'] ?>&segmen_id=<?php echo $row['segmentasi_id'] ?>" class="un-a hvr-float-shadow">
                <div class="card card-bc mb-3 ms-5m" style="max-width: 1500px;">
                    <div class="row g-0">
                        <div class="col-md-2 col-sm-6 col-6">
                            <img src="<?php echo $row['gambar'] ?>" class="img-fluidm rounded-start" alt="...">
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['judul'] ?></h5>
                                <p class="card-text"><?php echo substr($row['isi'], 0, 450) . "...."; ?></p>
                                <p class="card-text"><small class="text-m"><?php echo $row['tanggal_dibuat'] ?></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?php }
    }
}
if (isset($_POST['req'])) {
    $reqT = $_REQUEST['req'];
    if ($reqT == 'searchBerita') {
        $search = $_POST['search'];
        $query = "SELECT * FROM artikel WHERE status_id = 2 AND (judul LIKE '%" . $search . "%') ORDER BY tanggal_dibuat desc";
        $resSearch = mysqli_query($conn, $query);
        while ($row = $resSearch->fetch_assoc()) {
        ?>
            <a href="detailArtikel.php?id=<?php echo $row['id'] ?>&segmen_id=<?php echo $row['segmentasi_id'] ?>" class="un-a hvr-float-shadow">
                <div class="card card-bc mb-3 ms-5m" style="max-width: 1500px;">
                    <div class="row g-0">
                        <div class="col-md-2 col-sm-6 col-6">
                            <img src="<?php echo $row['gambar'] ?>" class="img-fluidm rounded-start" alt="...">
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['judul'] ?></h5>
                                <p class="card-text"><?php echo substr($row['isi'], 0, 450) . "...."; ?></p>
                                <p class="card-text"><small class="text-m"><?php echo $row['tanggal_dibuat'] ?></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
<?php
        }
    }
}
?>