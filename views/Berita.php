<?php
session_start();
require '../components/dbconn.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita</title>
    <?php
    include '../framework/jquery.php';
    include '../framework/sweetalert2.php';
    ?>
    <link rel="stylesheet" href="../css/berita.css">
</head>

<body>
    <?php
    if ($_SESSION['auth'] == true) {
        include '../components/navbar.php';
    ?>
        <section class="container mt-5 berita-container">
            <h4 class="ma-nav ms-4">Berita Teknologi Terbaru dan Ter-update</h4>
            <div class="col-md-2 col-sm-2 col-xs-2 col-6">
                <hr class="hr-berita ms-4">
            </div>
            <div class="container mb-5">
                <form class="d-flex col-md-3 mt-5 ms-auto" role="search">
                    <input class="form-control me-2" placeholder="Cari Berdasarkan Judul" id="keyword">
                </form>
            </div>
            <div class="container-berita">
                <?php
                $count_artikel = "SELECT count(*) as jumlah FROM artikel WHERE status_id = 2";
                $res_count =  mysqli_query($conn, $count_artikel);
                $rows = mysqli_fetch_assoc($res_count);
                $jumlahData = $rows['jumlah'];
                $limit = 5;

                $true_data = "SELECT * FROM artikel WHERE status_id = 2 ORDER BY tanggal_dibuat DESC LIMIT 0," . $limit;
                $res = mysqli_query($conn, $true_data);
                if ($res->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
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
                ?>
            </div>
            <div class="loadmore d-flex justify-content-center">
                <input type="button" id="loadBtn" value="Berikutnya" class="btn btn-outline-secondary col-md-2 text-white ">
                <input type="hidden" id="row" value="0">
                <input type="hidden" id="postCount" value="<?php echo $jumlahData; ?>">
            </div>
        </section>
        <?php include '../components/footer.php' ?>
    <?php  } else {
        header('location:../index.php');
    }
    ?>
</body>
<script>
    $(document).ready(function() {
        $(document).on('click', '#loadBtn', function() {
            var row = Number($('#row').val());
            var count = Number($('#postCount').val());
            var limit = 5;
            row = row + limit;
            $('#row').val(row);
            $("#loadBtn").val('Loading...');

            $.ajax({
                type: 'POST',
                url: '../userData/loadMore.php',
                data: 'row=' + row,
                success: function(data) {
                    var rowCount = row + limit;
                    $('.container-berita').append(data);
                    if (rowCount >= count) {
                        $('#loadBtn').css("display", "none");
                    } else {
                        $("#loadBtn").val('Berikutnya');
                    }
                }
            });
        });
        //Search function
        $('#keyword').on('keyup', function() {
            $.ajax({
                type: "POST",
                url: "../userData/loadMore.php",
                data: {
                    search: $(this).val(),
                    req: 'searchBerita'
                },
                dataType: "html",
                cache: false,
                success: function(response) {
                    $(".container-berita").html(response);
                    $('#loadBtn').css("display", "none");
                }
            });
        });
    });
</script>

</html>