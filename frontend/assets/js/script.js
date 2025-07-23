document.addEventListener('DOMContentLoaded', function () {
  const profileArea = document.querySelector('.toptopbar-right');
  if (!profileArea) return;

  // Remove any existing dropdown
  let dropdown = document.getElementById('profileDropdown');
  if (dropdown) dropdown.remove();

  // Create dropdown
  dropdown = document.createElement('div');
  dropdown.id = 'profileDropdown';
  dropdown.className = 'profile-dropdown small-profile-dropdown';
  dropdown.innerHTML = `
    <div class="dropdown-content">
      <a href="profile.php" class="profile-link">Profile</a>
      <a href="settings.php" class="profile-link">Settings</a>
      <a href="logout.php" class="profile-link logout-link">Logout</a>
    </div>
  `;
  dropdown.style.display = 'none';
  profileArea.appendChild(dropdown);

  // Toggle dropdown on click or keyboard
  function toggleDropdown(e) {
    e.stopPropagation();
    const isOpen = dropdown.style.display === 'block';
    dropdown.style.display = isOpen ? 'none' : 'block';
    profileArea.setAttribute('aria-expanded', !isOpen);
    if (!isOpen) {
      profileArea.classList.add('active');
    } else {
      profileArea.classList.remove('active');
    }
  }

  profileArea.addEventListener('click', toggleDropdown);
  profileArea.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' || e.key === ' ') {
      toggleDropdown(e);
    }
  });

  // Hide dropdown when clicking outside
  document.addEventListener('click', function () {
    dropdown.style.display = 'none';
    profileArea.classList.remove('active');
    profileArea.setAttribute('aria-expanded', 'false');
  });

  // Prevent dropdown from closing when clicking inside
  dropdown.addEventListener('click', function (e) {
    e.stopPropagation();
  });
});