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

        // Player selection overlay logic
    const playerSelectOverlay = document.getElementById('playerSelectOverlay');
    const playerCountBtns = document.getElementById('playerCountBtns');
    const jumboCheckbox = document.getElementById('jumboCheckbox');
    const playerTimeEstimate = document.getElementById('playerTimeEstimate');
    const playerTimeRange = document.getElementById('playerTimeRange');
    const playerIcons = document.getElementById('playerIcons');
    const playerSelectNextBtn = document.getElementById('playerSelectNextBtn');
    const playerSelectCancelBtn = document.getElementById('playerSelectCancelBtn');

    // Demo: time estimation per player count, but now as a function of start time
    function getTimeEstimate(startTime, playerCount) {
        // Parse start time (e.g. "11:00 am")
        let [time, period] = startTime.split(' ');
        let [hour, minute] = time.split(':').map(Number);
        if (period.toLowerCase() === 'pm' && hour !== 12) hour += 12;
        if (period.toLowerCase() === 'am' && hour === 12) hour = 0;
        let start = new Date(2000, 0, 1, hour, minute);

        // Duration in minutes per player count (customize as needed)
        const durations = {1: 30, 2: 90, 3: 120, 4: 150, 5: 180, 6: 210};
        let duration = durations[playerCount] || 90;

        let end = new Date(start.getTime() + duration * 60000);

        // Format time as "h:mm a.m./p.m."
        function formatTime(date) {
            let h = date.getHours();
            let m = date.getMinutes();
            let ampm = h >= 12 ? 'p.m.' : 'a.m.';
            h = h % 12;
            if (h === 0) h = 12;
            return `${h}:${m.toString().padStart(2, '0')} ${ampm}`;
        }

        return `${formatTime(start)} to ${formatTime(end)}`;
    }

    let selectedPlayerCount = 2;
    let selectedTime = '11:00 am'; // Will be set from card click

    function updatePlayerOverlay() {
        const maxPlayers = jumboCheckbox && jumboCheckbox.checked ? 6 : 4;
        // Update buttons
        if (playerCountBtns) {
            playerCountBtns.innerHTML = '';
            for (let i = 1; i <= maxPlayers; i++) {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'player-count-btn' + (i === selectedPlayerCount ? ' active' : '');
                btn.dataset.count = i;
                btn.textContent = i;
                btn.onclick = function() {
                    selectedPlayerCount = i;
                    updatePlayerOverlay();
                };
                playerCountBtns.appendChild(btn);
            }
        }
        // Update time estimate dynamically
        if (playerTimeRange) {
            playerTimeRange.textContent = getTimeEstimate(selectedTime, selectedPlayerCount);
        }
        // Update icons
        if (playerIcons) {
            playerIcons.innerHTML = '';
            for (let i = 0; i < selectedPlayerCount; i++) {
                const img = document.createElement('img');
                img.src = 'assets/img/person_24dp_1C1C1C_FILL0_wght400_GRAD0_opsz24.svg';
                img.alt = 'Player';
                playerIcons.appendChild(img);
            }
        }
    }

    if (jumboCheckbox) {
        jumboCheckbox.addEventListener('change', function() {
            if (jumboCheckbox.checked) {
                if (selectedPlayerCount < 5) selectedPlayerCount = 6;
            } else {
                if (selectedPlayerCount > 4) selectedPlayerCount = 4;
            }
            updatePlayerOverlay();
        });
    }

    // Show overlay when available card is clicked
    document.querySelectorAll('.golf-booking-time-card:not(.unavailable)').forEach(card => {
        card.addEventListener('click', function() {
            // Get the time from the card
            const timeElem = card.querySelector('.golf-booking-time-value');
            if (timeElem) {
                selectedTime = timeElem.textContent.trim();
            } else {
                selectedTime = '11:00 am';
            }
            selectedPlayerCount = 2;
            if (jumboCheckbox) jumboCheckbox.checked = false;
            updatePlayerOverlay();
            if (playerSelectOverlay) playerSelectOverlay.style.display = 'flex';
        });
    });

    // Cancel button
    if (playerSelectCancelBtn && playerSelectOverlay) {
        playerSelectCancelBtn.onclick = function() {
            playerSelectOverlay.style.display = 'none';
        };
    }

    // Next button (for now, just close overlay)
    if (playerSelectNextBtn && playerSelectOverlay) {
        playerSelectNextBtn.onclick = function() {
            // TODO: Show next overlay or proceed to next step
            playerSelectOverlay.style.display = 'none';
        };
    }

    // --- Player Details Overlay Logic ---
    const playerDetailsOverlay = document.getElementById('playerDetailsOverlay');
    const playerDetailsForm = document.getElementById('playerDetailsForm');
    const playerDetailsInputs = document.getElementById('playerDetailsInputs');
    const playerDetailsCancelBtn = document.getElementById('playerDetailsCancelBtn');

    // --- Payment Overlay Logic ---
    const paymentOverlay = document.getElementById('paymentOverlay');
    const bookingDetails = document.getElementById('bookingDetails');
    const payNowBtn = document.getElementById('payNowBtn');
    const payLaterBtn = document.getElementById('payLaterBtn');

    // Store booking info globally for overlays
    let bookingInfo = {
        course: window.bookingCourse || (typeof course !== 'undefined' ? course : 'EAST COURSE'),
        date: window.bookingDate || (typeof date !== 'undefined' ? date : ''),
        time: '',
        players: 2,
        playerNames: [],
        jumbo: false,
        timeRange: '',
    };

    // Helper: get user name from PHP (set in a JS variable in your page)
    let sessionUserName = window.sessionUserName || 'Player1';

    // Show player details overlay after player select "Next"
    if (typeof playerSelectNextBtn !== 'undefined' && playerSelectNextBtn) {
        playerSelectNextBtn.onclick = function() {
            // Prepare player details form
            if (playerDetailsInputs) {
                playerDetailsInputs.innerHTML = '';
                for (let i = 1; i <= selectedPlayerCount; i++) {
                    let row = document.createElement('div');
                    row.className = 'golf-player-details-row';
                    let icon = document.createElement('img');
                    icon.src = 'assets/img/person_24dp_1C1C1C_FILL0_wght400_GRAD0_opsz24.svg';
                    icon.alt = 'Player';
                    let label = document.createElement('label');
                    label.textContent = `Player ${i}`;
                    label.setAttribute('for', `playerName${i}`);
                    let input = document.createElement('input');
                    input.type = 'text';
                    input.id = `playerName${i}`;
                    input.name = `playerName${i}`;
                    input.placeholder = i === 1 ? sessionUserName : 'Insert name here';
                    input.value = i === 1 ? sessionUserName : '';
                    if (i === 1) input.readOnly = true;
                    row.appendChild(icon);
                    row.appendChild(label);
                    row.appendChild(input);
                    playerDetailsInputs.appendChild(row);
                }
            }
            if (playerSelectOverlay) playerSelectOverlay.style.display = 'none';
            if (playerDetailsOverlay) playerDetailsOverlay.style.display = 'flex';
        };
    }

    // Cancel player details
    if (playerDetailsCancelBtn && playerDetailsOverlay) {
        playerDetailsCancelBtn.onclick = function() {
            playerDetailsOverlay.style.display = 'none';
        };
    }

    // Confirm player details and show payment overlay
    if (playerDetailsForm && playerDetailsOverlay) {
        playerDetailsForm.onsubmit = function(e) {
            e.preventDefault();
            // Collect player names
            let names = [];
            for (let i = 1; i <= selectedPlayerCount; i++) {
                let val = document.getElementById(`playerName${i}`).value.trim();
                names.push(val);
            }
            bookingInfo.playerNames = names;
            bookingInfo.players = selectedPlayerCount;
            bookingInfo.jumbo = jumboCheckbox && jumboCheckbox.checked;
            bookingInfo.time = selectedTime;
            bookingInfo.timeRange = getTimeEstimate(selectedTime, selectedPlayerCount);
            // Show payment overlay
            playerDetailsOverlay.style.display = 'none';
            showPaymentOverlay();
        };
    }

    // Payment overlay logic
    function showPaymentOverlay() {
        if (!bookingDetails) return;
        // Demo calculation
        let pricePerPax = 737.03;
        let gross = pricePerPax * bookingInfo.players;
        let tax = Math.round(gross * 0.08 * 100) / 100;
        let discount = Math.round(gross * 0.15 * 100) / 100;
        let total = Math.round((gross + tax - discount) * 100) / 100;
        // Demo booking ID
        let bookingId = '1234-ABCDGF';
        // Format date
        let teeDate = (window.bookingDate || (typeof date !== 'undefined' ? date : '')).toUpperCase();
        // Compose HTML
        bookingDetails.innerHTML = `
            <table class="golf-payment-details-table">
                <tr><td>Booking ID:</td><td class="right">${bookingId}</td></tr>
                <tr><td>Course:</td><td class="right">${bookingInfo.course}</td></tr>
                <tr><td>Tee Date</td><td class="right">${teeDate}</td></tr>
                <tr><td>Tee Time</td><td class="right">${bookingInfo.timeRange}</td></tr>
                <tr><td>Tee Box:</td><td class="right">1</td></tr>
                <tr><td>No of Players</td><td class="right">${bookingInfo.players}</td></tr>
                <tr><td>Included</td>
                    <td class="right">Green Fee<br>Insurance<br>Shared Buggy</td>
                </tr>
                <tr><td>Price per Pax (RM):</td><td class="right">${pricePerPax.toFixed(2)}</td></tr>
                <tr><td>Gross Amount (RM):</td><td class="right">${gross.toLocaleString(undefined, {minimumFractionDigits:2})}</td></tr>
                <tr><td>Government Tax (RM):</td><td class="right">${tax.toLocaleString(undefined, {minimumFractionDigits:2})}</td></tr>
                <tr><td class="discount">Discount 15%:</td><td class="right discount">- ${discount.toLocaleString(undefined, {minimumFractionDigits:2})}</td></tr>
                <tr><td class="bold">Total Amount (RM):</td><td class="right bold">${total.toLocaleString(undefined, {minimumFractionDigits:2})}</td></tr>
            </table>
            <div class="golf-payment-amount">Pay Amount: RM${total.toLocaleString(undefined, {minimumFractionDigits:2})}</div>
            <div class="golf-payment-terms">
                Terms & Conditions<br>
                <a href="#">Cancellation and Refund Policy</a><br>
                <span style="font-size:1rem;">Please agree on our <b>T&amp;C</b> before paying and making reservation</span>
            </div>
        `;
        if (paymentOverlay) paymentOverlay.style.display = 'flex';
    }

    // Pay Now / Pay Later logic
    function closeAllOverlays() {
        if (paymentOverlay) paymentOverlay.style.display = 'none';
        if (playerDetailsOverlay) playerDetailsOverlay.style.display = 'none';
        if (playerSelectOverlay) playerSelectOverlay.style.display = 'none';
    }
    if (payNowBtn) payNowBtn.onclick = closeAllOverlays;
    if (payLaterBtn) payLaterBtn.onclick = closeAllOverlays;

    // Optional: close overlays on outside click
    window.addEventListener('click', function(e) {
        if (playerDetailsOverlay && e.target === playerDetailsOverlay) playerDetailsOverlay.style.display = 'none';
        if (paymentOverlay && e.target === paymentOverlay) paymentOverlay.style.display = 'none';
    });
});