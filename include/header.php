<nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
          <a class="navbar-brand" href="index.html">AI Tools Hub</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="index.php">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="about.php">About</a>
                  </li>
                  <?php 
                     if (isset($_SESSION['email'])) { ?>
                      <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle">
                            Account
                            <svg class="chevron" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="account.php" class="dropdown-item">My Profile</a></li>
                            <li><a href="my_interest.php" class="dropdown-item">My Interest AI</a></li>
                            <li><a href="logout.php" class="dropdown-item">Logout</a></li>
                        </ul>
                      </li>
                   <?php  }else{

                   }
                   ?>
                  <li class="nav-item">
                      <a class="nav-link" href="upload-links.php">Upload Links</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="contact.php">Contact</a>
                  </li>
                  <?php if (!isset($_SESSION['email'])) { ?>
                      <li class="nav-item d-flex">
                          <span><a class="nav-link" href="login.php">Login /</a></span>
                          <span><a class="nav-link px-0" href="register.php">Register</a></span>
                      </li>
                  <?php } ?>
              </ul>
          </div>
      </div>
  </nav>
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.dropdown-toggle');
        const menu = dropdown.querySelector('.dropdown-menu');

        toggle.addEventListener('mouseenter', () => {
            menu.style.display = 'block';
        });

        dropdown.addEventListener('mouseleave', () => {
            menu.style.display = 'none';
        });
    });
});
  </script>