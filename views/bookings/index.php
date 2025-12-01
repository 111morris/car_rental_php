<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2 class="mb-4">My Rentals</h2>

<?php if (empty($rentals)): ?>
    <div class="alert alert-info">You haven't rented any cars yet.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Car</th>
                    <th>Mode</th>
                    <th>Duration/Distance</th>
                    <th>Total Cost</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rentals as $rental): ?>
                    <tr>
                        <td><?= htmlspecialchars($rental['car_name']) ?></td>
                        <td><?= ucfirst($rental['mode']) ?></td>
                        <td><?= $rental['value'] ?></td>
                        <td>$<?= $rental['total_cost'] ?></td>
                        <td><?= $rental['created_at'] ?></td>
                        <td><span class="badge bg-success"><?= ucfirst($rental['status']) ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
