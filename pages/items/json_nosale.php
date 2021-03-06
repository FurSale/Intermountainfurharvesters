<?php
  require_once("../../includes/db_connection.php");
    $pgsettings = array(
        "title" => "Items",
        "icon" => "icon-newspaper"
    );
  require_once("../../includes/functions.php");

  require_once '../../vendor/autoload.php';
  use YoHang88\LetterAvatar\LetterAvatar;

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
  $itemQuery = "SELECT * FROM `seller_item` ORDER BY `seller_id` ASC";
  if (isset($_GET['lot'])) {
      $searchName = urldecode($_GET['lot']);
      $searchName = mysqli_real_escape_string($connection, $searchName);
      $itemQuery = "SELECT * FROM `seller_item` WHERE `lot` LIKE '%{$searchName}%' ORDER BY `item_type` DESC";
  }



   ?>        <!-- START CONTENT -->


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
                                          array_push($names, ($data['first_name'] . "+" . $data['last_name']));
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

                          $itemArr = array_merge($lowBidsItems);

                          foreach ($itemArr as $sellerItem) {
                              $query="SELECT * FROM `seller` WHERE id = {$sellerItem['seller_id']}";
                              $result2=mysqli_query($connection, $query);
                              $sellerData=mysqli_fetch_array($result2); ?>
                       <div  class="row section card-panel <?php if ($sellerItem['high_bid'] > 0) {
                                  if ($sellerItem['high_bid'] >= $sellerItem['asking']) {
                                      echo "green";
                                  } else {
                                      echo "red";
                                  }
                              } ?> darken-2">
                         <div class="col s1 printhide" ><a href="../sellers/edit_sellers.php?id=<?php echo $sellerData['id']; ?>" class="tooltipped" data-position="bottom" data-tooltip="<?php echo $sellerData['first_name'] . " " . $sellerData['last_name']; ?>"><img class="responsive-img" src="https://ui-avatars.com/api/?rounded=true&size=32&name=<?php echo $sellerData['first_name'] . "+" . $sellerData['last_name']; ?>"></a></div>
                          <div class="col s1"><a href="item.php?id=<?php echo $sellerItem['id']; ?>"><?php echo $sellerItem['lot']; ?></a></div>
                          <div class="col s2"><?php echo $sellerItem['item']; ?></div>

                          <div class="col s1"><?php echo $sellerItem['count'] + 0; ?>/<?php echo $sellerItem['unit_of_measure']; ?></div>
                          <div class="col s1 printhide" contenteditable='true'>$<?php echo $sellerItem['asking'] + 0; ?></div>
                          <div class="col s1" ><?php if ($sellerItem['high_bid'] > 0) {
                                  echo "$".number_format($sellerItem['high_bid'], 2);
                              } ?></div>

                              <?php
                              $membersQuery = "SELECT * FROM `buyer` WHERE `id` = {$highestBid['buyer_id']}";
                              $membersResult = mysqli_query($connection, $membersQuery);
                              while ($member = mysqli_fetch_assoc($membersResult)) {
                                  $avatarImage = '';
                                  if ($member['avatar']) {
                                      $avatarImage = $member['avatar'];
                                  } else {
                                      $memberName = $member['first_name']." ".$member['last_name'];
                                      $avatarImage = new LetterAvatar($memberName, 'circle', 64);
                                  } ?>
                          <div class="col s1" >
                            <div class="black-text">
                              <?php if ($sellerItem['buyer_names'] != "") {
                                      echo  '<img class="responsive-img" src="https://ui-avatars.com/api/?rounded=true&size=32&name='.$sellerItem['buyer_names'].'">';
                                  } ?>
                            </div>
                            </div>
<?php
                              } ?>
                          <!--<div class="col s1 printhide"><a href="list_items.php?deleteID=<?php echo $sellerItem['id']; ?>" class="waves-effect waves-yellow btn-flat white-text"><i class="material-icons">delete</i></a></div>-->
                        </div>
                        <?php
                          }
                      ?>
                    </div>

                    <div id="print2">
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
                                          array_push($names, ($data['first_name'] . "+" . $data['last_name']));
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

                          $itemArr = array_merge($noBidsItems);

                          foreach ($itemArr as $sellerItem) {
                              $query="SELECT * FROM `seller` WHERE id = {$sellerItem['seller_id']}";
                              $result2=mysqli_query($connection, $query);
                              $sellerData=mysqli_fetch_array($result2); ?>
                       <div  class="row section card-panel <?php if ($sellerItem['high_bid'] > 0) {
                                  if ($sellerItem['high_bid'] >= $sellerItem['asking']) {
                                      echo "green";
                                  } else {
                                      echo "red";
                                  }
                              } ?> darken-2">
                         <div class="col s1 printhide" ><a href="../sellers/edit_sellers.php?id=<?php echo $sellerData['id']; ?>" class="tooltipped" data-position="bottom" data-tooltip="<?php echo $sellerData['first_name'] . " " . $sellerData['last_name']; ?>"><img class="responsive-img" src="https://ui-avatars.com/api/?rounded=true&size=32&name=<?php echo $sellerData['first_name'] . "+" . $sellerData['last_name']; ?>"></a></div>
                          <div class="col s1"><a href="item.php?id=<?php echo $sellerItem['id']; ?>"><?php echo $sellerItem['lot']; ?></a></div>
                          <div class="col s2"><?php echo $sellerItem['item']; ?></div>

                          <div class="col s1"><?php echo $sellerItem['count'] + 0; ?>/<?php echo $sellerItem['unit_of_measure']; ?></div>
                          <div class="col s1 printhide" contenteditable='true'>$<?php echo $sellerItem['asking'] + 0; ?></div>
                          <div class="col s1" ><?php if ($sellerItem['high_bid'] > 0) {
                                  echo "$".number_format($sellerItem['high_bid'], 2);
                              } ?></div>

                              <?php
                              $membersQuery = "SELECT * FROM `buyer` WHERE `id` = {$highestBid['buyer_id']}";
                              $membersResult = mysqli_query($connection, $membersQuery);
                              while ($member = mysqli_fetch_assoc($membersResult)) {
                                  $avatarImage = '';
                                  if ($member['avatar']) {
                                      $avatarImage = $member['avatar'];
                                  } else {
                                      $memberName = $member['first_name']." ".$member['last_name'];
                                      $avatarImage = new LetterAvatar($memberName, 'circle', 64);
                                  } ?>
                          <div class="col s1" >
                            <div class="black-text">
                              <?php if ($sellerItem['buyer_names'] != "") {
                                      echo  '<img class="responsive-img" src="https://ui-avatars.com/api/?rounded=true&size=32&name='.$sellerItem['buyer_names'].'">';
                                  } ?>
                            </div>
                            </div>
                      <?php
                              } ?>
                          <!--<div class="col s1 printhide"><a href="list_items.php?deleteID=<?php echo $sellerItem['id']; ?>" class="waves-effect waves-yellow btn-flat white-text"><i class="material-icons">delete</i></a></div>-->
                        </div>
                        <?php
                          }
                      ?>
          
