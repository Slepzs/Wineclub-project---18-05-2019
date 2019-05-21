<nav class="uk-navbar-container" uk-navbar>

    <div class="uk-navbar-left">
      <div class="logo">
      <a href="index.php"><img id="winelogo" src="../public/img/wineclublogo.webp" /></a>
    </div>
    </div>
    <div class="nav-desktop uk-navbar-right">

        <ul class="uk-navbar-nav">
            <li class="uk-active"><a href="index.php"> Home <i class="fas fa-home"></i></a></li>
            <li><a href="../public/wines.php"> Wines <i class="fas fa-wine-glass-alt"></i></a></li>
            <li><a href="../public/winetable.php"> Tables <i class="fas fa-table"></i></a></li>
            <li class="uk-active"><a href="/"> Frontpage <i class="far fa-arrow-alt-circle-up"></i></a></li>
            <li><a href="logout.php"> Logout <i class="fas fa-sign-out-alt"></i></a></li>
        </ul>

    </div>

    <a href="#offcanvas-slide" class="nav-mobile uk-button" uk-toggle><span uk-icon="menu"></span></a>

    <div id="offcanvas-slide" uk-offcanvas>
        <div class="uk-offcanvas-bar">

        <ul class="uk-nav uk-nav-default">
        <li><a href="index.php"> Home <i class="far fa-arrow-alt-circle-up"></i></a></li>
        <li class="uk-active"><a href="index.php"> Home <i class="fas fa-home"></i></a></li>
            <li><a href="wines.php"> Wines <i class="fas fa-wine-glass-alt"></i></a></li>
            <li><a href="winetable.php"> Tables <i class="fas fa-table"></i></a></li>
            <li><a href="logout.php"> Logout <i class="fas fa-sign-out-alt"></i></a></li>
        </ul>

    </div>
</div>
</nav>
