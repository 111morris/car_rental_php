<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Rent <?= htmlspecialchars($car['name']) ?></div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                
                <form action="/rent" method="POST">
                    <input type="hidden" name="car_id" value="<?= $car['_id'] ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Rental Mode</label>
                        <select class="form-select" name="mode" id="mode" onchange="updateLabel()">
                            <option value="day">By Day ($<?= $car['rate_by_day'] ?>)</option>
                            <option value="hour">By Hour ($<?= $car['rate_by_hour'] ?>)</option>
                            <option value="km">By KM ($<?= $car['rate_by_km'] ?>)</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" id="value-label">Number of Days</label>
                        <input type="number" class="form-control" name="value" min="1" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Confirm Booking</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function updateLabel() {
    const mode = document.getElementById('mode').value;
    const label = document.getElementById('value-label');
    if (mode === 'day') label.textContent = 'Number of Days';
    else if (mode === 'hour') label.textContent = 'Number of Hours';
    else if (mode === 'km') label.textContent = 'Estimated KM';
}
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
