<?php
  // Use $topbar_title or $_GET['section'] for AJAX/mobile
  if (isset($_GET['section'])) {
      $sidebar_type = strtolower(trim($_GET['section']));
  } else {
      $sidebar_type = isset($topbar_title) ? strtolower(trim($topbar_title)) : 'dashboard';
  }
  $current_file = isset($_GET['current']) ? $_GET['current'] : basename($_SERVER['SCRIPT_NAME']);

  // Example breadcrumbs array, replace with your own logic as needed
  $breadcrumbs = isset($breadcrumbs) ? $breadcrumbs : [
    ['title' => 'Home', 'url' => 'index.php'],
    ['title' => isset($page_title) ? $page_title : ucfirst($sidebar_type), 'url' => $current_file]
  ];

  // Example user info, replace with session/user data as needed
  $user_name = isset($user_name) ? $user_name : 'John Doe';
  $user_role = isset($user_role) ? $user_role : 'Member';
  $membership_level = isset($membership_level) ? $membership_level : 'Gold';
  $profile_img = isset($profile_img) ? $profile_img : 'assets/img/pfp.png';
?>
<div class="toptopbar">
  <div class="toptopbar-left">
    <a href link="index.php">
    <img src="assets/img/company-logo.png" alt="Company Logo" class="toptopbar-logo">
    </a>
    <div class="toptopbar-meta">
      <div class="toptopbar-title"><?= isset($page_title) ? htmlspecialchars($page_title) : 'Page Title' ?></div>
      <nav class="toptopbar-breadcrumbs">
        <?php foreach ($breadcrumbs as $i => $crumb): ?>
          <?php if ($i > 0): ?>
            <span class="breadcrumb-sep">/</span>
          <?php endif; ?>
          <?php if (!empty($crumb['url']) && $i < count($breadcrumbs) - 1): ?>
            <a href="<?= htmlspecialchars($crumb['url']) ?>" class="breadcrumb-link"><?= htmlspecialchars($crumb['title']) ?></a>
          <?php else: ?>
            <span class="breadcrumb-current"><?= htmlspecialchars($crumb['title']) ?></span>
          <?php endif; ?>
        <?php endforeach; ?>
      </nav>
    </div>
  </div>
  <div class="toptopbar-right" tabindex="0">
    <img src="<?= htmlspecialchars($profile_img) ?>" alt="Profile" class="toptopbar-profile-img">
    <div class="toptopbar-profile-meta">
      <div class="toptopbar-profile-name"><?= htmlspecialchars($user_name) ?></div>
      <div class="toptopbar-profile-role">
        <?= htmlspecialchars($user_role) ?>
        <?php if (strtolower($user_role) === 'member'): ?>
          <span class="toptopbar-membership">(<?= htmlspecialchars($membership_level) ?>)</span>
        <?php endif; ?>
      </div>
    </div>
    <span class="toptopbar-profile-caret">
      <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
        <polygon points="5,8 10,13 15,8" fill="#fff"/>
      </svg>
    </span>
  </div>
</div>
