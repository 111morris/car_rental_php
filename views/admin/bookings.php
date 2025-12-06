<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manage Bookings</h1>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Car</th>
                <th>Mode</th>
                <th>Duration/Dist</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Cost</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?= $booking['_id'] ?></td>
                <td><?= htmlspecialchars($booking['username']) ?></td>
                <td><?= htmlspecialchars($booking['car_name']) ?></td>
                <td><?= $booking['mode'] ?></td>
                <td><?= $booking['value'] ?></td>
                <td><?= $booking['start_date'] ?></td>
                <td><?= $booking['end_date'] ?></td>
                <td>$<?= $booking['total_cost'] ?></td>
                <td><?= $booking['status'] ?></td>
                <td>
                    <form action="/admin/bookings/delete" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $booking['_id'] ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
