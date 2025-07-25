<?php
$page_title = 'Statement Billing';
$page_subtext = 'View and manage your billing statements.';
$current_page = 'Statement Billing'; 

// Breadcrumbs for toptopbar
$breadcrumbs = [
    ['title' => 'Home', 'url' => 'index.php'],
    ['title' => 'Statement Billing', 'url' => 'statement_billing.php']
];

// Get filter values (simulate for demo)
$type = isset($_GET['type']) ? $_GET['type'] : 'all';
$month = isset($_GET['month']) ? $_GET['month'] : 'may';
$year = isset($_GET['year']) ? $_GET['year'] : '2025';

// Simulated billing data (replace with DB query in real app)
$billing = [
    [
        'ref' => '754234GFHG',
        'desc' => 'MAY PLATINUM SUBSCRIPTION',
        'date' => '31 May 2025',
        'amount' => '756.10',
        'paid' => '-200.00'
    ],
    [
        'ref' => 'ABCE12345FGR',
        'desc' => 'GOLF BOOKING JUMBO',
        'date' => '26 May 2025',
        'amount' => '3450.17',
        'paid' => '-2109.73'
    ]
];

// Set timezone to Kuala Lumpur (UTC+8)
date_default_timezone_set('Asia/Kuala_Lumpur');
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
                <div class="card-row">
                    <div class="card card-balance">
                        <div class="card-header">Current Fee Balance</div>
                        <div class="card-body card-balance-fee">RM531.57</div>
                        <div class="card-footer">Balances as <?= date('d M Y h.iA') ?></div>
                    </div>
                    <div class="card card-balance">
                        <div class="card-header">Current Loan Balance</div>
                        <div class="card-body card-balance-loan">RM0.00</div>
                        <div class="card-footer">Balances as <?= date('d M Y h.iA') ?></div>
                    </div>
                    <div class="card card-payment" onclick="window.location.href='javascript:void()'" style="cursor:pointer;">
                        <div class="card-payment-icon">
                            <img src="assets/img/credit_card_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg" alt="Credit Card" width="38" height="38">
                        </div>
                        <div class="card-payment-text">Make a Payment</div>
                    </div>
                </div>
                <div class="filters-row">
                    <form class="filters-form" method="get" action="">
                        <div class="filter-group">
                            <label for="filter-type" class="filter-label">Type of Statement</label>
                            <div class="filter-select-wrapper">
                                <select id="filter-type" name="type" class="filter-select">
                                    <option value="all">All</option>
                                    <option value="membership">Membership Subs</option>
                                    <option value="facility">Facility Booking</option>
                                    <option value="others">Others</option>
                                </select>
                                <span class="filter-caret">
                                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                        <polygon points="5,8 10,13 15,8" fill="#222"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="filter-group">
                            <label for="filter-month" class="filter-label">Month</label>
                            <div class="filter-select-wrapper">
                                <select id="filter-month" name="month" class="filter-select">
                                    <option value="all">All</option>
                                    <option value="january">January</option>
                                    <option value="february">February</option>
                                    <option value="march">March</option>
                                    <option value="april">April</option>
                                    <option value="may">May</option>
                                    <option value="june">June</option>
                                    <option value="july">July</option>
                                    <option value="august">August</option>
                                    <option value="september">September</option>
                                    <option value="october">October</option>
                                    <option value="november">November</option>
                                    <option value="december">December</option>
                                </select>
                                <span class="filter-caret">
                                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                        <polygon points="5,8 10,13 15,8" fill="#222"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="filter-group">
                            <label for="filter-year" class="filter-label">Year</label>
                            <div class="filter-select-wrapper">
                                <select id="filter-year" name="year" class="filter-select">
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025" selected>2025</option>
                                </select>
                                <span class="filter-caret">
                                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                        <polygon points="5,8 10,13 15,8" fill="#222"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="filter-submit-btn">Submit</button>
                    </form>
                </div>

                <?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['type'])): ?>
                <div class="billing-container">
                    <div class="billing-header-row">
                        <div>
                            Statement Type: <span class="billing-header-pill"><?= ucfirst($type) ?></span>
                            Date View: <span class="billing-header-pill"><?= ucfirst($month) ?> <?= htmlspecialchars($year) ?></span>
                        </div>
                        <div>
                            <button class="billing-header-btn">View in PDF</button>
                            <button class="billing-header-btn billing-header-btn-grey">Download</button>
                        </div>
                    </div>
                    <div class="billing-list">
                        <?php foreach ($billing as $item): ?>
                            <div class="billing-card">
                                <div class="billing-card-row">
                                    <div>
                                        <div class="billing-ref"><b>Ref: <?= htmlspecialchars($item['ref']) ?></b></div>
                                        <div class="billing-desc"><?= htmlspecialchars($item['desc']) ?></div>
                                    </div>
                                    <div class="billing-amounts">
                                        <div class="billing-amount"><?= htmlspecialchars($item['amount']) ?></div>
                                        <div class="billing-date"><?= htmlspecialchars($item['date']) ?></div>
                                        <div class="billing-paid"><?= htmlspecialchars($item['paid']) ?></div>
                                    </div>
                                </div>
                                <button class="billing-details-btn">Details</button>
                            </div>
                            <div class="billing-divider"></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
<script src="assets/js/script.js"></script>
</html>