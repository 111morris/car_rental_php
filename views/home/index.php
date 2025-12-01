<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="hero rounded-3">
    <h1 class="display-4 fw-bold">Find Your Drive</h1>
    <p class="lead">Rent the best cars at the best prices. Flexible hourly, daily, and km-based rates.</p>
    <a href="/cars" class="btn btn-primary btn-lg">Browse Cars</a>
</div>

<h2 class="mt-5 mb-4">Featured Cars</h2>
<div class="row">
    <?php foreach ($cars as $car): ?>
        <div class="col-md-4 mb-4">
            <div class="card car-card h-100">
                <img src="<?= htmlspecialchars($car['pic']) ?>" class="card-img-top" alt="<?= htmlspecialchars($car['name']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($car['name']) ?></h5>
                    <p class="card-text"><?= substr(htmlspecialchars($car['info']), 0, 100) ?>...</p>
                    <a href="/cars/show?id=<?= $car['_id'] ?>" class="btn btn-outline-primary">View Details</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
