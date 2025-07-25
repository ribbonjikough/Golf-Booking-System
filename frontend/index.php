<?php
$topbar_title = 'Admin';
$page_title = 'Profile';
$page_subtext = 'This page allows you to view and edit your profile information.';
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
                <div class="dashboard-header-row">
                    <div class="dashboard-title">Dashboard</div>
                    <div class="dashboard-searchbar">
                        <span class="dashboard-search-icon">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="9" cy="9" r="7" stroke="#888" stroke-width="2"/>
                                <line x1="15" y1="15" x2="19" y2="19" stroke="#888" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <input type="search" class="dashboard-search-input" placeholder="Search anything...">
                    </div>
                </div>
                <div class="dashboard-card club-info-card">
                    <div class="club-info-title">Club Info</div>
                    <div class="club-info-list">
                        <div><b>Club Name:</b> CLL Golf Club</div>
                        <div><b>Location:</b> CLL Golf Club</div>
                        <div><b>Operating Hours:</b> 8.00 am - 8.00 pm</div>
                    </div>
                </div>
                <div class="dashboard-cards-row">
                    <div class="dashboard-summary-card">
                        <div class="dashboard-summary-value">3</div>
                        <div class="dashboard-summary-label">Upcoming Bookings</div>
                    </div>
                    <div class="dashboard-summary-card">
                        <div class="dashboard-summary-value card-balance-fee">RM 170.00</div>
                        <div class="dashboard-summary-label">Outstanding Balance</div>
                    </div>
                    <div class="dashboard-summary-card">
                        <div class="dashboard-summary-value">RM 300.00</div>
                        <div class="dashboard-summary-label">This Month's Charges</div>
                    </div>
                    <div class="dashboard-summary-card">
                        <div class="dashboard-summary-value">
                            Active
                            <span class="toptopbar-membership gold">(<?= htmlspecialchars($membership_level) ?>)</span>
                        </div>
                        <div class="dashboard-summary-label">Membership Status</div>
                    </div>
                </div>
                <div class="dashboard-card dashboard-table-card">
                    <div class="dashboard-table-title">Recent Bookings</div>
                    <div class="dashboard-table-wrapper">
                        <table class="dashboard-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Facility</th>
                                    <th>Club</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>18-Jun-2025</td>
                                    <td>Golf 18 holes</td>
                                    <td>Skyline Golf & Resort</td>
                                    <td><span class="booking-status booked">Booked</span></td>
                                </tr>
                                <tr>
                                    <td>15-Jun-2025</td>
                                    <td>Swimming Pool</td>
                                    <td>Lagoon Aquatic Centre</td>
                                    <td><span class="booking-status booked">Booked</span></td>
                                </tr>
                                <tr>
                                    <td>12-Jun-2025</td>
                                    <td>Golf - Guest</td>
                                    <td>Palm Greens Club</td>
                                    <td><span class="booking-status pending">Pending</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="assets/js/script.js"></script>
</html>