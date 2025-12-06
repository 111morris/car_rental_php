<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Edit Car: <?= htmlspecialchars($car['name']) ?></div>
            <div class="card-body">
                <form action="/admin/cars/update" method="POST">
                    <input type="hidden" name="id" value="<?= $car['_id'] ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Car Name</label>
                        <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($car['name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image URL</label>
                        <input type="text" class="form-control" name="pic" value="<?= htmlspecialchars($car['pic']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="info" rows="3" required><?= htmlspecialchars($car['info']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock" value="<?= $car['stock'] ?>" required min="0">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Seats</label>
                            <input type="number" class="form-control" name="seats" required min="1" max="10" value="<?= $car['seats'] ?? 4 ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Transmission</label>
                            <select class="form-select" name="transmission">
                                <option value="manual" <?= ($car['transmission'] ?? '') == 'manual' ? 'selected' : '' ?>>Manual</option>
                                <option value="automatic" <?= ($car['transmission'] ?? '') == 'automatic' ? 'selected' : '' ?>>Automatic</option>
                                <option value="both" <?= ($car['transmission'] ?? '') == 'both' ? 'selected' : '' ?>>Both</option>
                            </select>
                        </div>
                    </div>
                    
                    <hr>
                    <h5>Rates</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Per Hour ($)</label>
                            <input type="number" class="form-control" name="rate_by_hour" value="<?= $car['rate_by_hour'] ?>" required min="0">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Per Day ($)</label>
                            <input type="number" class="form-control" name="rate_by_day" value="<?= $car['rate_by_day'] ?>" required min="0">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Per KM ($)</label>
                            <input type="number" class="form-control" name="rate_by_km" value="<?= $car['rate_by_km'] ?>" required min="0">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Car</button>
                    <a href="/admin/cars" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
