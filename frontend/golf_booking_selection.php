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

$course = isset($_GET['course']) ? strtoupper($_GET['course']) . ' COURSE' : 'EAST COURSE';
$date = isset($_GET['date']) ? date('j F Y', strtotime($_GET['date'])) : date('j F Y');
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

                <!-- Player Selection Overlay -->
                <div class="golf-player-select-overlay" id="playerSelectOverlay" style="display:none;">
                    <div class="golf-player-select-content">
                        <h3>How many person per flight?</h3>
                        <div class="golf-player-select-btns" id="playerCountBtns">
                            <button type="button" class="player-count-btn" data-count="1">1</button>
                            <button type="button" class="player-count-btn active" data-count="2">2</button>
                            <button type="button" class="player-count-btn" data-count="3">3</button>
                            <button type="button" class="player-count-btn" data-count="4">4</button>
                        </div>
                        <div class="golf-player-select-jumbo">
                            <label>
                                Enable Jumbo?
                                <input type="checkbox" id="jumboCheckbox">
                            </label>
                        </div>
                        <div class="golf-player-select-estimate" id="playerTimeEstimate">
                            Estimated Time: <span id="playerTimeRange">11:00 a.m. to 12.30 p.m.</span>
                        </div>
                        <div class="golf-player-select-icons" id="playerIcons">
                            <!-- Player icons will be rendered here -->
                        </div>
                        <div class="golf-player-select-actions">
                            <button type="button" class="player-select-next" id="playerSelectNextBtn">Next</button>
                            <button type="button" class="player-select-cancel" id="playerSelectCancelBtn">Cancel</button>
                        </div>
                    </div>
                </div>

                <!-- Player Details Overlay -->
                <div class="golf-player-details-overlay" id="playerDetailsOverlay" style="display:none;">
                    <div class="golf-player-details-content">
                        <h3>Enter the players details</h3>
                        <form id="playerDetailsForm">
                            <div id="playerDetailsInputs"></div>
                            <div class="golf-player-details-actions">
                                <button type="submit" class="player-details-confirm">Confirm</button>
                                <button type="button" class="player-details-cancel" id="playerDetailsCancelBtn">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Payment/Booking Details Overlay -->
                <div class="golf-payment-overlay" id="paymentOverlay" style="display:none;">
                    <div class="golf-payment-content">
                        <h2 class="golf-payment-title">Booking Details</h2>
                        <div class="golf-payment-details" id="bookingDetails"></div>
                        <div class="golf-payment-actions">
                            <button type="button" class="golf-payment-btn" id="payNowBtn">Pay Now</button>
                            <button type="button" class="golf-payment-btn golf-payment-btn-grey" id="payLaterBtn">Pay Later (Add to Account)</button>
                        </div>
                    </div>
                </div>

                <!-- Leave space for booking selection content below -->
                <div class="golf-booking-times-header"><?= htmlspecialchars($course ?? 'EAST COURSE') ?></div>
                <div class="golf-booking-times-date"><?= htmlspecialchars($date ?? date('j F Y')) ?></div>
                <div class="golf-booking-times-grid">
                    <?php
                    // Demo data for tee times
                    $times = [
                        '11:00 am', '11:00 am', '11:00 am', '11:00 am',
                        '11:15 am', '11:15 am', '11:15 am', '11:15 am',
                        '11:30 am', '11:30 am', '11:30 am', '11:30 am',
                        '11:45 am', '11:45 am', '11:45 am', '11:45 am',
                    ];
                    // Demo: which slots are unavailable (0-based index)
                    $unavailable = [0, 2, 3, 5, 8, 10, 13, 15];
                    foreach ($times as $i => $time):
                        $isUnavailable = in_array($i, $unavailable);
                    ?>
                    <div class="golf-booking-time-card<?= $isUnavailable ? ' unavailable' : '' ?>">
                        <div class="golf-booking-time-row">
                            <span class="golf-booking-time-label">Time:</span>
                            <span class="golf-booking-time-value"><?= $time ?></span>
                        </div>
                        <div class="golf-booking-time-row">
                            <span class="golf-booking-time-label">Tee#</span>
                            <span class="golf-booking-time-value">1</span>
                        </div>
                        <div class="golf-booking-time-players">
                            <?php for ($p = 0; $p < 4; $p++): ?>
                                <img src="assets/img/person_24dp_1C1C1C_FILL0_wght400_GRAD0_opsz24.svg" alt="Player" style="opacity:<?= $isUnavailable ? '0.5' : '1' ?>;">
                            <?php endfor; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>    
    <script>
    <?php if (isset($user_name)): ?>
    window.sessionUserName = <?= json_encode($user_name) ?>;
    <?php endif; ?>
    </script>
    <script src="assets/js/script.js"></script>
</html>