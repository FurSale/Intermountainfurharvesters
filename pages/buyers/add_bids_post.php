<?php
  require_once("../../includes/db_connection.php");
  require_once("../../includes/functions.php");

  if(!logged_in()){
    return array('success' => false, 'message' => "You must be logged in to do this");
  }

  	function process(){
	  	global $connection;
		//return($_POST['items']);

		//Loop through for validation
		foreach ($_POST['bids'] as $bid) {
			if($bid['buyer_id'] == ""){
				return array('success' => false, 'message' => "Buyer ID cannot be blank");
			}
			if($bid['lot'] == ""){
				return array('success' => false, 'message' => "Lot cannot be blank");
			}

			if($bid['bid_amount'] == "Custom"){
				return array('success' => false, 'message' => "Bid amount cannot be blank");
			}

			//Verify buyer exists
			$query="SELECT * FROM `buyer` WHERE `id`={$bid['buyer_id']}";
			$result=mysqli_query($connection, $query);
			//confirm_query($result);

			if(mysqli_num_rows($result) == 0){
				return array('success' => false, 'message' => "Seller doesn't exist");
			}

			//Verify lot exists
			$query="SELECT * FROM `seller_item` WHERE `lot`={$bid['lot']}";
			$result=mysqli_query($connection, $query);
			//confirm_query($result);

			if(mysqli_num_rows($result) == 0){
				return array('success' => false, 'message' => "Lot '".$bid['lot']."' doesn't exist");
			}
			$itemData = mysqli_fetch_array($result);
			if($itemData['sale_made']){
				return array('success' => false, 'message' => "Lot '".$bid['lot']."' has already sold");
			}
		}

		//Loop through for inserting into DB
		$numInserted = 0;
		$date = date("Y-m-d H:i:s");
		foreach ($_POST['bids'] as $bid) {
			//Safely escape all data in _POST
			$data = $bid;
			foreach ($data as $key => $value) {
				$data[$key] = mysqli_real_escape_string($connection, $value);
			}
			$query="SELECT * FROM `seller_item` WHERE `lot`={$data['lot']}";
			$result=mysqli_query($connection, $query);
			$itemData = mysqli_fetch_array($result);

			$query = "INSERT INTO `bid` (`buyer_id`, `seller_item_id`, `bid_amount`, `bid_status`, `date_created`) 
			VALUES ({$data['buyer_id']}, {$itemData['id']}, {$data['bid_amount']}, 'Confirmed', '{$date}')";
			$result=mysqli_query($connection, $query);
			if(mysqli_affected_rows($connection) != 1){
				return array('success' => false, 'message' => "Sorry, an error happened (". mysqli_error($connection).")");
			}

			$numInserted += 1;
		}

		return array('success' => true, 'message' => $numInserted." record(s) added");
  	}
  $result = process();
  if($result != null){
	header('Content-Type: application/json');
	echo json_encode($result);
  }else{
	header('Content-Type: application/json');
	echo json_encode(array('success' => false, 'message' => "Sorry, an error happened"));
  }