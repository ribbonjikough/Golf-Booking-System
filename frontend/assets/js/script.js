document.addEventListener('DOMContentLoaded', function() {
    // Topbar profile dropdown logic
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

    // Enable Send OTP when email is filled
    var emailInput = document.getElementById('email');
    var sendOtpBtn = document.getElementById('sendOtpBtn');
    if (emailInput && sendOtpBtn) {
        emailInput.addEventListener('input', function() {
            sendOtpBtn.disabled = !this.value.trim();
        });
    }

    // Enable Verify when OTP is filled
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
            var phase2 = document.getElementById('phase2');
            var phase1 = document.getElementById('phase1');
            if (phase1 && phase2) {
                phase1.style.display = 'none';
                phase2.style.display = '';
            }
        });
    }

    // Multi-phase registration logic
    var signUpBtn = document.getElementById('signUpBtn');
    if (signUpBtn) {
        signUpBtn.addEventListener('click', function(e) {
            var phase2 = document.getElementById('phase2');
            var phase3 = document.getElementById('phase3');
            if (phase2 && phase3) {
                phase2.style.display = 'none';
                phase3.style.display = '';
            }
        });
    }

    // Card Payment Opacity Logic
    const feeElem = document.querySelector('.card-balance-fee');
    const cardPayment = document.querySelector('.card-payment');
    if (feeElem && cardPayment) {
        const feeValue = parseFloat(feeElem.textContent.replace(/[^\d.]/g, ''));
        if (feeValue === 0) {
            cardPayment.style.opacity = '0.5';
            cardPayment.style.pointerEvents = 'none';
        } else {
            cardPayment.style.opacity = '1';
            cardPayment.style.pointerEvents = '';
        }
    }

    // Club filter auto-submit logic
    const form = document.getElementById('clubFilterForm');
    if (form) {
        const selects = form.querySelectorAll('select');
        const search = document.getElementById('searchInput');
        selects.forEach(sel => {
            sel.addEventListener('change', () => form.submit());
        });
        if (search) {
            search.addEventListener('input', () => {
                clearTimeout(window.searchTimeout);
                window.searchTimeout = setTimeout(() => {
                    form.submit();
                }, 300);
            });
        }
    }

    // Overlay logic for both golf_booking.php and golf_booking_selection.php
    const bookingOverlay = document.getElementById('bookingOverlay');
    const closeOverlayBtn = document.getElementById('closeOverlayBtn');
    const bookingOverlayForm = document.getElementById('bookingOverlayForm');
    const chooseCourseBtn = document.getElementById('chooseCourseBtn');
    const bookingNowBtn = document.getElementById('bookingNowBtn');
    const goBackBtn = document.getElementById('goBackBtn');

    // Show overlay for "Booking Now" or "Choose Different Course & Date"
    if (bookingNowBtn && bookingOverlay) {
        bookingNowBtn.onclick = function() {
            bookingOverlay.style.display = 'flex';
        };
    }
    if (chooseCourseBtn && bookingOverlay) {
        chooseCourseBtn.onclick = function() {
            bookingOverlay.style.display = 'flex';
        };
    }
    // Close overlay
    if (closeOverlayBtn && bookingOverlay) {
        closeOverlayBtn.onclick = function() {
            bookingOverlay.style.display = 'none';
        };
    }
    window.addEventListener('click', function(e) {
        if (bookingOverlay && e.target === bookingOverlay) bookingOverlay.style.display = 'none';
    });
    // Overlay form submit
    if (bookingOverlayForm) {
        bookingOverlayForm.onsubmit = function(e) {
            e.preventDefault();
            const course = document.getElementById('courseSelect').value;
            const date = document.getElementById('dateSelect').value;
            if (course && date) {
                window.location.href = `golf_booking_selection.php?course=${encodeURIComponent(course)}&date=${encodeURIComponent(date)}`;
            }
        };
    }
    // Go Back button
    if (goBackBtn) {
        goBackBtn.onclick = function() {
            window.history.back();
        };
    }
});
