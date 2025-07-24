<?php
$page_title = 'Affiliate Club Apps';
$page_subtext = 'Manage and view affiliate club applications.';
$current_page = 'Affiliate Club Apps';

$breadcrumbs = [
    ['title' => 'Home', 'url' => 'index.php'],
    ['title' => 'Affiliate Club Apps', 'url' => 'affiliate_clubs.php']
];

// Dummy club data (replace with DB in production)
$clubs = [
    [
        'name' => "Skyline Golf & Resort",
        'sport' => "golf",
        'location' => "kl",
        'status' => "open",
        'img' => "https://picsum.photos/seed/golf1/600/400"
    ],
    [
        'name' => "Lagoon Aquatic Centre",
        'sport' => "swim",
        'location' => "selangor",
        'status' => "limited",
        'img' => "https://picsum.photos/seed/swim1/600/400"
    ],
    [
        'name' => "Palm Greens Club",
        'sport' => "golf",
        'location' => "johor",
        'status' => "closed",
        'img' => "https://picsum.photos/seed/golf3/600/400"
    ],
    [
        'name' => "Bluewave Tennis Club",
        'sport' => "tennis",
        'location' => "kl",
        'status' => "open",
        'img' => "https://picsum.photos/seed/tennis1/600/400"
    ],
    [
        'name' => "Sunset Golf Links",
        'sport' => "golf",
        'location' => "selangor",
        'status' => "open",
        'img' => "https://picsum.photos/seed/golf2/600/400"
    ],
    [
        'name' => "Oasis Swim & Fitness",
        'sport' => "swim",
        'location' => "johor",
        'status' => "open",
        'img' => "https://picsum.photos/seed/swim2/600/400"
    ],
];

// Filtering logic
$sport = isset($_GET['sport']) ? $_GET['sport'] : 'all';
$location = isset($_GET['location']) ? $_GET['location'] : 'all';
$search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';

$filtered_clubs = array_filter($clubs, function($c) use ($sport, $location, $search) {
    $sportMatch = ($sport === 'all' || $c['sport'] === $sport);
    $locationMatch = ($location === 'all' || $c['location'] === $location);
    $searchMatch = ($search === '' || strpos(strtolower($c['name']), $search) !== false);
    return $sportMatch && $locationMatch && $searchMatch;
});
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
                <div class="filters-row" style="margin-bottom: 20px;">
                    <form class="filters-form" autocomplete="off" method="get" id="clubFilterForm">
                        <div class="filter-group">
                            <label for="sportFilter" class="filter-label">Sport</label>
                            <div class="filter-select-wrapper">
                                <select id="sportFilter" name="sport" class="filter-select">
                                    <option value="all" <?= $sport === 'all' ? 'selected' : '' ?>>All Sports</option>
                                    <option value="golf" <?= $sport === 'golf' ? 'selected' : '' ?>>Golf</option>
                                    <option value="swim" <?= $sport === 'swim' ? 'selected' : '' ?>>Swimming</option>
                                    <option value="tennis" <?= $sport === 'tennis' ? 'selected' : '' ?>>Tennis</option>
                                </select>
                                <span class="filter-caret">
                                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                        <polygon points="5,8 10,13 15,8" fill="#222"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="filter-group">
                            <label for="locationFilter" class="filter-label">Location</label>
                            <div class="filter-select-wrapper">
                                <select id="locationFilter" name="location" class="filter-select">
                                    <option value="all" <?= $location === 'all' ? 'selected' : '' ?>>All Locations</option>
                                    <option value="kl" <?= $location === 'kl' ? 'selected' : '' ?>>Kuala Lumpur</option>
                                    <option value="selangor" <?= $location === 'selangor' ? 'selected' : '' ?>>Selangor</option>
                                    <option value="johor" <?= $location === 'johor' ? 'selected' : '' ?>>Johor</option>
                                </select>
                                <span class="filter-caret">
                                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                        <polygon points="5,8 10,13 15,8" fill="#222"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="filter-group">
                            <label for="searchInput" class="filter-label">Search</label>
                            <input type="search" id="searchInput" name="search" class="filter-search" placeholder="Search clubs…" value="<?= htmlspecialchars($search) ?>">
                        </div>
                        <a href="affiliate_clubs.php" class="filter-submit-btn" style="background:#bbb;color:#222;text-decoration:none;">Reset</a>
                    </form>
                </div>
                <div id="clubGrid" class="affiliate-grid">
                    <?php if (empty($filtered_clubs)): ?>
                        <div style="grid-column:1/-1;text-align:center;color:#888;padding:40px 0;">No clubs found.</div>
                    <?php else: ?>
                        <?php foreach ($filtered_clubs as $c): ?>
                            <div class="affiliate-card">
                                <img src="<?= htmlspecialchars($c['img']) ?>" alt="<?= htmlspecialchars($c['name']) ?>" class="affiliate-card-img">
                                <div class="affiliate-card-body">
                                    <div class="affiliate-card-title"><?= htmlspecialchars($c['name']) ?></div>
                                    <div class="affiliate-card-desc"><?= ucfirst($c['sport']) ?> · <?= strtoupper($c['location']) ?></div>
                                    <span class="affiliate-status <?= $c['status'] ?>">
                                        <?= ucfirst($c['status']) ?>
                                    </span>
                                </div>
                                <div class="affiliate-card-footer">
                                    <small>Affiliate</small>
                                    <button class="btn-book" <?= $c['status'] !== 'open' ? 'disabled' : '' ?>>Book</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="assets/js/script.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('clubFilterForm');
    const selects = form.querySelectorAll('select');
    const search = document.getElementById('searchInput');

    selects.forEach(sel => {
        sel.addEventListener('change', () => form.submit());
    });
    search.addEventListener('input', () => form.submit());
});
</script>
</html>