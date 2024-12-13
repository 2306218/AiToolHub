<?php 
include 'include/connection.php';
session_start();
$msg = "";
if (isset($_POST['registerbtn'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check_query = "SELECT * FROM `register` WHERE `email` = '$email' OR `username` = '$username'";
    $check_run = mysqli_query($connect, $check_query);

    if (mysqli_num_rows($check_run) > 0) {
      $msg = "<div class='alert alert-danger'>Error: Email or Username already exists.</div>";
    } else {
        $insert = "INSERT INTO `register`(`username`, `email`, `password`) VALUES ('$username','$email','$password')";
        $run = mysqli_query($connect, $insert);

        if ($run) {
          header('Location: login.php');
          exit();
        } else {
          $msg = "<div class='alert alert-danger'>Unable to register user.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - AI Tools Hub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>
  <?php include 'include/header.php'; ?>

  <header class="hero">
      <div class="container text-center">
          <h1 class="animate-fade-in-up">Register</h1>
          <p class="lead animate-fade-in-up">Join the AI Tools Hub community</p>
      </div>
  </header>

  <main class="container">
      <section class="my-5">
          <div class="row">
              <div class="col-lg-7 mx-auto">
                  <div class="card py-3">
                      <div class="card-body">
                          <h2 class="card-title text-center mb-4">Create Your Account</h2>
                          <form method="POST" enctype="multipart/form-data">
                            <?php echo $msg; ?>
                              <div class="mb-3">
                                  <label for="username" class="form-label">Username<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control" id="username" name="username" required>
                              </div>
                              <div class="mb-3">
                                  <label for="email" class="form-label">Email address<span class="text-danger">*</span></label>
                                  <input type="email" class="form-control" id="email" name="email" required>
                              </div>
                              <div class="mb-3">
                                  <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                                  <input type="password" class="form-control" id="password" name="password" required>
                              </div>
                              <div class="mb-3">
                                  <label for="confirm-password" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                                  <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                              </div>
                              
                              <div class="text-center">
                                <div id="password-error" style="color: red; display: none;" class="text-start mb-3">Passwords do not match!</div>
                                  <button type="submit" id="registerbtn" class="btn btn-primary" name="registerbtn">Register</button>
                              </div>
                          </form>
                          <p class="mt-3 text-center">Already have an account? <a href="login.php">Login here</a></p>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </main>

  <?php include 'include/footer.php'; ?>
  <script type="text/javascript">
    document.getElementById('registerbtn').addEventListener('click', function (e) {
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirm-password').value;
  const errorDiv = document.getElementById('password-error');

  if (password !== confirmPassword) {
    e.preventDefault(); // Prevent form submission
    errorDiv.style.display = 'block'; // Show error message
    errorDiv.textContent = 'Passwords do not match!';
  } else {
    errorDiv.style.display = 'none'; // Hide error message
  }
});

  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

