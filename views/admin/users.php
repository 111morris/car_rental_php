<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2 class="mb-4">Manage Users</h2>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['_id'] ?></td>
                    <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['ph_no']) ?></td>
                    <td><?= $user['join_time'] ?></td>
                    <td>
                        <?php if ($user['username'] !== 'admin'): // Prevent deleting the main admin ?>
                            <form action="/admin/users/delete" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user? This will also delete their bookings.');">
                                <input type="hidden" name="id" value="<?= $user['_id'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        <?php else: ?>
                            <span class="badge bg-secondary">Admin</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
