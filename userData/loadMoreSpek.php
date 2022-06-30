<?php
session_start();
require '../components/dbconn.php';
if (isset($_POST['row'])) {
    $start = $_POST['row'];
    $limit = 9;
    $query = "SELECT * FROM spesifikasi WHERE status_id = 2 ORDER BY dibuat_tanggal desc LIMIT " . $start . "," . $limit;
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
?>
            <div class="col">
                <div class="card h-100 card-bc">
                    <img src="<?php echo $row['gambar'] ?>" class="card-img-top h-spek">
                    <div class="card-body ">
                        <h5 class="card-title"><?php echo $row['nama_model'] ?></h5>
                        <a href="detailSpek.php?id=<?php echo $row['id'] ?>&idSegmen=<?php echo $row['segmentasi_id'] ?>" class="btn btn-success card-text mt-3 hvr-grow"> Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
        <?php }
    }
}
if (isset($_POST['req'])) {
    $reqT = $_REQUEST['req'];
    if ($reqT == 'searchSpek') {
        $search = $_POST['search'];
        $query = "SELECT * FROM spesifikasi WHERE status_id = 2 AND (nama_model LIKE '%" . $search . "%') ORDER BY dibuat_tanggal desc";
        $resSearch = mysqli_query($conn, $query);
        while ($row = $resSearch->fetch_assoc()) {
        ?>
            <div class="col">
                <div class="card h-100 card-bc">
                    <img src="<?php echo $row['gambar'] ?>" class="card-img-top h-spek">
                    <div class="card-body ">
                        <h5 class="card-title"><?php echo $row['nama_model'] ?></h5>
                        <a href="detailSpek.php?id=<?php echo $row['id'] ?>&idSegmen=<?php echo $row['segmentasi_id'] ?>" class="btn btn-success card-text mt-3 hvr-grow"> Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
<?php
        }
    }
}
?>