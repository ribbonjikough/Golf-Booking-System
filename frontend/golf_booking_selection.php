<?php
$page_title = 'Golf Booking Selection';
$page_subtext = 'Select your course and date for booking.';
$current_page = 'Facility Booking';

$event_name = isset($_GET['event']) ? $_GET['event'] : 'All';

$breadcrumbs = [
    ['title' => 'Home', 'url' => 'index.php'],
    ['title' => 'Golf Booking', 'url' => 'golf_booking.php'],
    ['title' => "Golf Booking (" . htmlspecialchars($event_name) . ")", 'url' => 'golf_booking_selection.php']
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
                <div class="golf-booking-selection-actions">
                    <button type="button" class="golf-booking-now-btn" id="goBackBtn">Go Back</button>
                    <button type="button" class="golf-booking-now-btn" id="chooseCourseBtn">Choose Different Course &amp; Date</button>
                </div>

                <!-- Overlay Modal for Course & Date Selection -->
                <div class="golf-booking-overlay" id="bookingOverlay" style="display:none;">
                    <div class="golf-booking-overlay-content">
                        <span class="golf-booking-overlay-close" id="closeOverlayBtn">&times;</span>
                        <h3>Make a Selection</h3>
                        <form id="bookingOverlayForm">
                            <label for="courseSelect">Select Course:</label>
                            <select id="courseSelect" required>
                                <option value="" disabled selected>Select Course</option>
                                <option value="east">EAST COURSE</option>
                                <option value="west">WEST COURSE</option>
                            </select>
                            <label for="dateSelect">Select Date:</label>
                            <input type="date" id="dateSelect" required>
                            <button type="submit" class="golf-booking-overlay-submit">Proceed</button>
                        </form>
                    </div>
                </div>
                <!-- Leave space for booking selection content below -->
            </div>
        </div>
    </div>
</body>
<script src="assets/js/script.js"></script>
</html>