<?php
require_once("../../includes/db_connection.php");
	$pgsettings = array(
		"title" => "Sellers",
		"icon" => "icon-newspaper"
	);
  require_once("../../includes/functions.php");
  if(!logged_in()){
    header("Location: ../login.php");
  }

  function Delete(){
    global $connection;
    $id = mysqli_real_escape_string($connection, $_GET['deleteID']);

    $query = "SELECT * FROM `seller` WHERE `id` = {$id}";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    if (mysqli_num_rows($result)!=1){
      return array('success' => false, 'message' => "Seller does not exist to delete");
    }
    $sellerData = mysqli_fetch_array($result);

    //Delete all the bids under the items
    $query = "SELECT * FROM `seller_item` WHERE `seller_id` = {$id}";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    while($sellerItem=mysqli_fetch_array($result)){
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

  if(isset($_GET['deleteID'])){
    $result = Delete();
    if($result['success']){
      $success = $result['message'];
    }else{
      $error = $result['message'];
    }
  }

	require_once("../../includes/begin_html.php");
	require_once("../../includes/nav.php");
  require_once("../../includes/crumbs.php");

  $searchName = null;
  $sellerQuery = "SELECT * FROM `seller` ORDER BY `last_name` ASC";
  if(isset($_GET['name'])){
    $searchName = urldecode($_GET['name']);
    $searchName = mysqli_real_escape_string($connection, $searchName);
    $sellerQuery = "SELECT * FROM (
      SELECT *, CONCAT(first_name, ' ', last_name) as firstlast
      FROM `seller` ORDER BY `last_name` ASC) base
    WHERE firstLast LIKE '%{$searchName}%'";
  }

	 ?>
   <!-- START CONTENT -->
 <section id="content">
          <!--start container-->
          <div class="container">
              <!--Responsive Table-->


                <div class="row">
                    <div class="input-field col s4 offset-s4">
                      <input placeholder="Name" id="search-query" type="text" value="<?php echo $searchName; ?>">
                      <label for="search-query">Name</label>
                    </div>
                    <div class=" col s1">
                      <button class="waves-effect waves-light btn-small" id="btn-search"><i class="material-icons left">search</i>Search</button>
                    </div>
                  </div>
                <div class="row print">
                  <div class="col s12 printhide">

                        <div class="row">

                          <div class="col s3">Name</div>

                          <div class="col s2">Trapper</div>
                          <div class="col s4 offset-s3">Action</div>
                        </div>

                      <?php
                          $result=mysqli_query( $connection, $sellerQuery);
                          confirm_query($result);
                          while($seller=mysqli_fetch_array($result)){
                            ?>
														<a class="white-text" href="edit_sellers.php?id=<?php echo $seller['id']; ?>">
                       <div class="row section card-panel  sheet">

                          <div class="col s3"><?php echo $seller['last_name'] . ", " . $seller['first_name']; ?></div>


                          <div class="col s2"><?php echo $seller['trapper_id']; ?></div>
                          <div class="col s3 offset-s4 printhide">
														<div class="chip <?php if(count(get_seller_sold_items($seller['id'])) < 1 ){echo "red "; } ?>"><?php if(count(get_seller_sold_items($seller['id'])) < 1 ){echo "No "; } ?>Sale</div>
                            <!-- <a href="../items/edit_items.php?sellerId=<?php echo $seller['id']; ?>" class="waves-effect waves-light  btn-small"><i class="material-icons">add_box</i></a> -->
														  <a class="waves-effect waves-light  btn-small blue modal-trigger" href="#modal<?php echo $seller['id']; ?>"><i class="material-icons">receipt</i></a>
															<a href="list_sellers.php?deleteID=<?php echo $seller['id']; ?>" class="waves-effect waves-light red btn-small"><i class="material-icons">delete</i></a>
                          </div>
													<div id="modal<?php echo $seller['id']; ?>" class="modal bottom-sheet">
                            <div class="modal-content">
                              <table class="responsive-table">
                              <thead>
                                  <tr>
                                    <th data-field="id">ID Detail</th>
                                    <th data-field="name">Item</th>
                                    <th data-field="jumlah">Count</th>
                                    <th data-field="harga">Price</th>
                                    <th data-field="subtotal">Bid</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $subtotal = 0;
                                  $query = "SELECT * FROM `seller_item` WHERE `seller_id` = {$seller['id']}";
                                  $result2=mysqli_query( $connection, $query);
                                  confirm_query($result2);
                                  //Check each of the buyer's bid to see if it's the winning one
                                  while($itemData=mysqli_fetch_array($result2)){
                                    //Get first record of the highest bid in case of tie bids
                                    $query = "SELECT * FROM `bid` WHERE `seller_item_id` = {$itemData['id']} AND `bid_status` = 'Confirmed' ORDER BY `bid_amount` DESC, `DATE_CREATED` ASC LIMIT 1";
                                    $result3=mysqli_query( $connection, $query);
                                    confirm_query($result3);
                                    if(mysqli_num_rows($result3) > 0){
                                      $bid=mysqli_fetch_array($result3);
                                        $subtotal += $bid['bid_amount'];
                                        ?>
                                        <tr>
                                            <td><?php echo $itemData['lot']; ?></td>
                                            <td><?php echo $itemData['item']; ?></td>
                                            <td><?php echo $itemData['count']; ?></td>
                                            <td>$<?php echo $itemData['asking']; ?></td>
                                            <td <?php if($bid['bid_amount'] < $itemData['asking']){echo "class=\"red-text\"";}else{echo "class=\"green-text\"";} ?>><?php echo "$".$bid['bid_amount']; ?></td>
                                          </tr>
                                    <?php
                                    }
                                  }
                                      ?>
                                  <tr>
                                      <td>SUBTOTAL</td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td>$<?php echo number_format($subtotal, 2); ?></td>
                                  </tr>
                                  <tr>
                                      <td></td>
                                      <td></td>
                                      <td>Commission</td>
                                      <td><?php echo $seller['commission']; ?>%</td>
                                      <td>$<?php echo number_format((($seller['commission']/100) * $subtotal), 2); ?></td>
                                  </tr>
                                  <tr>
                                      <td></td>
                                      <td></td>
                                      <td><span style="font-weight:bold;">Total Due</span></td>
                                      <td></td>
                                      <td><span style="font-weight:bold;">$<?php echo number_format((($seller['commission']/100) + 1) * $subtotal, 2); ?></span></td>
                                  </tr>
                                </tbody>
		</table>
	</div>

</div>
                        </div>
												</a>
                        <?php

                          }
                      ?>


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
                  var newUrl = url + "?name=" + encodeURI(query);
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
