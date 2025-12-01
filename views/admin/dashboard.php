<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2 class="mb-4">Admin Dashboard</h2>

<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Manage Cars</h5>
                <p class="card-text">Add, edit, or remove cars from the fleet.</p>
                <a href="/admin/cars" class="btn btn-light">Go to Cars</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Manage Users</h5>
                <p class="card-text">View registered users.</p>
                <a href="/admin/users" class="btn btn-light">Go to Users</a>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
