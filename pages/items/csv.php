<?php
  require_once("../../includes/db_connection.php");
    $pgsettings = array(
        "title" => "Items",
        "icon" => "icon-newspaper"
    );
  require_once("../../includes/functions.php");

  verify_logged_in(array("administrator"));

  function Delete()
  {
      global $connection;
      $id = mysqli_real_escape_string($connection, $_GET['deleteID']);

      $query = "SELECT * FROM `seller_item` WHERE `id` = {$id}";
      $result = mysqli_query($connection, $query);
      confirm_query($result);
      if (mysqli_num_rows($result)!=1) {
          return array('success' => false, 'message' => "Item does not exist to delete");
      }
      $itemData = mysqli_fetch_array($result);

      //Delete all the bids under the item
      $query = "DELETE FROM `bid` WHERE `seller_item_id` = {$itemData['id']}";
      $result = mysqli_query($connection, $query);
      confirm_query($result);

      //Delete the item
      $query = "DELETE FROM `seller_item` WHERE `id` = {$itemData['id']}";
      $result = mysqli_query($connection, $query);
      confirm_query($result);

      if (mysqli_affected_rows($connection) == 1) {
          return array('success' => true, 'message' => "Item {$itemData['lot']} deleted");
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
  $itemQuery = "SELECT * FROM `seller_item` ";




   ?>        <!-- START CONTENT -->

Type,Count,Price
<br/>
                      <?php
                          $noBidsItems = array();
                          $lowBidsItems = array();
                          $goodBidsItems = array();

                          $resultItem=mysqli_query($connection, $itemQuery);
                          confirm_query($resultItem);
                          while ($sellerItem=mysqli_fetch_assoc($resultItem)) {
                              $itemBids = get_item_bids($sellerItem['id']);
                              $highestBids = get_highest_bids($sellerItem['id']);
                              $sellerItem['high_bid'] = 0;
                              $sellerItem['buyer_names'] = "";
                              if (count($itemBids) < 1) {
                                  array_push($noBidsItems, $sellerItem);
                                  continue;
                              }

                              $sellerItem['high_bid'] = $highestBids[0]['bid_amount'];

                              if (count($highestBids) > 0) {
                                  if ($highestBids[0]['bid_amount'] >= $sellerItem['asking']) {
                                      $names = array();
                                      foreach ($highestBids as $highestBid) {
                                          $query="SELECT * FROM `buyer` WHERE `id` = {$highestBid['buyer_id']}";
                                          $resultBuyer=mysqli_query($connection, $query);
                                          confirm_query($resultBuyer);
                                          $data = mysqli_fetch_assoc($resultBuyer);
                                          array_push($names, ($data['first_name'] . " " . $data['last_name']));
                                      }
                                      $sellerItem['buyer_names'] = implode(" | ", $names);
                                      array_push($goodBidsItems, $sellerItem);
                                      continue;
                                  }
                              }
                              array_push($lowBidsItems, $sellerItem);
                          }

                          // print_r($noBidsItems);
                          // if(count($noBidsItems) > 0){
                          //   array_multisort($noBidsItems['lot'], SORT_ASC, SORT_REGULAR);
                          // }
                          // if(count($lowBidsItems) > 0){
                          //   array_multisort($lowBidsItems['lot'], SORT_ASC, SORT_REGULAR);
                          // }
                          // if(count($goodBidsItems) > 0){
                          //   array_multisort($goodBidsItems['lot'], SORT_ASC, SORT_REGULAR);
                          // }

                          $itemArr = array_merge($goodBidsItems);

                          foreach ($itemArr as $sellerItem) {
                              $query="SELECT * FROM `seller_item` ORDER BY `item` DESC";
                              $result2=mysqli_query($connection, $query);
                              $sellerData=mysqli_fetch_array($result2); ?>
                          <?php if ($sellerItem['high_bid'] > 0) {
                                  echo $sellerItem['item'], ",",$sellerItem['count'],",","$".$sellerItem['high_bid'],"<br>";
                              } else {
                                  echo "N/A","<br>";
                              } ?>
                        <?php
                          }
                      ?>
