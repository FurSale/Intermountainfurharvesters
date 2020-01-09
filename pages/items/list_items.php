<?php
  require_once("../../includes/db_connection.php");
	$pgsettings = array(
		"title" => "Items",
		"icon" => "icon-newspaper"
	);
  require_once("../../includes/functions.php");
  if(!logged_in()){
    header("Location: ../login.php");
  }

  function Delete(){
    global $connection;
    $id = mysqli_real_escape_string($connection, $_GET['deleteID']);

    $query = "SELECT * FROM `seller_item` WHERE `id` = {$id}";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    if (mysqli_num_rows($result)!=1){
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

  if(isset($_GET['deleteID'])){
    $result = Delete();
    if($result['success']){
      $success = $result['message'];
    }else{
      $error = $result['message'];
    }
  }

  $searchName = null;
  $itemQuery = "SELECT * FROM `seller_item` ORDER BY `lot` ASC";
  if(isset($_GET['lot'])){
    $searchName = urldecode($_GET['lot']);
    $searchName = mysqli_real_escape_string($connection, $searchName);
    $itemQuery = "SELECT * FROM `seller_item` WHERE `lot` LIKE '%{$searchName}%' ORDER BY `date_created` DESC";
  }

  require_once("../../includes/begin_html.php");
	require_once("../../includes/nav.php");

   ?>        <!-- START CONTENT -->
         <section id="content" class="print">
         <?php
	 	require_once("../../includes/crumbs.php");
	 	 ?>
      <!--start container-->
      <div class="container print">

          <!--Responsive Table-->
          <div id="responsive-table">
            <div class="row">
            <div class="col s12 m8 offset-m2">
            <div class="row printhide">
              <div class="input-field col s12">
                <input class="searchbar" placeholder="Lot #" id="search-query" type="text" value="<?php echo $searchName; ?>">
              </div>
            </div>
            <div class="row ">
              <div class="col s12">


                    <div class="row">
                      <div class="col s2">Seller</div>
                      <div class="col s1">Lot</div>
                      <div class="col s2">Item</div>
                      <div class="col s2">Count</div>
                      <!--<div class="col s2">Price</div>-->
                      <div class="col s2" >Bid</div>
                      <div class="col s2">Buyer</div>
                    </div>

                      <?php
                          $noBidsItems = array();
                          $lowBidsItems = array();
                          $goodBidsItems = array();

                          $resultItem=mysqli_query( $connection, $itemQuery);
                          confirm_query($resultItem);
                          while($sellerItem=mysqli_fetch_assoc($resultItem)){
                            $itemBids = get_item_bids($sellerItem['id']);
                            $highestBids = get_highest_bids($sellerItem['id']);
                            $sellerItem['high_bid'] = 0;
                            $sellerItem['buyer_names'] = "";
                            if(count($itemBids) < 1){
                              array_push($noBidsItems, $sellerItem);
                              continue;
                            }

                            $sellerItem['high_bid'] = $highestBids[0]['bid_amount'];

                            if(count($highestBids) > 0){
                              if($highestBids[0]['bid_amount'] >= $sellerItem['asking']){
                                $names = array();
                                foreach($highestBids as $highestBid){
                                  $query="SELECT * FROM `buyer` WHERE `id` = {$highestBid['buyer_id']}";
                                  $resultBuyer=mysqli_query( $connection, $query);
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

                          $itemArr = array_merge($noBidsItems, $lowBidsItems, $goodBidsItems);

                          foreach($itemArr as $sellerItem){
                            $query="SELECT * FROM `seller` WHERE id = {$sellerItem['seller_id']}";
                            $result2=mysqli_query( $connection, $query);
                            $sellerData=mysqli_fetch_array($result2);
                            ?>
                       <div  class="row section card-panel <?php if($sellerItem['high_bid'] > 0){if($sellerItem['high_bid'] >= $sellerItem['asking']){echo "green";}else{echo "red";}} ?> darken-2">
                         <div class="col s2" ><div class="chip blue white-text"><?php echo $sellerData['first_name'] . " " . $sellerData['last_name']; ?></div></div>
                          <div class="col s1"><?php echo $sellerItem['lot']; ?></div>
                          <div class="col s2"><?php echo $sellerItem['item']; ?></div>

                          <div class="col s2"><?php echo $sellerItem['count']; ?>/<?php echo $sellerItem['unit_of_measure']; ?></div>
                          <!--<div class="col s2"><?php echo "$".$sellerItem['asking']; ?></div>-->
                          <div class="col s2" ><?php if( $sellerItem['high_bid'] > 0 ){ echo "$".$sellerItem['high_bid']; }else{echo "N/A";} ?></div>
                          <div class="col s2" ><div class="chip black-text"><?php if($sellerItem['buyer_names'] != ""){ echo $sellerItem['buyer_names']; }else{echo "N/A";} ?></div></div>
                          <div class="col s1" class="printhide"><a href="list_items.php?deleteID=<?php echo $sellerItem['id']; ?>" class="waves-effect waves-yellow btn-flat white-text"><i class="material-icons">delete</i></a></div>
                        </div>
                        <?php
                          }
                      ?>

              </div>
            </div>
          </div>
          </div>
          </div>
      </div>
  </section>
  <script>
    $(document).ready(function(){
      $( "body" ).on("click", "#btn-search", function(e) {
        NavigateSearch();
      });
      $( "body" ).on("keypress", "#search-query", function(e) {
        if(e.which == 13) {
          NavigateSearch();
        }
      });
      function NavigateSearch(){
        var url = window.location.protocol + "//" + window.location.host + window.location.pathname;
        var query = $("#search-query").val();
        var newUrl = url + "?lot=" + encodeURI(query);
        window.location.href = newUrl;
      }
    });
  </script>
<!-- END WRAPPER -->
</main>
  <?php
  include '../../includes/footer.php';
  include '../../includes/end_html.php';
  ?>
