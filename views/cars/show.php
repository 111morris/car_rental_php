<?php include __DIR__ . '/../layouts/header.php'; ?>
<style>
    .grayscale { filter: grayscale(100%); opacity: 0.8; }
</style>

<div class="row">
    <div class="col-md-6 position-relative">
        <img src="<?= htmlspecialchars($car['pic']) ?>" class="img-fluid rounded <?= $car['stock'] <= 0 ? 'grayscale' : '' ?>" alt="<?= htmlspecialchars($car['name']) ?>">
        <?php if ($car['stock'] <= 0): ?>
            <div style="position: absolute; top: 20px; right: 20px; background: #dc3545; color: white; padding: 10px 20px; font-weight: bold; transform: rotate(10deg); font-size: 1.5rem; box-shadow: 3px 3px 10px rgba(0,0,0,0.5);">
                SOLD OUT
            </div>
        <?php endif; ?>
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
