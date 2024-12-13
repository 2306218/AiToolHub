<?php 
include 'include/connection.php';
include 'include/session.php';

$userId = $_SESSION['userId'];

// Fetch existing user interests
$selectedInterests = [];
$query = "SELECT interestId FROM interest WHERE userId = '$userId'";
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $selectedInterests[] = $row['interestId'];
    }
}

// Handle form submission
if (isset($_POST['interestSubmit'])) {
    $interests = $_POST['interestId']; // Captures IDs as a comma-separated string

    // Ensure interests are split into an array
    $interestArray = explode(',', $interests);

    // Delete old interests
    $deleteQuery = "DELETE FROM interest WHERE userId = '$userId'";
    mysqli_query($connect, $deleteQuery);

    // Insert new interests
    foreach ($interestArray as $interest) {
        $interest = trim($interest); // Trim whitespace
        if (!empty($interest)) {
            $insert = "INSERT INTO `interest`(`userId`, `interestId`) VALUES ('$userId', '$interest')";
            mysqli_query($connect, $insert);
        }
    }

    // Redirect to the account page
    header('Location: account.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Interests - AI Tools Hub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>
  <?php include 'include/header.php'; ?>

  <header class="hero">
      <div class="container text-center">
          <h1>User Interests</h1>
          <p class="lead">Update your interests to personalize your AI Tools Hub experience.</p>
      </div>
  </header>

  <main class="container">
      <section class="my-5">
          <div class="row">
              <div class="col-lg-8 mx-auto">
                  <div class="card">
                      <div class="card-body">
                          <h2 class="card-title text-center mb-4">Update Your Interests</h2>
                          <form id="interestsForm" method="POST" action="">
                              <div class="mb-3">
                                  <label for="interests" class="form-label">Choose your interests (multiple selection allowed)</label>
                                  <select class="form-select" id="interests" size="8">
                                      <?php 
                                      $query = "SELECT * FROM `categories`";
                                      $result = mysqli_query($connect, $query);
                                      if (mysqli_num_rows($result) > 0) {
                                          while ($row = mysqli_fetch_assoc($result)) {
                                              $isSelected = in_array($row['id'], $selectedInterests) ? 'selected' : '';
                                      ?>
                                      <option value="<?php echo $row['id']; ?>" class="<?php echo $isSelected; ?>"><?php echo $row['name']; ?></option>
                                      <?php 
                                          }
                                      } 
                                      ?>
                                  </select>
                              </div>
                              <div class="mb-3">
                                  <label for="other-interests" class="form-label">Selected Interests (categories names)</label>
                                  <input type="text" class="form-control" id="other-interests" readonly>
                                  <input type="hidden" name="interestId" id="interestId">
                              </div>
                              <div class="text-center">
                                  <button type="submit" class="btn btn-primary" name="interestSubmit">Update Interests</button>
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
  <script>
    // Get references to the DOM elements
    const interestsSelect = document.getElementById('interests');
    const otherInterestsInput = document.getElementById('other-interests');
    const hiddenInterestIdsInput = document.getElementById('interestId');

    // Initialize selected options on page load
    document.addEventListener('DOMContentLoaded', () => {
        updateSelectedInterests(); // Populate the input fields with initial values
    });

    // Handle click events on the <select> element
    interestsSelect.addEventListener('click', function (e) {
        e.preventDefault(); // Prevent default selection behavior

        const option = e.target; // Get the clicked option
        if (option.tagName === 'OPTION') {
            // Toggle the selected state
            option.classList.toggle('selected'); // Add/remove a CSS class for styling

            // Update the visible and hidden input fields
            updateSelectedInterests();
        }
    });

    // Function to update the selected interests
    function updateSelectedInterests() {
        // Get all options with the "selected" class
        const selectedOptions = Array.from(interestsSelect.options).filter(option =>
            option.classList.contains('selected')
        );

        // Extract names and IDs from selected options
        const selectedNames = selectedOptions.map(option => option.text);
        const selectedIds = selectedOptions.map(option => option.value);

        // Update the visible input and the hidden input
        otherInterestsInput.value = selectedNames.join(', ');
        hiddenInterestIdsInput.value = selectedIds.join(', ');
    }
  </script>
</body>
</html>
