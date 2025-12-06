<?php include __DIR__ . '/../layouts/header.php'; ?>

<!-- FullCalendar CSS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Rent <?= htmlspecialchars($car['name']) ?></div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                
                <div id='calendar' class="mb-4"></div>

                <form action="/rent" method="POST" id="bookingForm">
                    <input type="hidden" name="car_id" value="<?= $car['_id'] ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Rental Mode</label>
                        <select class="form-select" name="mode" id="mode" onchange="updateCalculator()">
                            <option value="day" data-rate="<?= $car['rate_by_day'] ?>">By Day ($<?= $car['rate_by_day'] ?>)</option>
                            <option value="hour" data-rate="<?= $car['rate_by_hour'] ?>">By Hour ($<?= $car['rate_by_hour'] ?>)</option>
                            <option value="km" data-rate="<?= $car['rate_by_km'] ?>">By KM ($<?= $car['rate_by_km'] ?>)</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" id="start-date-label">Start Date & Time</label>
                        <input type="datetime-local" class="form-control" name="start_date" id="start_date" required onchange="updateCalculator()">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" id="value-label">Number of Days</label>
                        <input type="number" class="form-control" name="value" id="value" min="1" value="1" required oninput="updateCalculator()">
                    </div>

                    <div class="alert alert-info">
                        <h4>Total Price: $<span id="total-price">0</span></h4>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" id="submitBtn">Confirm Booking</button>
                    <div id="availability-status" class="mt-2"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek'
        },
        events: '/api/bookings/range?car_id=<?= $car['_id'] ?>',
        validRange: {
            start: new Date().toISOString().split('T')[0]
        }
    });
    calendar.render();
    
    // Set min date for input to now
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById('start_date').min = now.toISOString().slice(0, 16);
    
    updateCalculator();
});

function updateCalculator() {
    // 1. Get elements
    const modeSelect = document.getElementById('mode');
    const valueInput = document.getElementById('value');
    const label = document.getElementById('value-label');
    const totalPriceSpan = document.getElementById('total-price');

    // 2. Get current values
    const selectedOption = modeSelect.options[modeSelect.selectedIndex];
    const rate = parseFloat(selectedOption.getAttribute('data-rate'));
    const mode = modeSelect.value;
    const value = parseFloat(valueInput.value) || 0;

    // 3. Update Label
    if (mode === 'day') {
        label.textContent = 'Number of Days';
    } else if (mode === 'hour') {
        label.textContent = 'Number of Hours';
    } else if (mode === 'km') {
        label.textContent = 'Estimated KM';
    }

    // 4. Calculate Total
    const total = rate * value;

    // 5. Update Display
    totalPriceSpan.textContent = total.toFixed(2);
}
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
