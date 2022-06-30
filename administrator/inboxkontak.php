<?php
session_start();
require '../components/dbconn.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox Kontak</title>
    <?php
    include '../framework/jquery.php';
    include '../framework/bootstrap.php';
    include '../framework/sweetalert2.php';
    ?>
</head>

<body>
    <?php if ($_SESSION['auth_admin'] == true) {
        include '../components/navbarAdmin.php'
    ?>
        <section class="container mt-5 berita-container text-white">
            <h1 class="ma-nav text-center mb-5">Inbox Kontak</h1>
            <div class="container-berita">
                <div class="row row-cols-1 row-cols-md-3 g-4 con-kontak">
                    <?php
                    $count_artikel = "SELECT count(*) as jumlah FROM kontak";
                    $res_count =  mysqli_query($conn, $count_artikel);
                    $rows = mysqli_fetch_assoc($res_count);
                    $jumlahData = $rows['jumlah'];
                    $limit = 9;

                    $true_data = "SELECT K.*,
                                  LU.email 
                                  FROM kontak K 
                                  LEFT JOIN login_user LU ON K.id_user = LU.id
                                  ORDER BY dikirim_tanggal DESC LIMIT 0," . $limit;
                    $res = mysqli_query($conn, $true_data);
                    if ($res->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
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
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="loadmore d-flex justify-content-center">
                <input type="button" id="loadBtn" value="Berikutnya" class="btn btn-outline-secondary col-md-2 text-white ">
                <input type="hidden" id="row" value="0">
                <input type="hidden" id="postCount" value="<?php echo $jumlahData; ?>">
            </div>
        </section>
    <?php
    } else {
        header('location:loginAdmin.php');
    } ?>
</body>
<script>
    $(document).ready(function() {
        $(document).on('click', '#loadBtn', function() {
            var row = Number($('#row').val());
            var count = Number($('#postCount').val());
            var limit = 9;
            row = row + limit;
            $('#row').val(row);
            $("#loadBtn").val('Loading...');

            $.ajax({
                type: 'POST',
                url: '/412020004_SANTIAGO/data/loadMore.php',
                data: 'row=' + row,
                success: function(data) {
                    var rowCount = row + limit;
                    $('.con-kontak').append(data);
                    if (rowCount >= count) {
                        $('#loadBtn').css("display", "none");
                    } else {
                        $("#loadBtn").val('Berikutnya');
                    }
                }
            });
        });
    });
</script>

</html>