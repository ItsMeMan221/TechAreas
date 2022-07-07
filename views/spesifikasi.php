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
    <title>Spesifikasi</title>
    <?php
    include '../framework/jquery.php';
    ?>
    <link rel="stylesheet" href="../css/spek.css">
</head>

<body>
    <?php
    if ($_SESSION['auth'] == true) {
        include '../components/navbar.php';
    ?>
        <section class="container mt-5">
            <div class="spek">
                <h4 class="ma-nav ms-4">Spesifikasi Singkat Gadget</h4>
                <div class="col-md-3 col-sm-3 col-xs-3 col-9 mb-4">
                    <hr class="hr-spek ms-4">
                </div>
                <div class="container mb-5">
                    <form class="d-flex col-md-3 mt-5 ms-auto" role="search">
                        <input class="form-control me-2" placeholder="Cari Berdasarkan Nama Model" id="keyword">
                    </form>
                </div>
                <div class="container-spek">
                    <div class="row row-cols-1 row-cols-md-3 g-4 con-spek">
                        <?php
                        $count_spek = "SELECT count(*) as jumlah FROM spesifikasi WHERE status_id = 2";
                        $res_count =  mysqli_query($conn, $count_spek);
                        $rows = mysqli_fetch_assoc($res_count);
                        $jumlahData = $rows['jumlah'];
                        $limit = 9;

                        $true_data = "SELECT * FROM spesifikasi WHERE status_id = 2 ORDER BY dibuat_tanggal DESC LIMIT 0," . $limit;
                        $res = mysqli_query($conn, $true_data);
                        if ($res->num_rows > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
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
                        ?>
                    </div>
                </div>
                <div class="loadmore d-flex justify-content-center mt-5">
                    <input type="button" id="loadBtn" value="Berikutnya" class="btn btn-outline-secondary col-md-2 text-white ">
                    <input type="hidden" id="row" value="0">
                    <input type="hidden" id="postCount" value="<?php echo $jumlahData; ?>">
                </div>
        </section>
        <?php include '../components/footer.php' ?>
    <?php } else {
        header('location:../index.php');
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
                url: '../userData/loadMoreSpek.php',
                data: 'row=' + row,
                success: function(data) {
                    var rowCount = row + limit;
                    $('.con-spek').append(data);
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
                url: "../userData/loadMoreSpek.php",
                data: {
                    search: $(this).val(),
                    req: 'searchSpek'
                },
                dataType: "html",
                cache: false,
                success: function(response) {
                    $(".con-spek").html(response);
                    $('#loadBtn').css("display", "none");
                }
            });
        });
    });
</script>

</html>