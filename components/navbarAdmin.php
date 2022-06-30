<link rel="stylesheet" href="../css/navstly.css">
<nav class="navbar bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboardAdmin.php">TechAreas</a>
        <div class="profile-section nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="userProfile">
                    <p class="text-white username"><?php echo $_SESSION['data_admin']['username'] ?> </p>
                </div>
                <div class="container-profile">
                    <img src="../img/avatar.png" class="image-admin">
                </div>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item text-white" href="../functions/logout.php">Logout </a></li>
            </ul>
        </div>

</nav>