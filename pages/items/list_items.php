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
  require_once("../../includes/begin_html.php");
	require_once("../../includes/nav.php");

   ?>        <!-- START CONTENT -->
         <section id="content">
         <?php
	 	require_once("../../includes/crumbs.php");
	 	 ?>
      <!--start container-->
      <div class="container">

          <!--Responsive Table-->
          <div id="responsive-table">
            <h4 class="header">Data sale</h4>
            <div class="row">
              <div class="col s12">
                <table class="responsive-table">
                  <thead>
                    <tr>
                      <th data-field="lot">Lot</th>
                      <th data-field="name">Item</th>
                      <th data-field="count">Count</th>
                      <th data-field="price">Price</th>
                      <th data-field="sale_made">Sale Made</th>
                      <th data-field="name">Region</th>
                      <!--<th data-field="high-bid">High Bid</th>-->
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        	$query="SELECT * FROM `seller_item`";
                          $result=mysqli_query( $connection, $query);
                          //confirm_query($result);
                          while($sellerItem=mysqli_fetch_array($result)){
                            $query="SELECT * FROM `bid` WHERE seller_item_id = {$sellerItem['id']} ORDER BY `bid_amount` ASC LIMIT 1";
                            $result2=mysqli_query( $connection, $query);
                            $highestBid=mysqli_fetch_array($result2);
                            ?>
                       <tr>
                          <td><?php echo $sellerItem['lot']; ?></td>
                          <td><?php echo $sellerItem['item']; ?></td>

                          <td><?php echo $sellerItem['count']; ?>/<?php echo $sellerItem['unit_of_measure']; ?></td>
                          <td><?php echo "$".$sellerItem['asking']; ?></td>
                          <!--4<td <?php if($highestBid != null){if($highestBid['bid_amount'] < $sellerItem['asking']){echo "class=\"red-text\"";}else{echo "class=\"green-text\"";}} ?>><?php if($highestBid != null){ echo "$".$highestBid['bid_amount']; }else{echo "N/A";} ?></td>-->
                          <td><?php echo $sellerItem['sale_made']? "Yes" : "No"; ?></td>
                          <td><?php echo $sellerItem['origin_state']; ?></td>
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
  </section>
<!-- END WRAPPER -->
</main>
  <?php
  include '../../includes/footer.php';
  include '../../includes/end_html.php';
  ?>
