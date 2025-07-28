document.addEventListener('DOMContentLoaded', function() {
    var right = document.getElementById('toptopbarRight');
    var dropdown = document.getElementById('profileDropdown');
    if (right && dropdown) {
      right.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdown.classList.toggle('show');
      });
      document.addEventListener('click', function() {
        dropdown.classList.remove('show');
      });
      dropdown.addEventListener('click', function(e) {
        e.stopPropagation();
      });
    }
  });

// Enable Send OTP when email is filled
document.getElementById('email').addEventListener('input', function() {
  document.getElementById('sendOtpBtn').disabled = !this.value.trim();
});

// Enable Verify when OTP is filled
document.getElementById('otp').addEventListener('input', function() {
  const btn = document.getElementById('verifyBtn');
  if (this.value.trim()) {
    btn.disabled = false;
    btn.classList.add('active');
  } else {
    btn.disabled = true;
    btn.classList.remove('active');
  }
});

document.addEventListener('DOMContentLoaded', function () {
  // Phase state
  let phase = 1;

  function showPhase(n) {
    for (let i = 1; i <= 3; i++) {
      const section = document.getElementById('phase' + i);
      if (section) section.style.display = (i === n) ? '' : 'none';
    }
    phase = n;
  }

  // Initial phase
  showPhase(1);

  // Enable Verify button when OTP is entered
  var otpInput = document.getElementById('otp');
  var verifyBtn = document.getElementById('verifyBtn');
  if (otpInput && verifyBtn) {
    otpInput.addEventListener('input', function() {
      if (this.value.trim()) {
        verifyBtn.disabled = false;
        verifyBtn.classList.add('active');
      } else {
        verifyBtn.disabled = true;
        verifyBtn.classList.remove('active');
      }
    });
    verifyBtn.addEventListener('click', function() {
      showPhase(2); // Move to phase 2
    });
  }

  // Phase 2: On successful registration, go to phase 3
  var signUpBtn = document.getElementById('signUpBtn');
  if (signUpBtn) {
    signUpBtn.addEventListener('click', function(e) {
      showPhase(3); // Move to phase 3
    });
  }
});

document.addEventListener('DOMContentLoaded', function () {
  // Card Payment Opacity Logic
  const feeElem = document.querySelector('.card-balance-fee');
  const cardPayment = document.querySelector('.card-payment');
  if (feeElem && cardPayment) {
    // Extract numeric value from text like "RM0.00"
    const feeValue = parseFloat(feeElem.textContent.replace(/[^\d.]/g, ''));
    if (feeValue === 0) {
      cardPayment.style.opacity = '0.5';
      cardPayment.style.pointerEvents = 'none';
    } else {
      cardPayment.style.opacity = '1';
      cardPayment.style.pointerEvents = '';
    }
  }
});

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('clubFilterForm');
        const selects = form.querySelectorAll('select');
        const search = document.getElementById('searchInput');

        selects.forEach(sel => {
            sel.addEventListener('change', () => form.submit());
        });
        search.addEventListener('input', () => {
            // Debounce search input
            clearTimeout(window.searchTimeout);
            window.searchTimeout = setTimeout(() => {
                form.submit();
            }, 300);
        });
    });
