<?php
  require_once("../../includes/db_connection.php");
  require_once("../../includes/functions.php");

  verify_logged_in(array("administrator"));

  $sellerData = null;
  if (isset($_GET['id'])) {
      $id = htmlspecialchars($_GET["id"]);
      $query="SELECT * FROM `seller` WHERE `id`={$id}";
      $result=mysqli_query($connection, $query);
      //confirm_query($result);
      //Redirect to blog page if nothing returned from DB
      if (mysqli_num_rows($result) == 0) {
          header("Location: list_sellers.php");
      } else {
          $sellerData=mysqli_fetch_array($result);
      }
  }

    $pgsettings = array(
        "title" => "Seller Receipt",
        "icon" => "icon-newspaper"
    );
    $nav = ("1");

    require_once("../../includes/begin_html.php");
  require_once("../../includes/nav.php");
     ?>
	 <!-- START CONTENT -->
   <section id="content" class="print">
	 <?php
        require_once("../../includes/crumbs.php");
         ?>
      <!--start container-->
      <div class="container">

          <!--Responsive Table-->
          <div class="divider"></div>
          <div id="responsive-table">
            <h4 class="header printhide">SELLER</h4>
            <h5 class="header printhide"><?php echo $sellerData['first_name'] . " " . $sellerData['last_name']; ?></h5>
            <p><?php echo $sellerData['address_1'] . " " . $sellerData['address_2'] . ", " . $sellerData['city'] . ", " . $sellerData['state'] . " " . $sellerData['zip']; ?></p>
            <div class="row">
              <div class="col s12 sheet ">
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
                        <tr>
                            <td><?php echo $itemData['lot']; ?></td>
                            <td><?php echo $itemData['item']; ?></td>
                            <td><?php echo $itemData['count']; ?></td>
                            <td>$<?php echo $itemData['asking']; ?></td>
                            <td <?php if ($bid['bid_amount'] < $itemData['asking']) {
                                                echo "class=\"red-text\"";
                                            } else {
                                                echo "class=\"green-text\"";
                                            } ?>><?php echo "$".$bid['bid_amount']; ?></td>
                          </tr>
                    <?php
                                        }
                                    }
                      ?>
                  <tr>
                      <td>TOTAL</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>$<?php echo number_format($subtotal, 2); ?></td>
                  </tr>
                  <div class="row">
                      <div class="col s1  offset-s3">Commission</div>
                      <div class="col s1"><?php echo $sellerData['commission']; ?>%</div>
                      <div class="col s2 right-align">$<?php echo number_format((($sellerData['commission']/100) * $subtotal), 2); ?></div>
                  </div>
                <div class="row">
                    <div class="col s2 offset-s3"><span style="font-weight:bold;">Total Due</span></div>
                    <div class="col s2 right-align"><span style="font-weight:bold;">$<?php echo(($sellerData['commission']/100) + 1) * $subtotal; ?></span></div>
                </div>
                  </tbody>
                </table>
                <div class="col s12 m12 l12">
                    <br/>
                    <a class="waves-effect waves-light  btn right"><i class="material-icons left">send</i> Export</a>
                </div>
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
