<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="row">
    <div class="col-md-6">
        <img src="<?= htmlspecialchars($car['pic']) ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($car['name']) ?>">
    </div>
    <div class="col-md-6">
        <h2><?= htmlspecialchars($car['name']) ?></h2>
        <p class="lead"><?= htmlspecialchars($car['info']) ?></p>
        
        <div class="card bg-light mb-3">
            <div class="card-body">
                <h5 class="card-title">Rates</h5>
                <div class="row text-center">
                    <div class="col">
                        <h3>$<?= $car['rate_by_hour'] ?></h3>
                        <small>Per Hour</small>
                    </div>
                    <div class="col">
                        <h3>$<?= $car['rate_by_day'] ?></h3>
                        <small>Per Day</small>
                    </div>
                    <div class="col">
                        <h3>$<?= $car['rate_by_km'] ?></h3>
                        <small>Per KM</small>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if ($car['stock'] > 0): ?>
            <a href="/rent?car_id=<?= $car['_id'] ?>" class="btn btn-success btn-lg w-100">Book This Car</a>
        <?php else: ?>
            <button class="btn btn-secondary btn-lg w-100" disabled>Out of Stock</button>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
