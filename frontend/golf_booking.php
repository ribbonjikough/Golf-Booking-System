<?php
$page_title = 'Golf Booking';
$page_subtext = 'Book your golf session here.';
$current_page = 'Facility Booking'; // This makes "Facility Booking" active in the topbar

// Breadcrumbs for toptopbar
$breadcrumbs = [
    ['title' => 'Home', 'url' => 'index.php'],
    ['title' => 'Facility Booking', 'url' => '#'],
    ['title' => 'Golf Booking', 'url' => 'golf_booking.php']
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
                <button type="button" class="golf-booking-now-btn" id="bookingNowBtn">Booking Now</button>

                <div class="golf-booking-events-container">
                    <h2 class="golf-booking-title">Upcoming Club Events</h2>

                    <div class="golf-event-card" data-event="1">
                        <img src="https://picsum.photos/seed/golf1/800/200" class="golf-event-image" alt="Event Image">
                        <div class="golf-event-content">
                            <h3>Palm Annual Golf Tournament</h3>
                            <p>Duration: 17 June 2025 - 24 June 2025</p>
                            <button type="button" class="golf-event-calendar-btn" onclick="toggleCalendar(1, 17, 24, 'June')">View Calendar</button>
                            <div class="golf-event-calendar" id="calendar-1"></div>
                        </div>
                    </div>

                    <div class="golf-event-card" data-event="2">
                        <img src="https://picsum.photos/seed/tennis/800/200" class="golf-event-image" alt="Event Image">
                        <div class="golf-event-content">
                            <h3>Golf Seminar Junior Tournament</h3>
                            <p>Duration: 25 June 2025 - 30 June 2025</p>
                            <button type="button" class="golf-event-calendar-btn" onclick="toggleCalendar(2, 25, 30, 'June')">View Calendar</button>
                            <div class="golf-event-calendar" id="calendar-2"></div>
                        </div>
                    </div>

                    <div class="golf-event-card" data-event="3">
                        <img src="https://picsum.photos/seed/swimming/800/200" class="golf-event-image" alt="Event Image">
                        <div class="golf-event-content">
                            <h3>CLL Employees Golf Tournament</h3>
                            <p>Duration: 5 July 2025 - 12 July 2025</p>
                            <button type="button" class="golf-event-calendar-btn" onclick="toggleCalendar(3, 5, 12, 'July')">View Calendar</button>
                            <div class="golf-event-calendar" id="calendar-3"></div>
                        </div>
                    </div>
                </div>

                <div class="golf-booking-modal" id="bookingModal">
                    <div class="golf-booking-modal-content">
                        <span class="golf-booking-close-btn" id="closeModalBtn">&times;</span>
                        <h3>Book Tee Time</h3>
                        <form id="bookingForm">
                            <label for="playerName">Player Name:</label>
                            <input type="text" id="playerName" required>

                            <label for="email">Email:</label>
                            <input type="email" id="email" required>

                            <label for="selectedSlot">Selected Date:</label>
                            <input type="text" id="selectedSlot" readonly>

                            <button type="submit">Book Now</button>
                        </form>
                    </div>
                </div>

                <div class="golf-booking-overlay" id="bookingOverlay">
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
            </div>
        </div>
    </div>
</body>
<script src="assets/js/script.js"></script>
<script>
const daysOfWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

function toggleCalendar(eventId, startDay, endDay, month='June') {
    const calId = `calendar-${eventId}`;
    const calendar = document.getElementById(calId);

    // Hide all other calendars
    document.querySelectorAll('.golf-event-calendar').forEach(cal => {
        if (cal !== calendar) cal.style.display = 'none';
    });

    if (calendar.style.display === 'grid') {
        calendar.style.display = 'none';
        return;
    }

    calendar.innerHTML = '';

    // Add day labels
    daysOfWeek.forEach(day => {
        const label = document.createElement('div');
        label.className = 'day-label';
        label.textContent = day;
        calendar.appendChild(label);
    });

    // For demo, assume 30 days in June/July
    for (let day = 1; day <= 30; day++) {
        const cell = document.createElement('div');
        cell.textContent = `${month} ${day}`;
        if (day >= startDay && day <= endDay) {
            cell.classList.add('event-day');
            cell.onclick = function() {
                openBookingModal(`${month} ${day}, 2025`);
            };
        }
        calendar.appendChild(cell);
    }

    calendar.style.display = 'grid';
}

// Modal logic
const bookingModal = document.getElementById('bookingModal');
const closeModalBtn = document.getElementById('closeModalBtn');
const bookingForm = document.getElementById('bookingForm');

function openBookingModal(selectedDate) {
    document.getElementById('selectedSlot').value = selectedDate;
    bookingModal.style.display = 'flex';
}

function closeModal() {
    bookingModal.style.display = 'none';
}

if (closeModalBtn) closeModalBtn.onclick = closeModal;
window.onclick = function(event) {
    if (event.target === bookingModal) closeModal();
};

if (bookingForm) {
    bookingForm.onsubmit = function(e) {
        e.preventDefault();
        alert('Booking submitted (not functional)');
        closeModal();
    };
}

// Overlay logic
const bookingNowBtn = document.getElementById('bookingNowBtn');
const bookingOverlay = document.getElementById('bookingOverlay');
const closeOverlayBtn = document.getElementById('closeOverlayBtn');
const bookingOverlayForm = document.getElementById('bookingOverlayForm');

if (bookingNowBtn) {
    bookingNowBtn.onclick = function() {
        bookingOverlay.style.display = 'flex';
    };
}
if (closeOverlayBtn) {
    closeOverlayBtn.onclick = function() {
        bookingOverlay.style.display = 'none';
    };
}
window.addEventListener('click', function(e) {
    if (e.target === bookingOverlay) bookingOverlay.style.display = 'none';
});
if (bookingOverlayForm) {
    bookingOverlayForm.onsubmit = function(e) {
        e.preventDefault();
        const course = document.getElementById('courseSelect').value;
        const date = document.getElementById('dateSelect').value;
        if (course && date) {
            // Redirect with query params
            window.location.href = `golf_booking_selection.php?course=${encodeURIComponent(course)}&date=${encodeURIComponent(date)}`;
        }
    };
}
</script>
</html>