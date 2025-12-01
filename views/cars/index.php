<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2 class="mb-4">Our Fleet</h2>
<div class="row">
    <?php foreach ($cars as $car): ?>
        <div class="col-md-4 mb-4">
            <div class="card car-card h-100">
                <img src="<?= htmlspecialchars($car['pic']) ?>" class="card-img-top" alt="<?= htmlspecialchars($car['name']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($car['name']) ?></h5>
                    <p class="text-muted">Stock: <?= $car['stock'] ?></p>
                    <ul class="list-unstyled">
                        <li><strong>Hourly:</strong> $<?= $car['rate_by_hour'] ?></li>
                        <li><strong>Daily:</strong> $<?= $car['rate_by_day'] ?></li>
                        <li><strong>Per KM:</strong> $<?= $car['rate_by_km'] ?></li>
                    </ul>
                    <a href="/cars/show?id=<?= $car['_id'] ?>" class="btn btn-primary w-100">Rent Now</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
