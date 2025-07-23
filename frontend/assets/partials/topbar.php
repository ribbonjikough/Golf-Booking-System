<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="assets/css/globals.css" />
    <link rel="stylesheet" href="assets/css/styleguide.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  </head>
  <body>
    <!-- Topbar -->
    <div class="top-menu">
      <div class="logo-walkin-search">
                <button class="sidebar-toggle" aria-label="Open sidebar">
          &#9776;
        </button>
        <a href="index.php">        
          <img class="image" src="assets/img/company-logo2.png"/>
        </a>
        <img class="divider" src="data:image/svg+xml;utf8,<svg width='2' height='44' xmlns='http://www.w3.org/2000/svg'><rect width='2' height='44' fill='%23E4E4E4'/></svg>" />
        <div class="walkin">
          <div class="walk-in">
            <?php echo isset($topbar_title) ? htmlspecialchars($topbar_title) : 'Error 404 Page Not Found'; ?>
          </div>
        </div>
      </div>
      <div class="top-right-frame" id="mobileProfileArea">
        <div class="image-wrapper"><img class="img" src="assets/img/pfp.png" /></div>
        <div class="div">
          <div class="text-wrapper">John Doe</div>
          <div class="text-wrapper-2">Global Admin</div>
        </div>
        <img class="polygon" src="data:image/svg+xml;utf8,<svg width='12' height='8' viewBox='0 0 12 8  ' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M1 1L6 7L11 1' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/></svg>" />
      </div>
    </div>
    <nav class="mobile-bottom-nav">
      <a href="index.php" class="nav-icon" data-section="home">
        <img src="assets/img/home_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Home">
        <span>Home</span>
      </a>
      <a href="car_in_park.php" class="nav-icon" data-section="parking">
        <img src="assets/img/directions_car_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Parking">
        <span>Parking</span>
      </a>
      <a href="transactions.php" class="nav-icon" data-section="report">
        <img src="assets/img/monitoring_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Report">
        <span>Report</span>
      </a>
      <a href="season_parking_list.php" class="nav-icon" data-section="season">
        <img src="assets/img/featured_seasonal_and_gifts_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24 (1).svg" alt="Season">
        <span>Season</span>
      </a>
      <a href="settings.php" class="nav-icon" data-section="settings">
        <img src="assets/img/settings_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Settings">
        <span>Settings</span>
      </a>
    </nav>
      <div id="exportOverlay" style="display:none; position:fixed; z-index:4000; left:0; top:0; width:100vw; height:100vh; background:rgba(33,43,54,0.32); align-items:center; justify-content:center;">
    <div id="exportModal" style="background:#fff; border-radius:12px; box-shadow:0 4px 32px rgba(21,114,185,.18); padding:32px 24px 24px 24px; min-width:280px; max-width:95vw;">
      <h3 style="margin-top:0; margin-bottom:18px; font-size:1.2rem;">Export Options</h3>
      <div style="display:flex; flex-direction:column; gap:16px;">
        <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
          <input type="checkbox" id="exportCsv" style="width:18px; height:18px;">
          <img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/filetype-csv.svg" alt="CSV" style="width:24px; height:24px;">
          <span>Export as CSV</span>
        </label>
        <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
          <input type="checkbox" id="exportPdf" style="width:18px; height:18px;">
          <img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/filetype-pdf.svg" alt="PDF" style="width:24px; height:24px;">
          <span>Export as PDF</span>
        </label>
        <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
          <input type="checkbox" id="exportPrint" style="width:18px; height:18px;">
          <img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/printer.svg" alt="Print" style="width:24px; height:24px;">
          <span>Print</span>
        </label>
      </div>
      <div id="exportActions" style="display:none; margin-top:24px; gap:12px; justify-content:flex-end;">
        <button id="exportCancelBtn" class="btn btn-export">Cancel</button>
        <button id="exportConfirmBtn" class="btn btn-search" style="margin-right:8px;">Confirm</button>
      </div>
    </div>
  </div>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script src="assets/js/daterange.js"></script>
</html>

