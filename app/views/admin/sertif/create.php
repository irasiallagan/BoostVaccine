<?php
include (dirname(__DIR__) . '/includes/head.php');
?>

<body>
  <?php
  include (dirname(__DIR__) . '/includes/header.php');
  ?>


  <?php
  include (dirname(__DIR__) . '/includes/sidebar.php');
  ?>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <?php
    ?>
    <div class="container">
      <div class="row align-items-start">
        <div class="col">
          <br>
          <h2>Add Sertif</h2>
          <br>
        </div>
        <div class="col">
        </div>
      </div>
    </div>

    <form action="<?= BASE_URL ?>?url=admin/store_sertif" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="pemesanan_id">Select pemesanan id</label>
        <select id="pemesanan_id" name="pemesanan_id" class="form-control wide" required>
          <option value="" disabled selected>Select Pemesanan</option>
          <?php foreach ($data['pemesanan'] as $pemesanan): ?>
            <option value="<?= htmlspecialchars($pemesanan->id) ?>"><?= htmlspecialchars($pemesanan->id) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="issued_date">IssuedDate</label>
        <input type="datetime-local" id="issued_date" name="issued_date" class="form-control">
      </div>
      <div class="form-group">
        <label for="expiry_date">ExpiryDate</label>
        <input type="datetime-local" id="expiry_date" name="expiry_date" class="form-control">
      </div>
      <div class="form-group">
        <label for="file">Upload File (Image/PDF)</label>
        <input type="file" id="file" name="file" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
      </div>
      <br>
      <button type="submit" class="btn btn-outline-primary" value="update" name="add_item">Submit</button>
      <button type=" submit" class="btn btn-outline-danger" value="cancel" name="cancel">Cancel</button>
      <br> <br>
    </form>
  </main>
  </div>
  </div>
  <?php
  include (dirname(__DIR__) . '/includes/footer.php');
  ?>
</body>