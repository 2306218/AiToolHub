<?php 
  include 'include/connection.php';
  session_start();
  $msg="";
  if (isset($_POST['sendMsg'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $insert = "INSERT INTO `contact`(`name`, `email`, `message`) VALUES ('$name','$email','$message')";
    $run = mysqli_query($connect,$insert);
    if ($run) {
      $msg = "<div class='alert alert-success'>Your message has been sent successfully. We will contact you soon.</div>";
    }else{
      $msg = "<div class='alert alert-danger'>You message not send</div>";
    }
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - AI Tools Hub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>
  <?php include 'include/header.php'; ?>

  <header class="hero">
      <div class="container text-center">
          <h1 class="animate-fade-in-up">Contact Us</h1>
          <p class="lead animate-fade-in-up">Get in touch with the AI Tools Hub team</p>
      </div>
  </header>

  <main class="container">
      <section class="my-5">
          <div class="row">
              <div class="col-lg-8 mx-auto">
                  <div class="card py-3">
                      <div class="card-body">
                          <h2 class="card-title text-center mb-4">Send Us a Message</h2>
                          <form method="POST" enctype="multipart/form-data">
                            <?php echo $msg; ?>
                              <div class="mb-3">
                                  <label for="name" class="form-label">Your Name<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control" id="name" name="name" required>
                              </div>
                              <div class="mb-3">
                                  <label for="email" class="form-label">Email<span class="text-danger">*</span> address</label>
                                  <input type="email" class="form-control" id="email" name="email" required>
                              </div>
                              <div class="mb-3">
                                  <label for="message" class="form-label">Message<span class="text-danger">*</span></label>
                                  <textarea class="form-control" id="message" rows="5" name="message" required></textarea>
                              </div>
                              <div class="text-center">
                                  <button type="submit" name="sendMsg" class="btn btn-primary">Send Message</button>
                              </div>
                          </form>
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

