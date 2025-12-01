<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Cars</h2>
    <a href="/admin/cars/create" class="btn btn-primary">Add New Car</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cars as $car): ?>
            <tr>
                <td><?= $car['_id'] ?></td>
                <td><?= htmlspecialchars($car['name']) ?></td>
                <td><?= $car['stock'] ?></td>
                <td>
                    <a href="/admin/cars/edit?id=<?= $car['_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <form action="/admin/cars/delete" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                        <input type="hidden" name="id" value="<?= $car['_id'] ?>">
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
