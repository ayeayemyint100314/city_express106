<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <img src="" alt="">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <?php if (!isset($_SESSION['loginSuccess']) && !isset($_SESSION['adminEmail'])) { ?>
          <li class="nav-item">
            <a class="nav-link" href="signup.php">Sign Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
        <?php } else {
        ?>
          <li class="nav-item">
            <a class="nav-link" href="#">Dashboard</a>
          </li>
          <form class="d-flex" action="viewItem.php" method="get">
            <input class="form-control me-2" name="kSearch" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-primary" name="bSearch" type="submit">Search</button>
          </form>

          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>