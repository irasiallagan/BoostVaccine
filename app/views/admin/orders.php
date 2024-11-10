<?php
include "includes/head.php";
?>

<body>
  <?php include "includes/header.php"; ?>
  <?php include "includes/sidebar.php"; ?>

  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
      <div class="row align-items-start">
        <div class="col">
          <br>
          <h2>Order Details</h2>
          <br>
        </div>
        <div class="col"></div>
        <div class="col">
          <br>
          <form class="d-flex" method="GET" action="orders.php">
            <input class="form-control me-2 col" type="search" name="search_order_id" placeholder="Search for order (ID)" aria-label="Search">
            <button class="btn btn-outline-secondary" type="submit" name="search_order" value="search">Search</button>
          </form>
          <br>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">User ID</th>
            <th scope="col">Vaksin ID</th>
            <th scope="col">Ewallet ID</th>
            <th scope="col">Schedule</th>
            <th scope="col">Location</th>
            <th scope="col">Is Confirm</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($data['orders'] as $order) : ?>
            <tr>
              <td><?php echo htmlspecialchars($order->id); ?></td>
              <td><?php echo htmlspecialchars($order->UserID); ?></td>
              <td><?php echo htmlspecialchars($order->VaksinID); ?></td>
              <td><?php echo htmlspecialchars($order->EWalletID); ?></td>
              <td><?php echo htmlspecialchars($order->Schedule); ?></td>
              <td><?php echo htmlspecialchars($order->Location); ?></td>
              <td style="color: <?php echo $order->IsConfirm == 1 ? 'green' : 'red'; ?>">
                <?php echo $order->IsConfirm == 1 ? 'Diproses' : 'Pending'; ?>
              </td>
              <td>
                <button type="button" class="btn btn-outline-danger">
                  <a style="text-decoration: none; color:black;" href="<?= BASE_URL ?>?url=admin/order&delete=<?= $order->id; ?>">Delete</a>
                </button>

                <?php if ($order->IsConfirm == 1) : ?>
                  <button type="button" class="btn btn-outline-danger">
                    <a style="text-decoration: none; color:black;" href="<?= BASE_URL ?>?url=admin/order&undo=<?= $order->id; ?>">&nbsp;Undo&nbsp;</a>
                  </button>
                <?php else : ?>
                  <button type="button" class="btn btn-outline-success">
                    <a style="text-decoration: none; color:black;" href="<?= BASE_URL ?>?url=admin/order&done=<?= $order->id; ?>">&nbsp;Done&nbsp;</a>
                  </button>
                <?php endif; ?>

                <button type="button" class="btn btn-outline-info">
                  <a style="text-decoration: none; color:black;" href="<?= BASE_URL ?>?url=admin/customers&id=<?= $order->UserID; ?>">&nbsp;User Details&nbsp;</a>
                </button>
                <button type="button" class="btn btn-outline-info">
                  <a style="text-decoration: none; color:black;" href="<?= BASE_URL ?>?url=admin/products&id=<?= $order->VaksinID; ?>">Vaksin Details</a>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>

      </table>
    </div>
  </main>
  </div>
  </div>

  <?php include "includes/footer.php"; ?>