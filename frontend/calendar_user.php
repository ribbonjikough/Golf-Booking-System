<?php
$page_title = 'Calendar';
$page_subtext = 'View your facility bookings in a calendar view.';
$current_page = 'Calendar';

$breadcrumbs = [
    ['title' => 'Home', 'url' => 'index.php'],
    ['title' => 'Calendar', 'url' => 'calendar_user.php']
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? htmlspecialchars($page_title) : 'Page Title' ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/styleguide.css">
    <link rel="stylesheet" href="assets/css/globals.css">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/calendar.css">
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
                <div class="calendar-container">
                    <div class="calendar-header">
                        <button id="prevMonthBtn">&lt;</button>
                        <span id="calendarMonthYear"></span>
                        <button id="nextMonthBtn">&gt;</button>
                    </div>
                    <div class="calendar-grid" id="calendarGrid"></div>
                    <div class="calendar-legend">
                        <span class="calendar-box today"></span> Today
                        <span class="calendar-box booked"></span> Booked
                        <span class="calendar-box past"></span> Past
                        <span class="calendar-box other-month"></span> Other Month
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="assets/js/script.js"></script>
<script src="assets/js/calendar.js"></script>
</html>