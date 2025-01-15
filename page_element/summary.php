<head>
  <link rel="stylesheet" href="../style/form.css" />
</head>

<?php

// check user input - sign up
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST['submit'] == 'Purchase') {
    $payment_method = htmlspecialchars($_POST['payment_method']);
    $payment = htmlspecialchars($_POST['payment']);

    if (!empty($games)) {
      // validation kinda
      if (empty($payment)) {
        echo "<div class='info'>";
        echo "Enter payment data it may be code, number or text";
        echo "</div>";
      } else {
        // clear shopping cart - user bought items
        $data_base->my_query("DELETE FROM `shopping_cart` WHERE `user_id` LIKE '$user_id'");
        header('Location: ../page/test.php');
      }
    } else {
      echo "<div class='info'>";
      echo "Your shopping cart is empty.";
      echo "</div>";
    }
  }
}
?>

<div class="wrap">
  <form class="my_form" method="POST">
    <div class="input_set">
      <label for="price">Total</label>
      <?php
      if ($sum == 0) {
        echo "<p id='price'>FREE</p>";
      } else {
        echo "<p id='price'>$sum USD</p>";
      }
      ?>
    </div>
    <div class="input_set">
      <label for="payment_method">Payment method</label>
      <select name="payment_method" id="cars">
        <option value="blik">Blik</option>
        <option value="visa">Visa</option>
        <option value="mastercard">Mastercard</option>
        <option value="giftcard">Gift Card</option>
      </select>
    </div>
    <div class="input_set">
      <label for="payment">Payment</label>
      <input type="text" name="payment" id="payment" />
    </div>
    <div class="button_set">
      <input type="submit" name="submit" value="Purchase" id="submit" />
      <input type="reset" name="reset" value="Clear" id="clear" />
    </div>
  </form>
</div>