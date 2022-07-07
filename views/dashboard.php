<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <?php
    include '../framework/jquery.php';
    include '../framework/sweetalert2.php';
    ?>
</head>

<body>
    <?php
    if ($_SESSION['auth'] == true) {
        include '../components/navbar.php';
    ?>
        <section class="artikel">
            <div class="container">
                <h4 class="ma-nav ms-4">Berita Terbaru</h4>
                <div class="col-md-2 col-sm-2 col-xs-2 col-6">
                    <hr class="hr-berita ms-4">
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4 artikel-container">
                </div>
            </div>
        </section>
        <section class="spek">
            <div class="container">
                <h5 class="ma-nav ms-4">Gadget Keluaran Terbaru & Spesifikasinya</h5>
                <div class="col-md-5">
                    <hr class="hr-berita ms-4">
                </div>
                <div class="row row-cols-1 row-cols-md-5 g-4 spek-container">
                </div>
            </div>
        </section>
        <?php include '../components/footer.php'; ?>
    <?php
    } else {
        header('location:../index.php');
    }
    ?>
</body>
<script>
    $(document).ready(function() {
        getArtikel();
        getSpek();
    })

    function getArtikel() {
        var items = "";
        $.ajax({
            type: "POST",
            url: "../userData/dashboardRows.php",
            data: {
                req: 'dataArtikel',
            },
            dataType: "JSON",
            success: function(response) {
                $.each(response, function(i, item) {
                    items += "<a href = 'detailArtikel.php?id=" + item.id + "&segmen_id=" + item.segmentasi_id + "' class = 'un-a' ><div class='col artikel-container '> <div class='card card-bc '> <img src='" + item.gambar + "' class='card-img-top h-car'> <div class='card-body'> <h5 class='card-title'>" + item.judul + "</h5></div> <div class='card-footer'> <small class='dibuat'>Berita ini dirilis pada:  " + item.tanggal_dibuat + "</small></div> </div> </div> </a> ";

                });
                $(".artikel-container").html(items);

            }
        })
    }

    function getSpek() {
        var items = "";
        $.ajax({
            type: "POST",
            url: "../userData/dashboardRows.php",
            data: {
                req: 'dataSpek',
            },
            dataType: "JSON",
            success: function(response) {
                $.each(response, function(i, item) {
                    items += "<a href = 'detailSpek.php?id=" + item.id + "&idSegmen=" + item.segmentasi_id + "' class = 'un-a' ><div class='col'> <div class='card card-s'> <img src='" + item.gambar + "'class='card-img-top h-spek'> <div class='card-body'> <h5 class='card-title'>" + item.nama_model + "</h5> </div> </div> </div> </a> ";

                });
                $(".spek-container").html(items);

            }
        })
    }
</script>

</html>