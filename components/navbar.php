<?php include '../framework/bootstrap.php';

?>
<link rel="stylesheet" href="../css/navstly.css">
<nav class="navbar navbar-dark bg-dark  sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">TechAreas</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span> <img src="<?php echo $_SESSION['data_user']['avatar']; ?>" class="avatar avatar-nav">
        </button>
        <div class="offcanvas offcanvas-start navbar-dark bg-dark" tabindex="-1" id="offcanvasNavbar" data-bs-scroll="true" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header  navbar-dark bg-dark">
                <a href="dashboard.php" style="color: unset; text-decoration: none;">
                    <h5 class="offcanvas-title navbar-dark text-white" id="offcanvasNavbarLabel">TechAreas</h5>
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body  navbar-dark bg-dark">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item hover-animate">
                        <a class="nav-link active " aria-current="page" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item hover-animate">
                        <a class="nav-link active" href="Berita.php">Berita</a>
                    </li>
                    <li class="nav-item hover-animate">
                        <a class="nav-link active" href="spesifikasi.php">Spesifikasi</a>
                    </li>
                    <li class="nav-item hover-animate">
                        <a class="nav-link active" href="kontak.php">Hubungi Kami</a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle hover-drop active" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu w-75" aria-labelledby="offcanvasNavbarDropdown">
                            <li class="mb-2"><a class="dropdown-item hover-item whiter" href="userProfile.php">User Profile</a></li>
                            <li><button class="dropdown-item hover-item btn-font whiter" id="triggModalPass">Change Password</button></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class=""><a class="dropdown-item hover-item whiter" role="button" href="../functions/logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id='mChangePass' tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bc-modal">
            <div class="modal-header">
                <h5 class="modal-title text-white">Ganti Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" id="changePass">
                    <input type="hidden" value="<?php echo $_SESSION['data_user']['id'] ?>" name="id_user">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="passwordLama" placeholder="Old Password" name="lPass">
                        <label>Password Lama</label>
                        <small class="text-danger" id="lPassError"></small>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="passwordBaru" placeholder="Password" name="bPass">
                        <label>Password Baru</label>
                        <small class="text-danger" id="bPassError"></small>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="cPass" placeholder="Password" name="kPass">
                        <label>Konfirmasi Password Baru</label>
                        <small id="kPassError" class="text-danger"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="confirmSave">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(this).ready(function() {
        $.ajax({
            type: "POST",
            url: "/412020004_SANTIAGO/userData/profile.php",
            data: {
                id: <?php echo $_SESSION['data_user']['id'] ?>,
                req: 'avatar'
            },
            dataType: "JSON",
            success: function(response) {
                $('.avatar-nav').attr("src", response[0].avatar);
            }
        });
        $('#triggModalPass').click(function() {
            $("#mChangePass").modal("show");
        })
        $('#confirmSave').click(function(e) {
            e.preventDefault();
            var form = $('#changePass')[0];
            var formData = new FormData(form);
            var frm = $('#changePass');
            formData.append('action', 'changePass');
            Swal.fire({
                title: 'Anda yakin untuk mengubah password anda?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                $.ajax({
                    type: "POST",
                    url: "/412020004_SANTIAGO/userData/changePass.php",
                    data: formData,
                    dataType: "JSON",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.error_status == 1) {
                            frm.find('small').text('');
                            for (var key in response) {
                                var errorContainer = frm.find(`#${key}Error`);
                                if (errorContainer.length !== 0) {
                                    errorContainer.html(response[key]);
                                }
                            }
                        }
                        if (response.status == 1) {
                            frm.find('small').text('');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Mengubah Password',
                                text: response.msg,
                            }).then(function() {
                                $("#mChangePass").modal("hide");
                                $('input[name="id_user"]').val("");
                                $('input[name="lPass"]').val("");
                                $('input[name="bPass"]').val("");
                                $('input[name="kPass"]').val("");
                            })

                        } else if (response.status == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Mengubah Password',
                                text: response.msg,
                            })
                        }
                    }
                });
            });
        })
    })
</script>