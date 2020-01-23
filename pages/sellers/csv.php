<?php
require_once("../../includes/db_connection.php");
    $pgsettings = array(
        "title" => "Sellers",
        "icon" => "icon-newspaper"
    );
  require_once("../../includes/functions.php");

  verify_logged_in(array("administrator"));
  header("Content-type: text/csv");
  header("Content-Disposition: attachment; filename=Sellers.csv");
  header("Pragma: no-cache");
  header("Expires: 0");
  function Delete()
  {
      global $connection;
      $id = mysqli_real_escape_string($connection, $_GET['deleteID']);

      $query = "SELECT * FROM `seller` WHERE `id` = {$id}";
      $result = mysqli_query($connection, $query);
      confirm_query($result);
      if (mysqli_num_rows($result)!=1) {
          return array('success' => false, 'message' => "Seller does not exist to delete");
      }
      $sellerData = mysqli_fetch_array($result);

      //Delete all the bids under the items
      $query = "SELECT * FROM `seller_item` WHERE `seller_id` = {$id}";
      $result = mysqli_query($connection, $query);
      confirm_query($result);
      while ($sellerItem=mysqli_fetch_array($result)) {
          $query = "DELETE FROM `bid` WHERE `seller_item_id` = {$sellerItem['id']}";
          $result2 = mysqli_query($connection, $query);
          confirm_query($result2);
      }

      //Delete the items
      $query = "DELETE FROM `seller_item` WHERE `seller_id` = {$sellerData['id']}";
      $result = mysqli_query($connection, $query);
      confirm_query($result);

      //Delete the seller
      $query = "DELETE FROM `seller` WHERE `id` = {$sellerData['id']}";
      $result = mysqli_query($connection, $query);
      confirm_query($result);

      if (mysqli_affected_rows($connection) == 1) {
          return array('success' => true, 'message' => "Item {$sellerData['first_name']} deleted");
      }
      return array('success' => false, 'message' => "Couldn't update" . "<br />" . mysqli_error($connection));
  }

  if (isset($_GET['deleteID'])) {
      $result = Delete();
      if ($result['success']) {
          $success = $result['message'];
      } else {
          $error = $result['message'];
      }
  }



  $searchName = null;
  $sellerQuery = "SELECT * FROM `seller` ORDER BY `last_name` ASC";
  if (isset($_GET['name'])) {
      $searchName = urldecode($_GET['name']);
      $searchName = mysqli_real_escape_string($connection, $searchName);
      $sellerQuery = "SELECT * FROM (
      SELECT *, CONCAT(first_name, ' ', last_name) as firstlast
      FROM `seller` ORDER BY `last_name` ASC) base
    WHERE firstLast LIKE '%{$searchName}%'";
  }

     ?>

				<?php
                          $result=mysqli_query($connection, $sellerQuery);
                          confirm_query($result);
                          while ($seller=mysqli_fetch_array($result)) {
                              ?>



								<?php
                                  $subtotal = 0;
                              $query = "SELECT * FROM `seller_item` WHERE `seller_id` = {$seller['id']}";
                              $result2=mysqli_query($connection, $query);
                              confirm_query($result2);
                              //Check each of the buyer's bid to see if it's the winning one
                              while ($itemData=mysqli_fetch_array($result2)) {
                                  //Get first record of the highest bid in case of tie bids
                                  $query = "SELECT * FROM `bid` WHERE `seller_item_id` = {$itemData['id']} AND `bid_status` = 'Confirmed' ORDER BY `bid_amount` DESC, `DATE_CREATED` ASC LIMIT 1";
                                  $result3=mysqli_query($connection, $query);
                                  confirm_query($result3);
                                  if (mysqli_num_rows($result3) > 0) {
                                      $bid=mysqli_fetch_array($result3);
                                      $amount = 0;
                                      if ($bid['bid_amount'] >= $itemData['asking']) {
                                          $amount = $bid['bid_amount'];
                                      }
                                      $subtotal += $amount; ?>

								<?php
                                  }
                              } ?>

									<?php echo $seller['commission'] . "<br>"; ?>

				<?php
                          }
                      ?>
