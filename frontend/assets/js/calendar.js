document.addEventListener('DOMContentLoaded', function() {
    // Simulate booked days for demo (replace with your real data)
    const bookedDays = {
        '2025-07-25': {
            tee: 3,
            time: '11:00 a.m. - 12:30 p.m.',
            players: 4,
            course: 'East Course',
            duration: '1.5 hours',
            bookingId: 'BK-1001'
        },
        '2025-07-30': {
            tee: 1,
            time: '09:00 a.m. - 10:30 a.m.',
            players: 3,
            course: 'West Course',
            duration: '1.5 hours',
            bookingId: 'BK-1002'
        },
        '2025-08-03': {
            tee: 2,
            time: '14:00 p.m. - 15:30 p.m.',
            players: 2,
            course: 'East Course',
            duration: '1.5 hours',
            bookingId: 'BK-1003'
        },
        '2025-08-15': {
            tee: 4,
            time: '16:00 p.m. - 17:30 p.m.',
            players: 4,
            course: 'West Course',
            duration: '1.5 hours',
            bookingId: 'BK-1004'
        }
    };

    const today = new Date();
    let currentMonth = 6; // July (0-based)
    let currentYear = 2025;
    let calendarMode = 'day'; // 'day', 'month', 'year'

    function pad(n) { return n < 10 ? '0' + n : n; }

    function renderCalendar(month, year) {
        const calendarGrid = document.getElementById('calendarGrid');
        const monthYear = document.getElementById('calendarMonthYear');
        calendarGrid.innerHTML = '';

        // Day labels
        const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        for (let d = 0; d < 7; d++) {
            const label = document.createElement('div');
            label.className = 'calendar-day-label';
            label.textContent = days[d];
            calendarGrid.appendChild(label);
        }

        // First day of month
        const firstDay = new Date(year, month, 1);
        const startDay = firstDay.getDay();

        // Last day of month
        const lastDate = new Date(year, month + 1, 0).getDate();

        // Previous month's last days for leading blanks
        const prevMonth = month === 0 ? 11 : month - 1;
        const prevYear = month === 0 ? year - 1 : year;
        const prevLastDate = new Date(prevYear, prevMonth + 1, 0).getDate();

        // Next month's first days for trailing blanks
        let dayNum = 1;
        let nextDayNum = 1;
        let isCurrentMonth = (today.getFullYear() === year && today.getMonth() === month);

        for (let i = 0; i < 42; i++) {
            let box = document.createElement('button');
            box.type = 'button';
            box.className = 'calendar-box';
            let dateStr = '';
            let boxText = '';

            if (i < startDay) {
                // Previous month
                let prevDay = prevLastDate - (startDay - i - 1);
                boxText = prevDay;
                box.classList.add('other-month');
                dateStr = `${prevYear}-${pad(prevMonth+1)}-${pad(prevDay)}`;
            } else if (dayNum > lastDate) {
                // Next month
                boxText = nextDayNum++;
                box.classList.add('other-month');
                dateStr = `${month === 11 ? year+1 : year}-${pad(month === 11 ? 1 : month+2)}-${pad(boxText)}`;
            } else {
                // Current month
                boxText = dayNum;
                dateStr = `${year}-${pad(month+1)}-${pad(dayNum)}`;
                if (isCurrentMonth && dayNum === today.getDate()) {
                    box.classList.add('today');
                } else if (bookedDays[dateStr]) {
                    box.classList.add('booked');
                } else if (
                    (year < today.getFullYear()) ||
                    (year === today.getFullYear() && month < today.getMonth()) ||
                    (year === today.getFullYear() && month === today.getMonth() && dayNum < today.getDate())
                ) {
                    box.classList.add('past');
                } else {
                    box.classList.add('normal');
                }
                dayNum++;
            }
            box.textContent = boxText;
            box.dataset.date = dateStr;
            box.onclick = function(e) {
                showDayOverlay(dateStr, box);
            };
            calendarGrid.appendChild(box);
        }

        // Month name
        const monthNames = [
            'January','February','March','April','May','June',
            'July','August','September','October','November','December'
        ];
        monthYear.innerHTML = `<span id="calendarMonthName" style="cursor:pointer">${monthNames[month]}</span> <span id="calendarYearName" style="cursor:pointer">${year}</span>`;
        // Add event listeners for month/year selection
        document.getElementById('calendarMonthName').onclick = function() {
            renderMonthPicker(year);
        };
        document.getElementById('calendarYearName').onclick = function() {
            renderYearPicker();
        };
    }

    function renderMonthPicker(year) {
        calendarMode = 'month';
        const calendarGrid = document.getElementById('calendarGrid');
        const monthYear = document.getElementById('calendarMonthYear');
        calendarGrid.innerHTML = '';
        monthYear.innerHTML = `<span id="calendarYearName" style="cursor:pointer">${year}</span>`;
        document.getElementById('calendarYearName').onclick = function() {
            renderYearPicker();
        };
        const monthNames = [
            'January','February','March','April','May','June',
            'July','August','September','October','November','December'
        ];
        for (let m = 0; m < 12; m++) {
            let btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'calendar-box';
            btn.style.margin = '10px auto';
            btn.textContent = monthNames[m].substr(0,3);
            if (m === currentMonth && year === currentYear) btn.classList.add('today');
            btn.onclick = function() {
                currentMonth = m;
                currentYear = year;
                calendarMode = 'day';
                renderCalendar(currentMonth, currentYear);
            };
            calendarGrid.appendChild(btn);
        }
    }

    function renderYearPicker() {
        calendarMode = 'year';
        const calendarGrid = document.getElementById('calendarGrid');
        const monthYear = document.getElementById('calendarMonthYear');
        calendarGrid.innerHTML = '';
        // Show 12 years centered around currentYear
        let startYear = currentYear - 5;
        monthYear.innerHTML = `<span>${startYear} - ${startYear+11}</span>`;
        for (let y = startYear; y < startYear + 12; y++) {
            let btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'calendar-box';
            btn.style.margin = '10px auto';
            btn.textContent = y;
            if (y === currentYear) btn.classList.add('today');
            btn.onclick = function() {
                currentYear = y;
                calendarMode = 'month';
                renderMonthPicker(currentYear);
            };
            calendarGrid.appendChild(btn);
        }
    }

    // Add "Today" button for quick navigation
    function addTodayButton() {
        let header = document.querySelector('.calendar-header');
        if (!document.getElementById('goTodayBtn')) {
            let btn = document.createElement('button');
            btn.id = 'goTodayBtn';
            btn.textContent = 'Today';
            btn.style.background = '#3fa7f7';
            btn.style.color = '#fff';
            btn.style.marginLeft = '10px';
            btn.style.border = 'none';
            btn.style.borderRadius = '6px';
            btn.style.padding = '4px 14px';
            btn.style.cursor = 'pointer';
            btn.onclick = function() {
                currentMonth = today.getMonth();
                currentYear = today.getFullYear();
                calendarMode = 'day';
                renderCalendar(currentMonth, currentYear);
            };
            header.appendChild(btn);
        }
    }

    function showDayOverlay(dateStr, box) {
        let overlay = document.getElementById('calendarDayOverlay');
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.id = 'calendarDayOverlay';
            document.body.appendChild(overlay);
        }
        overlay.innerHTML = `<div class="calendar-day-overlay-content"></div>`;
        let content = overlay.querySelector('.calendar-day-overlay-content');

        // Remove all inline styles, use only CSS classes
        // Add close button
        let closeBtn = document.createElement('button');
        closeBtn.textContent = '×';
        closeBtn.className = 'calendar-day-overlay-close';
        closeBtn.onclick = function(e) {
            e.stopPropagation();
            overlay.style.display = 'none';
        };

        content.innerHTML = '';
        content.appendChild(closeBtn);

        let dateObj = new Date(dateStr);
        let dateTitle = dateObj.toLocaleDateString(undefined, { year: 'numeric', month: 'long', day: 'numeric', weekday: 'long' });
        let booked = bookedDays[dateStr];

        let html = `<h2 class="calendar-day-overlay-title">${dateTitle}</h2>`;
        if (booked) {
            html += `
            <div class="calendar-day-booking-details">
                <div class="calendar-day-booking-header">Booking Details</div>
                <table class="calendar-day-booking-table">
                    <tr><td>Booking ID:</td><td><b>${booked.bookingId}</b></td></tr>
                    <tr><td>Course:</td><td>${booked.course}</td></tr>
                    <tr><td>Tee Number:</td><td>${booked.tee}</td></tr>
                    <tr><td>Time:</td><td>${booked.time}</td></tr>
                    <tr><td>Duration:</td><td>${booked.duration}</td></tr>
                    <tr><td>Players:</td><td>${booked.players}</td></tr>
                </table>
            </div>`;
        } else {
            html += `<div class="calendar-day-no-booking">No bookings or events for this day.</div>`;
        }
        content.innerHTML += html;
        overlay.style.display = 'flex';

        // Close overlay when clicking outside the content
        overlay.onclick = function(e) {
            if (e.target === overlay) {
                overlay.style.display = 'none';
            }
        };
    }

    document.getElementById('prevMonthBtn').onclick = function() {
        if (calendarMode !== 'day') return;
        if (currentMonth === 0) {
            currentMonth = 11;
            currentYear--;
        } else {
            currentMonth--;
        }
        renderCalendar(currentMonth, currentYear);
    };
    document.getElementById('nextMonthBtn').onclick = function() {
        if (calendarMode !== 'day') return;
        if (currentMonth === 11) {
            currentMonth = 0;
            currentYear++;
        } else {
            currentMonth++;
        }
        renderCalendar(currentMonth, currentYear);
    };

    addTodayButton();
    renderCalendar(currentMonth, currentYear);
});