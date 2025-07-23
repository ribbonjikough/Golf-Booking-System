<?php
// Set $current_page to the page name (e.g., 'Home', 'Facility Booking', etc.)
// You can set this variable in each page before including the topbar
if (!isset($current_page)) {
    $current_page = 'Home';
}
$pages = [
    'Home' => 'index.php',
    'Facility Booking' => '#',
    'Statement Billing' => 'statement_billing.php',
    'Affiliate Club Apps' => 'affiliate_clubs.php'
];
$facility_sports = [
    'Golf' => 'golf_booking.php',
    'Swimming Pool' => 'swimming_booking.php',
    'Gym' => 'gym_booking.php',
    'Tennis' => 'tennis_booking.php',
    'Pickle' => 'pickle_booking.php',
    'Basketball' => 'basketball_booking.php'
];
?>
<div class="main-topbar">
  <nav class="main-topbar-nav">
    <?php foreach ($pages as $name => $url): 
      $is_active = ($current_page === $name);
    ?>
      <?php if ($name === 'Facility Booking'): ?>
        <div class="main-topbar-link<?= $is_active ? ' active' : '' ?> facility-dropdown-parent" tabindex="0">
          <span class="main-topbar-link-bar"></span>
          <span class="main-topbar-link-text"><?= htmlspecialchars($name) ?></span>
          <span class="facility-dropdown-caret">&#9662;</span>
          <div class="facility-dropdown-list">
            <?php foreach ($facility_sports as $sport => $sport_url): ?>
              <a href="<?= htmlspecialchars($sport_url) ?>" class="facility-dropdown-item"><?= htmlspecialchars($sport) ?></a>
            <?php endforeach; ?>
          </div>
        </div>
      <?php else: ?>
        <a 
          href="<?= htmlspecialchars($url) ?>" 
          class="main-topbar-link<?= $is_active ? ' active' : '' ?>"
          aria-current="<?= $is_active ? 'page' : 'false' ?>"
        >
          <span class="main-topbar-link-bar"></span>
          <span class="main-topbar-link-text"><?= htmlspecialchars($name) ?></span>
        </a>
      <?php endif; ?>
    <?php endforeach; ?>
  </nav>
</div>