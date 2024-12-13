<?php 
  include 'include/connection.php';
  include 'include/session.php';
  $userId = $_SESSION['userId'];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Interest Ai - AI Tools Hub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>
  <?php include 'include/header.php'; ?>

  <header class="hero">
      <div class="container text-center">
          <h1 class="animate-fade-in-up">Interest AI</h1>
         
      </div>
  </header>

  <main class="container">
      <?php
        // Query to fetch categories and their tools based on user interests
        $query = "
            SELECT categories.name AS categoryName, 
                   tools.toolName AS toolName, 
                   tools.toolImage AS toolImage, 
                   tools.toolDescription AS toolDescription, 
                   tools.toolURL AS toolLink
            FROM tools
            INNER JOIN categories ON tools.toolCategory = categories.id
            INNER JOIN interest ON categories.id = interest.interestId
            WHERE interest.userId = '$userId'
            ORDER BY categories.name
        ";
        $result = mysqli_query($connect, $query);

        // Initialize an empty array to group tools by category
        $categories = [];

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $categories[$row['categoryName']][] = $row; // Group tools by category name
            }
        }
        ?>

    <!-- Dynamic Sections by Category -->
    <?php if (!empty($categories)) : ?>
        <?php foreach ($categories as $categoryName => $tools) : ?>
            <section class="my-5">
                <h2 class="section-title"><?php echo htmlspecialchars($categoryName); ?></h2>
                <div class="row g-4">
                    <?php foreach ($tools as $tool) : ?>
                        <div class="col-md-3">
                            <a href="<?php echo htmlspecialchars($tool['toolLink']); ?>" target="_blank">
                                <div class="card ai-tool-card h-100">
                                    <img src="<?php echo htmlspecialchars($tool['toolImage']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($tool['toolName']); ?>">
                                    <div class="ai-tool-info">
                                        <h5 class="card-title"><?php echo htmlspecialchars($tool['toolName']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($tool['toolDescription']); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
            
        <?php endforeach; ?>
    <?php else : ?>
        <p class="text-center">No tools available based on your interests. Please update your interests.</p>
    <?php endif; ?>

  </main>

  <?php include 'include/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

