<?php include __DIR__ . '/../layouts/header.php'; ?>

<style>
    .car-card { transition: all 0.3s ease; }
    .out-of-stock .card-img-top { filter: grayscale(100%); opacity: 0.7; }
    .out-of-stock-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #dc3545;
        color: white;
        padding: 5px 10px;
        font-weight: bold;
        transform: rotate(5deg);
        z-index: 10;
        box-shadow: 2px 2px 5px rgba(0,0,0,0.3);
    }
</style>

<h2 class="mb-4">Our Fleet</h2>
<div class="row">
    <?php foreach ($cars as $car): ?>
        <?php $isOutOfStock = $car['stock'] <= 0; ?>
        <div class="col-md-4 mb-4">
            <div class="card car-card h-100 <?= $isOutOfStock ? 'out-of-stock' : '' ?>">
                <?php if ($isOutOfStock): ?>
                    <div class="out-of-stock-badge">SOLD OUT</div>
                <?php endif; ?>
                
                <img src="<?= htmlspecialchars($car['pic']) ?>" class="card-img-top" alt="<?= htmlspecialchars($car['name']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($car['name']) ?></h5>
                    <p class="text-muted">Stock: <?= $car['stock'] ?></p>
                    <ul class="list-unstyled">
                        <li><strong>Hourly:</strong> $<?= $car['rate_by_hour'] ?></li>
                        <li><strong>Daily:</strong> $<?= $car['rate_by_day'] ?></li>
                        <li><strong>Per KM:</strong> $<?= $car['rate_by_km'] ?></li>
                    </ul>
                    <?php if ($isOutOfStock): ?>
                        <button class="btn btn-secondary w-100" disabled>Out of Stock</button>
                    <?php else: ?>
                        <a href="/cars/show?id=<?= $car['_id'] ?>" class="btn btn-primary w-100">Rent Now</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
