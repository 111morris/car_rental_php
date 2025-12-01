<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                
                <form action="/register" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="ph_no">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select class="form-select" name="gender">
                            <option value="u">Unspecified</option>
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                        </select>
                    </div>
                    
                    <hr>
                    <h5>Address</h5>
                    
                    <div class="mb-3">
                        <label class="form-label">Street</label>
                        <input type="text" class="form-control" name="street" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" name="city" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">State</label>
                            <input type="text" class="form-control" name="state" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Country</label>
                            <input type="text" class="form-control" name="country" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Zip</label>
                            <input type="number" class="form-control" name="zip" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
