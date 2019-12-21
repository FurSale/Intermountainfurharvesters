<?php
  require_once("../../includes/db_connection.php");
  require_once("../../includes/functions.php");

  if(!logged_in()){
    header("Location: ../login.php");
  }
  $buyerData = null;
  if(isset($_GET['id'])){
    $id = htmlspecialchars($_GET["id"]);
    $query="SELECT * FROM `buyer` WHERE `id`={$id}";
    $result=mysqli_query($connection, $query);
    //confirm_query($result);
    //Redirect to blog page if nothing returned from DB
    if(mysqli_num_rows($result) == 0){
      header("Location: list_buyers.php");
    }else{
      $buyerData=mysqli_fetch_array($result);
    }
  }

	$pgsettings = array(
		"title" => "Buyer Receipt",
		"icon" => "icon-newspaper"
	);
	$nav = ("1");

	require_once("../../includes/begin_html.php");
  require_once("../../includes/nav.php");
	 ?>
	 <!-- START CONTENT -->
 <section id="content">
	 <?php
	 	require_once("../../includes/crumbs.php");
	 	 ?>

      <!--start container-->
      <div class="container">

          <!--Responsive Table-->
          <div class="divider"></div>
          <div id="responsive-table">
            <h4 class="header">Data Buyers</h4>
            <div class="row">
              <div class="col s12">
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
                          $query = "SELECT * FROM `bid` WHERE `buyer_id` = {$buyerData['id']} AND bid_status = 'Confirmed'";
                          $result=mysqli_query( $connection, $query);
                          confirm_query($result);
                          //Check each of the buyer's bid to see if it's the winning one
                          while($bid=mysqli_fetch_array($result)){
                            //If bid is the highest for this item
                            $query = "SELECT * FROM `bid` WHERE `seller_item_id` = {$bid['seller_item_id']} AND `bid_amount` > {$bid['bid_amount']} AND bid_status = 'Confirmed'";
                            $result2=mysqli_query( $connection, $query);
                            confirm_query($result2);
                            if(mysqli_num_rows($result2) == 0){
                              //Check if bid is the first one time wise if there's a tie
                              $query = "SELECT * FROM `bid` WHERE `seller_item_id` = {$bid['seller_item_id']} AND `bid_amount` = {$bid['bid_amount']} AND `date_created` < '{$bid['date_created']}' AND bid_status = 'Confirmed'";
                              $result3=mysqli_query( $connection, $query);
                              confirm_query($result3);
                              if(mysqli_num_rows($result3) == 0){
                                //We should be down here if this is the winning bid
                                //Get item data for this bid
                                $query = "SELECT * FROM `seller_item` WHERE `id` = {$bid['seller_item_id']}";
                                $resultItem=mysqli_query( $connection, $query);
                                confirm_query($resultItem);
                                $itemData=mysqli_fetch_array($resultItem);
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
                          }
                      ?>
										<tr>
												<td></td>
												<td></td>
												<td>Subtotal</td>
												<td></td>
												<td>$<?php echo number_format($subtotal, 2); ?></td>
										</tr>
										<tr>
												<td></td>
												<td></td>
												<td>Commission</td>
												<td><?php echo $buyerData['commission']; ?>%</td>
												<td>$<?php echo number_format((($buyerData['commission']/100) * $subtotal), 2); ?></td>
										</tr>
									<tr>
                      <td></td>
                      <td></td>
                      <td><span style="font-weight:bold;">Total Due</span></td>
                      <td></td>
                      <td><span style="font-weight:bold;">$<?php echo (($buyerData['commission']/100) + 1) * $subtotal; ?></span></td>
                  </tr>
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    </section>
  <!-- END CONTENT -->
<?php


include '../../includes/end_html.php';


?>
