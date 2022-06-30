<?php
session_start();
require '../components/dbconn.php';
if (isset($_POST['row'])) {
    $start = $_POST['row'];
    $limit = 9;
    $query = "SELECT K.*,
    LU.email 
    FROM kontak K 
    LEFT JOIN login_user LU ON K.id_user = LU.id
    ORDER BY dikirim_tanggal DESC LIMIT " . $start . "," . $limit;
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
?>
            <div class="col">
                <div class="card text-bg-dark mb-3">
                    <div class="card-header">Dikirim oleh : <?php echo $row['email'] ?></div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['judul'] ?> </h5>
                        <p class="card-text"><?php echo $row['isi'] ?></p>
                    </div>
                </div>
            </div>
<?php }
    }
}
