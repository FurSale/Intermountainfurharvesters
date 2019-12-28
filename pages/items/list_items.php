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
            <div class="row  blue-grey darken-4">
              <div class="col s12">
                <table class="black-text">
                  <thead>
                    <tr>
                      <th data-field="lot">Lot</th>
                      <th data-field="name">Item</th>
                      <th data-field="count">Count</th>
                      <th data-field="price">Price</th>
                      <th data-field="high-bid">High Bid</th>
                    </tr>
                  </thead>
                  <tbody class="yellow">
                  <?php
                          $result=mysqli_query( $connection, $itemQuery);
                          //confirm_query($result);
                          while($sellerItem=mysqli_fetch_array($result)){
                            $query="SELECT * FROM `bid` WHERE seller_item_id = {$sellerItem['id']} ORDER BY `bid_amount` ASC LIMIT 1";
                            $result2=mysqli_query( $connection, $query);
                            $highestBid=mysqli_fetch_array($result2);
                            ?>
                       <tr class="<?php if($highestBid != null){if($highestBid['bid_amount'] < $sellerItem['asking']){echo "red";}else{echo "green";}} ?> darken-2">
                          <td><?php echo $sellerItem['lot']; ?></td>
                          <td><?php echo $sellerItem['item']; ?></td>

                          <td><?php echo $sellerItem['count']; ?>/<?php echo $sellerItem['unit_of_measure']; ?></td>
                          <td><?php echo "$".$sellerItem['asking']; ?></td>
                          <td ><?php if($highestBid != null){ echo "$".$highestBid['bid_amount']; }else{echo "N/A";} ?></td>
                          <td class="printhide"><a href="list_items.php?deleteID=<?php echo $sellerItem['id']; ?>" class="waves-effect waves-yellow btn-flat red-text">Delete</a></td>
                        </tr>
                        <?php
                          }
                      ?>
                  </tbody>
                </table>
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
