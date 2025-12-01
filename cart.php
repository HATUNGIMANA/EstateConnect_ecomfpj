<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$cart_count = 0;
foreach ($_SESSION['cart'] as $it) {
    $cart_count += isset($it['qty']) ? (int)$it['qty'] : 0;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Cart</title>
  </head>
  <body>
    <nav class="site-nav">
      <div class="container">
        <div class="menu-bg-wrap">
          <div class="site-navigation">
            <a href="index.php" class="logo m-0 float-start">EstateConnect</a>
            <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
              <li><a href="index.php">Home</a></li>
              <li><a href="properties.php">Properties</a></li>
              <li><a href="cart.php"><span class="icon-shopping_cart"></span> Cart<?php if($cart_count>0) echo ' (' . $cart_count . ')'; ?></a></li>
              <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
                <!-- Auth action buttons intentionally hidden on the cart page -->
              <?php else: ?>
                <li class="cta-button"><a href="login_Register/login.php" class="btn btn-success">Login</a></li>
                <li class="cta-button"><a href="login_Register/register.php" class="btn btn-outline-success">Register</a></li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <div class="container mt-5">
      <h2>Your Cart</h2>
      <?php if (empty($_SESSION['cart'])): ?>
        <p>Your cart is empty.</p>
        <p><a href="properties.php" class="btn btn-primary">Browse Properties</a></p>
      <?php else: ?>
        <table class="table">
          <thead>
            <tr>
              <th>Item</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <?php $total = 0; foreach ($_SESSION['cart'] as $it): ?>
              <?php $sub = ($it['price'] ?? 0) * ($it['qty'] ?? 1); $total += $sub; ?>
              <tr>
                <td><?php echo htmlspecialchars($it['title']); ?></td>
                <td><?php echo number_format($it['price'],2); ?></td>
                <td><?php echo (int)$it['qty']; ?></td>
                <td><?php echo number_format($sub,2); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="3">Total</th>
              <th><?php echo number_format($total,2); ?></th>
            </tr>
          </tfoot>
        </table>

        <div class="d-flex gap-2">
          <a href="actions/empty_cart.php" class="btn btn-danger" onclick="return confirm('Are you sure you want to empty the cart?');">Empty Cart</a>
          <form id="proceedPaymentForm" method="post" action="actions/proceed_to_payment.php">
            <button type="button" id="proceedBtn" class="btn btn-success">Proceed to Payment</button>
          </form>
        </div>
        <script>
          (function(){
            var btn = document.getElementById('proceedBtn');
            var form = document.getElementById('proceedPaymentForm');
            if(btn && form){
              btn.addEventListener('click', function(e){
                var msg = 'Proceed to payment?\n\nPlease note that the seller will reach out within 3 hours!\n\nThanks for trusting us!';
                if (confirm(msg)) {
                  form.submit();
                } else {
                  // user cancelled; do nothing
                }
              });
            }
          })();
        </script>
      <?php endif; ?>
    </div>
  </body>
</html>
