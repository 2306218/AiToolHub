<?php 
include 'include/connection.php';
session_start();

$msg = "";

if (isset($_POST['userLogin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = mysqli_real_escape_string($connect, $email);

    $query = "SELECT * FROM `register` WHERE email='$email'";
    $result = mysqli_query($connect, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPasswordFromDatabase = $row['password'];

        if (password_verify($password, $hashedPasswordFromDatabase)) {
            $_SESSION['userId'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            header("Location: index.php");
            exit();
        } else {
            $msg = "<div class='alert alert-danger'>Invalid login information</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Invalid login information</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - AI Tools Hub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>
  <?php include 'include/header.php'; ?>

  <header class="hero">
      <div class="container text-center">
          <h1 class="animate-fade-in-up">Login</h1>
          <p class="lead animate-fade-in-up">Access your AI Tools Hub account</p>
      </div>
  </header>

  <main class="container">
      <section class="my-5">
          <div class="row">
              <div class="col-lg-6 mx-auto">
                  <div class="card py-3">
                      <div class="card-body">
                          <h2 class="card-title text-center mb-5">Login</h2>
                          <form method="POST" enctype="multipart/form-data">
                              <div class="mb-3">
                                  <label for="email" class="form-label">Email address<span class="text-danger">*</span></label>
                                  <input type="email" class="form-control" id="email" name="email" required>
                              </div>
                              <div class="mb-3">
                                  <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                                  <input type="password" class="form-control" id="password" name="password" required>
                              </div>

                              <div class="text-center">
                                  <button type="submit" name="userLogin" class="btn btn-primary">Login</button>
                              </div>
                          </form>
                          <p class="mt-3 text-center">Don't have an account? <a href="register.php">Register here</a></p>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </main>

  <?php include 'include/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

