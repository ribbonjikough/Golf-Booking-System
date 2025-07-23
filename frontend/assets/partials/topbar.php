<?php
// Set $current_page to the page name (e.g., 'Home', 'Facility Booking', etc.)
// You can set this variable in each page before including the topbar
if (!isset($current_page)) {
    $current_page = 'Home';
}
$pages = [
    'Home' => 'index.php',
    'Facility Booking' => 'facility.php',
    'Statement Billing' => 'statement.php',
    'Affiliate Club Apps' => 'affiliate.php'
];
?>

<div class="main-topbar">
  <nav class="main-topbar-nav">
    <?php foreach ($pages as $name => $url): 
      $is_active = ($current_page === $name);
    ?>
      <a 
        href="<?= htmlspecialchars($url) ?>" 
        class="main-topbar-link<?= $is_active ? ' active' : '' ?>"
        aria-current="<?= $is_active ? 'page' : 'false' ?>"
      >
        <span class="main-topbar-link-bar"></span>
        <span class="main-topbar-link-text"><?= htmlspecialchars($name) ?></span>
      </a>
    <?php endforeach; ?>
  </nav>
</div>