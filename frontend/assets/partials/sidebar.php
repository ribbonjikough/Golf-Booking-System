<?php
// Use $topbar_title or $_GET['section'] for AJAX/mobile
if (isset($_GET['section'])) {
    $sidebar_type = strtolower(trim($_GET['section']));
} else {
    $sidebar_type = isset($topbar_title) ? strtolower(trim($topbar_title)) : 'dashboard';
}
$current_file = isset($_GET['current']) ? $_GET['current'] : basename($_SERVER['SCRIPT_NAME']);

function is_active($file) {
    global $current_file;
    return $current_file === $file ? ' active' : '';
}
?>
<div class="side-menu side-menu-mobile">
  <div class="frame frame-mobile">
    <?php
    switch ($sidebar_type) {
      case 'dashboard': // Global Overview
        ?>
        <a href="index.php" class="menu-item<?= is_active('index.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('index.php') ?>"></div></div>
          <div class="transactions">Global Overview</div>
        </a>
        <a href="dashboard_season.php" class="menu-item<?= is_active('dashboard_season.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('dashboard_season.php') ?>"></div></div>
          <div class="transactions">Season Parking</div>
        </a>
        <?php
        break;

      case 'parking':
        ?>
        <a href="car_in_park.php" class="menu-item<?= is_active('car_in_park.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('car_in_park.php') ?>"></div></div>
          <div class="transactions">Car in Park</div>
        </a>
        <a href="parking_manual.php" class="menu-item<?= is_active('parking_manual.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('parking_manual.php') ?>"></div></div>
          <div class="transactions">Manual Gate Opening Record</div>
        </a>
        <a href="parking_history.php" class="menu-item<?= is_active('parking_history.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('parking_history.php') ?>"></div></div>
          <div class="transactions">Parking History</div>
        </a>
        <a href="parking_lpr.php" class="menu-item<?= is_active('parking_lpr.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('parking_lpr.php') ?>"></div></div>
          <div class="transactions">LPR Logs</div>
        </a>
        <?php
        break;

      case 'season parking':
        ?>
        <a href="season_parking_list.php" class="menu-item<?= is_active('season_parking_list.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('season_parking_list.php') ?>"></div></div>
          <div class="transactions">Season Parking List</div>
        </a>
        <a href="season_applications.php" class="menu-item<?= is_active('season_applications.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('season_applications.php') ?>"></div></div>
          <div class="transactions">Applications</div>
        </a>
        <a href="season_refunds.php" class="menu-item<?= is_active('season_refunds.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('season_refunds.php') ?>"></div></div>
          <div class="transactions">Refunds</div>
        </a>
        <a href="season_einvoice.php" class="menu-item<?= is_active('season_einvoice.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('season_einvoice.php') ?>"></div></div>
          <div class="transactions">E-Invoice</div>
        </a>
        <a href="season_reporting.php" class="menu-item<?= is_active('season_reporting.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('season_reporting.php') ?>"></div></div>
          <div class="transactions">Reporting</div>
        </a>
        <a href="season_access_cards.php" class="menu-item<?= is_active('season_access_cards.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('season_access_cards.php') ?>"></div></div>
          <div class="transactions">Access Cards</div>
        </a>
        <?php
        break;

      case 'report':
        ?>
        <a href="transactions.php" class="menu-item<?= is_active('transactions.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('transactions.php') ?>"></div></div>
          <div class="transactions">Transactions</div>
        </a>
        <a href="daily_sales.php" class="menu-item<?= is_active('daily_sales.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('daily_sales.php') ?>"></div></div>
          <div class="transactions">Daily Sales</div>
        </a>
        <a href="hourly_traffic.php" class="menu-item<?= is_active('hourly_traffic.php') ?>"></div></div>
          <div class="transactions">Hourly Traffic</div>
        </a>
        <a href="monthly_sales.php" class="menu-item<?= is_active('monthly_sales.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('monthly_sales.php') ?>"></div></div>
          <div class="transactions">Monthly Sales</div>
        </a>
        <a href="length_of_stay.php" class="menu-item<?= is_active('length_of_stay.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('length_of_stay.php') ?>"></div></div>
          <div class="transactions">Length of Stay</div>
        </a>
        <a href="manual_open_barrier.php" class="menu-item<?= is_active('manual_open_barrier.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('manual_open_barrier.php') ?>"></div></div>
          <div class="transactions">Manual Open Barrier</div>
        </a>
        <a href="redemption_transactions.php" class="menu-item<?= is_active('redemption_transactions.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('redemption_transactions.php') ?>"></div></div>
          <div class="transactions">Redemption Transactions</div>
        </a>
        <?php
        break;

      case 'admin': // Settings
      case 'settings':
        ?>
        <a href="parking_rate_adjustment.php" class="menu-item<?= is_active('parking_rate_adjustment.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('parking_rate_adjustment.php') ?>"></div></div>
          <div class="transactions">Parking Rate Adjustment</div>
        </a>
        <a href="season_parking_adjustment.php" class="menu-item<?= is_active('season_parking_adjustment.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('season_parking_adjustment.php') ?>"></div></div>
          <div class="transactions">Season Parking Adjustment</div>
        </a>
        <a href="privileges.php" class="menu-item<?= is_active('privileges.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('privileges.php') ?>"></div></div>
          <div class="transactions">Privileges</div>
        </a>
        <a href="redemptions.php" class="menu-item<?= is_active('redemptions.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('redemptions.php') ?>"></div></div>
          <div class="transactions">Redemptions</div>
        </a>
        <a href="settings.php" class="menu-item<?= is_active('settings.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('settings.php') ?>"></div></div>
          <div class="transactions">Settings</div>
        </a>
        <a href="profile.php" class="menu-item<?= is_active('profile.php') ?>">
          <div class="radio-btn"><div class="radio-circle<?= is_active('profile.php') ?>"></div></div>
          <div class="transactions">Profile</div>
        </a>
        <?php
        break;
    }
    ?>
  </div>
</div>