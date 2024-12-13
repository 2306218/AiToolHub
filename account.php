<?php 
  include 'include/connection.php';
  include 'include/session.php';
  $userId = $_SESSION['userId'];
  $msg = "";
  $msg1 = "";
  if (isset($_POST['updateProfile'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $fullName = $_POST['fullName'];
    if ($_FILES['profile_image']['tmp_name'] !=='') {
      $profile_image= "assets/images/". uniqid() . "_" .$_FILES['profile_image']['name'];
    move_uploaded_file($_FILES['profile_image']['tmp_name'],$profile_image);
    }else{
      $query="SELECT profile_image FROM `register`";
      $result=mysqli_query($connect,$query);
      if ($result) {
        $row=mysqli_fetch_assoc($result);
        $profile_image= $row['profile_image'];
      }else{
        $msg = "<div class='alert alert-danger'>Error fetching old image</div>";
      }
    }
    $update = "UPDATE `register` SET `username`='$username',`fullName`='$fullName',`email`='$email',`profile_image`='$profile_image' WHERE id = '$userId' ";
    $run = mysqli_query($connect,$update);
    if ($run) {
      $msg = "<div class='alert alert-success'>Profile Update Successfully</div>";
    }else{
      $msg = "<div class='alert alert-danger'>Profile not Update</div>";
    }
  }

$profileQuery = "SELECT * FROM `register` WHERE id = '$userId'";
$profileResult = mysqli_query($connect, $profileQuery);

if (mysqli_num_rows($profileResult) > 0) {
    $profileRow = mysqli_fetch_assoc($profileResult);
    $profile_image = $profileRow['profile_image'];
    $email = $profileRow['email'];
    $fullName = $profileRow['fullName'];
    $username = $profileRow['username'];
 ?>
 <?php
  if (isset($_POST['changePassword'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Fetch the current password from the database
    $passwordQuery = "SELECT password FROM `register` WHERE id = '$userId'";
    $passwordResult = mysqli_query($connect, $passwordQuery);

    if ($passwordResult && mysqli_num_rows($passwordResult) > 0) {
        $row = mysqli_fetch_assoc($passwordResult);
        $dbPassword = $row['password'];

        // Verify current password
        if (password_verify($currentPassword, $dbPassword)) {
            // Check if new password matches confirmation
            if ($newPassword === $confirmPassword) {
                // Hash the new password
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                // Update the password in the database
                $updatePasswordQuery = "UPDATE `register` SET `password` = '$hashedPassword' WHERE id = '$userId'";
                if (mysqli_query($connect, $updatePasswordQuery)) {
                    $msg1 = "<div class='alert alert-success'>Password updated successfully!</div>";
                } else {
                    $msg1 = "<div class='alert alert-danger'>Error updating password. Please try again later.</div>";
                }
            } else {
                $msg1 = "<div class='alert alert-danger'>New password and confirmation do not match.</div>";
            }
        } else {
            $msg1 = "<div class='alert alert-danger'>Current password is incorrect.</div>";
        }
    } else {
        $msg1 = "<div class='alert alert-danger'>Error fetching current password. Please try again.</div>";
    }
}

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Account - AI Tools Hub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <link href="styles.css" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>
  <?php include 'include/header.php'; ?>
  <header class="hero">
      <div class="container text-center">
          <h1 class="animate-fade-in-up">My Account</h1>
          <p class="lead animate-fade-in-up">Discover the story behind AI Tools Hub and our vision for the future</p>
      </div>
  </header>
  <div class="account-container">
    <div class="sidebar">
      <div class="user-info">
        <img src="<?php echo !empty($profile_image) ? $profile_image : 'assets/images/user.png'; ?>" alt="User Avatar" class="user-avatar">
        <h3><?php echo $fullName; ?></h3>
        <p><?php echo $email; ?></p>
      </div>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="#profile">
            <i class="bi bi-person-fill"></i> Profile
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#interests">
            <i class="bi bi-star-fill"></i> Interests
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#security">
            <i class="bi bi-shield-lock-fill"></i> Security
          </a>
        </li>
      </ul>
    </div>
    <div class="main-content">
      
      <section id="profile" class="account-section">
        <h2>Profile Information</h2>
        <form method="POST" enctype="multipart/form-data">
          <?php echo $msg; ?>
          <?php echo $msg1; ?>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" value="<?php echo $username; ?>" readonly name="username">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" value="<?php echo $email; ?>" readonly name="email">
          </div>
          <div class="mb-3">
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullname" value="<?php echo $fullName; ?>" name="fullName">
          </div>
          <div class="mb-3">
            <label for="Profile Image" class="form-label">Profile Image</label>
            <input type="file" class="form-control" id="profile_image" value="<?php echo $profile_image; ?>" name="profile_image">
          </div>
          <button type="submit" class="btn btn-primary" name="updateProfile">Update Profile</button>
        </form>
      </section>
      <?php  } ?>
      <section id="interests" class="account-section">
        <h2>My Interests</h2>
        <?php
            $interestQuery = "
                SELECT categories.name AS interestName 
                FROM interest 
                INNER JOIN categories ON interest.interestId = categories.id 
                WHERE interest.userId = '$userId'
            ";
            $interestResult = mysqli_query($connect, $interestQuery);

            $currentInterests = []; // Initialize an array to store interest names

            if (mysqli_num_rows($interestResult) > 0) {
                while ($interestRow = mysqli_fetch_assoc($interestResult)) {
                    $currentInterests[] = $interestRow['interestName']; // Add interest name to the array
                }
            }

            // Convert the interests array to a comma-separated string
            $interestsString = implode(', ', $currentInterests);
            ?>
            <p>
                <span class="fw-bold">Current interests:</span> <?php echo htmlspecialchars($interestsString); ?>
            </p>


        <a href="update_interest.php" class="btn btn-primary">Update Interests</a>

      </section>
      
      <section id="security" class="account-section">
        <h2>Security Settings</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
          Change Password
        </button>
      </section>
    </div>
  </div>

  <!-- Change Password Modal -->
  <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="changePasswordForm" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="currentPassword" class="form-label">Current Password</label>
              <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
            </div>
            <div class="mb-3">
              <label for="newPassword" class="form-label">New Password</label>
              <input type="password" class="form-control" id="newPassword" name="newPassword" required>
            </div>
            <div class="mb-3">
              <label for="confirmPassword" class="form-label">Confirm New Password</label>
              <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary mb-3" name="changePassword">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

 <?php include 'include/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function changePassword() {
      // Add password change logic here
      alert('Password changed successfully!');
      $('#changePasswordModal').modal('hide');
    }
  </script>
</body>
</html>

