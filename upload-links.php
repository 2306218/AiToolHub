<?php 
  include 'include/connection.php';
  include 'include/session.php';
  $userId = $_SESSION['userId'];
  if (isset($_POST['submitAI'])) {
    $userId = $_SESSION['userId'];
    $toolName = $_POST['toolName'];
    $toolURL = $_POST['toolURL'];
    $toolImage = "assets/images/". uniqid() . "_" . $_FILES['toolImage'] ['name'];
    move_uploaded_file($_FILES['toolImage'] ['tmp_name'], $toolImage);
    $toolCategory = $_POST['toolCategory'];
    $toolDescription = $_POST['toolDescription'];
    $insert = "INSERT INTO `tools`(`userId`, `toolName`, `toolURL`, `toolImage`, `toolCategory`, `toolDescription`) VALUES ('$userId','$toolName','$toolURL','$toolImage','$toolCategory','$toolDescription')";
    $run = mysqli_query($connect,$insert);
    if ($run) {
      header('Location: index.php');
      exit();
    }else{

    }
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload AI Links - AI Tools Hub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>
  <?php include 'include/header.php'; ?>

  <header class="hero">
      <div class="container text-center">
          <h1 class="animate-fade-in-up">Upload AI Links</h1>
          <p class="lead animate-fade-in-up">Share your favorite AI tools with the community</p>
      </div>
  </header>

  <main class="container">
      <section class="my-5">
          <div class="row">
              <div class="col-lg-8 mx-auto">
                  <div class="card py-3">
                      <div class="card-body">
                          <h2 class="card-title text-center mb-4">Submit an AI Tool</h2>
                          <form method="POST" enctype="multipart/form-data">
                              <div class="mb-3">
                                  <label for="tool-name" class="form-label">AI Tool Name</label>
                                  <input type="text" class="form-control" id="tool-name" name="toolName" required>
                              </div>
                              <div class="mb-3">
                                  <label for="tool-url" class="form-label">AI Tool URL</label>
                                  <input type="url" class="form-control" id="tool-url" name="toolURL" required>
                              </div>
                              <div class="mb-3">
                                  <label for="tool-url" class="form-label">AI Tool Image</label>
                                  <input type="file" class="form-control" id="tool-Image" name="toolImage" required>
                              </div>
                              <div class="mb-3">
                                  <label for="tool-category" class="form-label">Category</label>
                                  <select class="form-select" id="tool-category" required name="toolCategory">
                                      <option value="">Select a category</option>
                                      <?php 
                                        $cateQuery = "SELECT * FROM `categories`";
                                        $cateResult = mysqli_query($connect,$cateQuery);
                                        if (mysqli_num_rows($cateResult)>0) {
                                          while ($cateRow = mysqli_fetch_assoc($cateResult)) {
                                          
                                       ?>
                                      <option value="<?php echo $cateRow['id']; ?>"><?php echo $cateRow['name']; ?></option>
                                      <?php }
                                        } ?>
                                  </select>
                              </div>
                              <div class="mb-3">
                                  <label for="tool-description" class="form-label">Short Description</label>
                                  <textarea class="form-control" id="tool-description" name="toolDescription" rows="3" required></textarea>
                              </div>
                              
                              <div class="text-center">
                                  <button type="submit" name="submitAI" class="btn btn-primary">Submit AI Tool</button>
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

