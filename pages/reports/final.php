<?php
  require_once("../../includes/db_connection.php");
    $pgsettings = array(
        "title" => "Item Type Results",
        "icon" => "icon-newspaper"
    );
    $nav = ("1");
  require_once("../../includes/functions.php");
  verify_logged_in(array("administrator"));

    require_once("../../includes/begin_html.php");
    require_once("../../includes/nav.php");



     ?>
	 <!-- START CONTENT -->
 <section id="content" class="print">
	 <?php
        require_once("../../includes/crumbs.php");
         ?>

      <!--start container-->
      <div class="container sheet">
            <table class="responsive-table striped">
              <thead>
    <tr>
        <th>Name</th>
        <th>Offered</th>
        <th>Average</th>
        <th>Highest</th>
        <th>Sale Total</th>
        <th>Sold</th>
    </tr>
  </thead>

  <tbody>

  <?php
    // //$itemTypes is defined in functions.php
    // $types = $itemTypes;
    // //Get custom item types
    // $query = "SELECT `item` FROM `seller_item` WHERE `item` NOT IN ('".implode("', '",$types)."')";
    // $resultTypes = mysqli_query($connection, $query);
    // confirm_query($resultTypes);
    // while($type=mysqli_fetch_array($resultTypes)){
    //   if(array_search($type['item'], $types) === false){
    //     array_push($types, $type['item']);
    //   }
    // }

    //Go through each type
    $query = "SELECT * FROM `item_type`";
    $resultTypes=mysqli_query($connection, $query);
    confirm_query($resultTypes);
    while ($value=mysqli_fetch_assoc($resultTypes)) {
        $itemQuery = "SELECT * FROM `seller_item` WHERE `item` = '{$value['name']}'";
        $result = mysqli_query($connection, $itemQuery);
        confirm_query($result);
        $totalcount = "SELECT SUM(count) AS value_sum FROM seller_item WHERE `item` = '{$value['name']}'";
        $result4 = mysqli_query($connection, $totalcount);
        $row = mysqli_fetch_assoc($result4);
        $offered = $row['value_sum'];
        $averageArr = [];
        $average = 0;
        $highest = 0;
        $saleTotal = 0;
        $amountSold = 0;
        //Go through each item of this type and get bid data
        while ($sellerItem=mysqli_fetch_array($result)) {
            $bidQuery = "SELECT * FROM `bid` WHERE bid_status = 'Confirmed' AND `seller_item_id` = {$sellerItem['id']} ORDER BY `bid_amount` DESC LIMIT 1";
            $result2 = mysqli_query($connection, $bidQuery);
            confirm_query($result2);
            if ($result2 >= 0) {
                $bid=mysqli_fetch_array($result2);
                //Skip if highest bid is less than asking (not sold)
                if ($bid['bid_amount'] < $sellerItem['asking']) {
                    continue;
                }
                $saleTotal += $bid['bid_amount'];
                array_push($averageArr, $bid['bid_amount']);
                if ($bid['bid_amount'] > $highest) {
                    $highest = $bid['bid_amount'];
                }
                $amountSold ++;
            }
        }

        //Do the average if the array has items in it
        if (count($averageArr)) {
            $average = array_sum($averageArr)/count($averageArr);
        } ?>
      <tr>
        <td><b><?php echo $value['name']; ?></b></td>
        <td><?php echo $offered; ?></td>
        <td>$<?php echo number_format($average, 2); ?></td>
        <td>$<?php echo number_format($highest, 2); ?></td>
        <td>$<?php echo number_format($saleTotal, 2); ?></td>
        <td><?php echo $amountSold; ?></td>
        <td><?php if ($offered > 0) {
            echo round(($amountSold / $offered) * 100, 2)."%";
        } else {
            echo "N/A";
        } ?></td>
      </tr>
    <?php
    }
  ?>
</table>
        </div>
    </div>
  </main>
  <!-- END CONTENT -->
<?php


include '../../includes/end_html.php';


?>
