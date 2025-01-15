<?php
$data = $data_base->my_query("SELECT COUNT(`session_id`) AS 'size' FROM `logged_in_users` WHERE 1");
$row = $data->fetch_assoc();
$logged_users = $row['size'];

$data = $data_base->my_query("SELECT COUNT(`id`) AS 'size' FROM `products` WHERE 1");
$row = $data->fetch_assoc();
$products = $row['size'];

$data = $data_base->my_query("SELECT COUNT(`id`) AS 'size' FROM `users` WHERE 1");
$row = $data->fetch_assoc();
$users = $row['size'];
?>


<div class="wrap">
  <div class="column">
    <h2>
      Game shop
    </h2>
    <p>
      Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa illum fugiat dolores omnis recusandae,
      rerum vero nostrum eius error quia quis ab pariatur qui consectetur sint ipsum corporis quasi eaque ut
      possimus adipisci in deserunt provident blanditiis? Sed magnam esse in necessitatibus! Laboriosam optio
      cupiditate excepturi obcaecati cum ad accusantium porro distinctio eius atque, quis placeat illum sunt nisi?
      Nulla assumenda perspiciatis sapiente reprehenderit aperiam possimus repudiandae asperiores. Iure itaque quo
      fuga fugiat? Aspernatur, voluptates facere eveniet ipsam placeat sint, sequi exercitationem est reiciendis
      consequatur velit nulla maiores numquam quis saepe similique, consequuntur illo tenetur quidem quas. Aspernatur,
      error impedit!
    </p>
  </div>
  <div class="column">
    <p>
      Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquam architecto illum dolore,
      sapiente modi facilis, doloremque quas provident fugit sed eaque. Mollitia porro ea accusantium
      molestias possimus aperiam optio soluta. Odio quas aspernatur placeat, a consequuntur eos! Ex, delectus nemo!
    </p>
    <div class="data">
      <div class="row">
        <p>Signed up users:</p>
        <?php echo "<p>$users</p>"; ?>
      </div>
      <div class="row">
        <p>Users online:</p>
        <?php echo "<p>$logged_users</p>"; ?>
      </div>
      <div class="row">
        <p>Games avaliable:</p>
        <?php echo "<p>$products</p>"; ?>
      </div>
    </div>
  </div>
</div>