<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? htmlspecialchars($page_title) : 'Page Title' ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/styleguide.css">
    <link rel="stylesheet" href="assets/css/globals.css">
</head>
<body>
    <div class="main-wrapper">
        <?php include 'assets/partials/toptopbar.php'; ?>
        <?php include 'assets/partials/topbar.php'; ?>

        <div class="main-content">
            <div class="page-header">
                <h1><?= isset($page_title) ? htmlspecialchars($page_title) : 'Page Title' ?></h1>
                <?php if (isset($page_subtext)): ?>
                    <div class="page-subtext"><?= htmlspecialchars($page_subtext) ?></div>
                <?php endif; ?>
            </div>
            <div class="content">
                <!-- Main page content goes here -->
            </div>
        </div>
    </div>
</body>
</html>