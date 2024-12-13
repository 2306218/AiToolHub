<?php 
  include 'include/connection.php';
  session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AI Tools Hub - Discover Amazing AI Tools</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>
  
  <?php include 'include/header.php'; ?>
  <header class="hero">
      <div class="container text-center">
          <h1 class="animate-fade-in-up">Discover the Power of AI</h1>
          <p class="lead animate-fade-in-up">Explore our curated collection of cutting-edge AI tools</p>
          <a href="register.php" class="btn btn-light btn-lg mt-3 animate-fade-in-up">Get Started</a>
      </div>
  </header>

  <?php
// Query to fetch the latest 8 tools from the 'technology' category
$query = "
    SELECT 
        categories.name AS categoryName,
        tools.toolName AS toolName,
        tools.toolImage AS toolImage,
        tools.toolDescription AS toolDescription,
        tools.toolURL AS toolLink
    FROM tools
    INNER JOIN categories ON tools.toolCategory = categories.id
    WHERE categories.name = 'Technology'
    ORDER BY tools.id DESC
    LIMIT 8
";

$result = mysqli_query($connect, $query);

// Check if tools are available
$tools = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tools[] = $row; // Store tools in an array
    }
}
?>

<main class="container">
    <?php if (!empty($tools)) : ?>
        <section class="my-5">
            <h2 class="section-title">Technology</h2>
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
    <?php else : ?>
        <p class="text-center">No tools available in the Technology category.</p>
    <?php endif; ?>
</main>


  <?php include 'include/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

