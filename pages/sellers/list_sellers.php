<?php
require_once("../../includes/db_connection.php");
    $pgsettings = array(
        "title" => "Sellers",
        "icon" => "icon-newspaper"
    );
  require_once("../../includes/functions.php");

  verify_logged_in(array("administrator"));

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

    require_once("../../includes/begin_html.php");
    require_once("../../includes/nav.php");
  require_once("../../includes/crumbs.php");

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
		<div class="row">
			<div class="col s12">

				<div class="row">

					<div class="col s3">Name</div>

					<div class="col s2">Trapper</div>
					<div class="col s4 offset-s3">Action</div>
				</div>

				<?php
                          $result=mysqli_query($connection, $sellerQuery);
                          confirm_query($result);
                          while ($seller=mysqli_fetch_array($result)) {
                              ?>
															<div class="print sheet">
				<a class="white-text" href="edit_sellers.php?id=<?php echo $seller['id']; ?>">
					<div class="row section card-panel">

							<div class="col s3"><?php echo $seller['last_name'] . ", " . $seller['first_name']; ?></div>


							<div class="col s2"><?php echo $seller['trapper_id']; ?></div>
							<div class="col s3 offset-s4 printhide">
								<div class="chip <?php if (count(get_seller_sold_items($seller['id'])) < 1) {
                                  echo "red ";
                              } ?>"><?php if (count(get_seller_sold_items($seller['id'])) < 1) {
                                  echo "No ";
                              } ?>Sale</div>
								<!-- <a href="../items/edit_items.php?sellerId=<?php echo $seller['id']; ?>" class="waves-effect waves-light  btn-small"><i class="material-icons">add_box</i></a> -->
								<a class="waves-effect waves-light  btn-small blue modal-trigger" href="#modal<?php echo $seller['id']; ?>"><i class="material-icons">receipt</i></a>
								<a href="list_sellers.php?deleteID=<?php echo $seller['id']; ?>" class="waves-effect waves-light red btn-small"><i class="material-icons">delete</i></a>
							</div>
						</div>
						<div id="modal<?php echo $seller['id']; ?>" class="modal bottom-sheet">
							<div class="modal-content">


								<div class="row">
									<div class="col s2">ID Detail</div>
									<div class="col s2">Item</div>
									<div class="col s2">Count</div>
									<div class="col s2">Price</div>
									<div class="col s2">Bid</div>
									<div class="col s2">Commission</div>
								</div>

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
								<div class="row">
									<div class="col s2"><?php echo $itemData['lot']; ?></div>
									<div class="col s2"><?php echo $itemData['item']; ?></div>
									<div class="col s2"><?php echo $itemData['count']; ?></div>
									<div class="col s2">$<?php echo $itemData['asking']; ?></div>
									<div class="col s2"><?php echo "$".number_format($amount, 2); ?></div>
									<div class="col s2">$<?php echo number_format((($seller['commission']/100) * $amount), 2); ?></div>
								</div>
								<?php
                                  }
                              } ?>
								<div class="row">

									<div class="col s2">SUBTOTAL</div>

									<div class="col s2">$<?php echo number_format($subtotal, 2); ?></div>

								</div>
								<div class="row">
									<div class="col s2">Commission</div>
									<div class="col s2"><?php echo $seller['commission']; ?>%</div>
									<div class="col s2">-$<?php echo number_format((($seller['commission']/100) * $subtotal), 2); ?></div>
								</div>
								<div class="row">
									<div class="col s2"><span style="font-weight:bold;">Total Due</span></div>
									<div class="col s2"><span style="font-weight:bold;">$<?php echo number_format($subtotal - (($seller['commission']/100)* $subtotal), 2); ?></span></div>

								</div>

							</div>

						</div>

				</a>
				</div>
				<?php
                          }
                      ?>


			</div>
		</div>
	</div>
	</div>

</section>
<script>
	$(document).ready(function() {
		$("body").on("click", "#btn-search", function(e) {
			NavigateSearch();
		});
		$("body").on("keypress", "#search-query", function(e) {
			if (e.which == 13) {
				NavigateSearch();
			}
		});

		function NavigateSearch() {
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
