<?php
  require_once("../../includes/db_connection.php");
  require_once("../../includes/functions.php");

  verify_logged_in(array("administrator"));
  
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
  $receipt = $buyerData['id'];
	$pgsettings = array(
		"title" => "Buyer Receipt",
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
      <div class="container  receipt">

          <!--Responsive Table-->
          <div class="divider"></div>

            <h4 class="header printhide">BUYER</h4>
            <h5 class="header printhide"><?php echo $buyerData['first_name'] . " " . $buyerData['last_name']; ?></h5>
            <p><?php echo $buyerData['address_1'] . " " . $buyerData['address_2'] . ", " . $buyerData['city'] . ", " . $buyerData['state'] . " " . $buyerData['zip']; ?></p>

            <div class="row">
              <div class="col sheet s12">
                    <div class="row">
                      <div class="col s1">Lot</div>
                      <div class="col s2">Item</div>
                      <div class="col s1">Count</div>
                      <div class="col s1"></div>
                      <div class="col s2 right-align">Bid</div>
                    </div>
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
                                <div class="row" <?php if($bid['bid_amount'] < $itemData['asking']){echo "class=\"hide\"";} ?>>
                                   <div class="col s2">#<?php echo $itemData['lot']; ?></div>
                                   <div class="col s2"><?php echo $itemData['item']; ?></div>
                                   <div class="col s2"><?php echo $itemData['count']; ?>/<?php echo $itemData['unit_of_measure']; ?></div>
                                   <div class="col s1"><?php echo $itemData['origin_state']; ?></div>
                                   <!--<td>$<?php echo $itemData['asking']; ?></td>-->
                                   <div class="col s2 right-align" <?php if($bid['bid_amount'] < $itemData['asking']){echo "class=\"red-text\"";}else{echo "class=\"green-text\"";} ?>><?php echo "$".$bid['bid_amount']; ?></div>
                                 </div>
                                 <?php
                              }
                            }
                          }
                      ?>
                      <div class="receipt-footer bottom">
										<div class="row">
												<div class="col s2  offset-s3">Subtotal</div>
												<div class="col s2 right-align">$<?php echo number_format($subtotal, 2); ?></div>
										</div>
										<div class="row">
												<div class="col s1  offset-s3">Commission</div>
												<div class="col s1"><?php echo $buyerData['commission']; ?>%</div>
												<div class="col s2 right-align">$<?php echo number_format((($buyerData['commission']/100) * $subtotal), 2); ?></div>
										</div>
									<div class="row">
                      <div class="col s2 offset-s3"><span style="font-weight:bold;">Total Due</span></div>
                      <div class="col s2 right-align"><span style="font-weight:bold;">$<?php echo (($buyerData['commission']/100) + 1) * $subtotal; ?></span></div>
                  </div>
          </div>
        </div>
      </div>

    </section>
    <script>
    function PrintElem()
{
    Popup($html);
}

function Popup(data)
{
    var myWindow = window.open('', 'Receipt', 'height=400,width=600');
    myWindow.document.write('<html><head><title>Receipt</title>');
    /*optional stylesheet*/ //myWindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
    myWindow.document.write('<style type="text/css"> *, html {margin:0;padding:0;} </style>');
    myWindow.document.write('</head><body>');
    myWindow.document.write(data);
    myWindow.document.write('</body></html>');
    myWindow.document.close(); // necessary for IE >= 10

    myWindow.onload=function(){ // necessary if the div contain images

        myWindow.focus(); // necessary for IE >= 10
        myWindow.print();
        myWindow.close();
    };
}
    </script>
  <!-- END CONTENT -->
<?php


include '../../includes/end_html.php';


?>
