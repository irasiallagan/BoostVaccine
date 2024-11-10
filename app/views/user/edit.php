<?php
include(dirname(__DIR__) . '/includes/head.php');
?>

<body>
    <?php
    include(dirname(__DIR__) . '/includes/header.php');
    include(dirname(__DIR__) . '/includes/sidebar.php');
    ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="container">
            <div class="row align-items-start">
                <div class="col">
                    <br>
                    <h2>Edit User</h2>
                    <br>
                </div>
                <div class="col"></div>
            </div>
        </div>

        <form action="<?= BASE_URL ?>?url=admin/update_user" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?= $users['user']->id ?>">

            <!-- Input Name -->
            <div class="form-group">
                <label for="user_name">Name</label>
                <input type="text" id="user_name" name="Name" value="<?= htmlspecialchars($users['user']->Name) ?>" class="form-control" required>
            </div>

            <!-- Input Email -->
            <div class="form-group">
                <label for="user_email">Email</label>
                <input type="email" id="user_email" name="Email" value="<?= htmlspecialchars($data['user']->Email) ?>" class="form-control" required>
            </div>

            <!-- Input Phone Number -->
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" id="phone_number" name="PhoneNumber" value="<?= htmlspecialchars($data['user']->PhoneNumber) ?>" class="form-control" required>
            </div>

            <!-- Select IsAdmin Status -->
            <div class="form-group">
                <label for="is_admin">Is Admin</label>
                <select id="is_admin" name="IsAdmin" class="form-control" required>
                    <option value="0" <?= $data['user']->IsAdmin == 0 ? 'selected' : '' ?>>No</option>
                    <option value="1" <?= $data['user']->IsAdmin == 1 ? 'selected' : '' ?>>Yes</option>
                </select>
            </div>
            <!-- Submit and Cancel Buttons -->
            <br>
            <button type="submit" class="btn btn-outline-primary" value="update" name="edit_user">Submit</button>
            <button type="button" class="btn btn-outline-danger" onclick="window.location.href='<?= BASE_URL ?>?url=admin/customers'">Cancel</button>
            <br><br>
        </form>
    </main>

    <?php include(dirname(__DIR__) . '/includes/footer.php'); ?>
</body>