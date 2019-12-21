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
		foreach ($_POST['items'] as $item) {
			if($item['seller_id'] == ""){
				return array('success' => false, 'message' => "Seller ID cannot be blank");
			}
			if($item['lot'] == ""){
				return array('success' => false, 'message' => "Lot cannot be blank");
			}
			if(!isset($item['item']) || $item['item'] == ""){
				return array('success' => false, 'message' => "Item Type cannot be blank");
			}
			if($item['item'] == "Custom" && $item['item_custom'] == ""){
				return array('success' => false, 'message' => "Custom Item Type cannot be blank");
			}
			if($item['unit_of_measure'] == ""){
				return array('success' => false, 'message' => "Unit of Measure cannot be blank");
			}
			if($item['count'] == ""){
				return array('success' => false, 'message' => "Qty cannot be blank");
			}
			// if($item['tag_id'] == ""){
			// 	return array('success' => false, 'message' => "Tag ID cannot be blank");
			// }
			if(!isset($item['item']) || $item['origin_state'] == ""){
				return array('success' => false, 'message' => "Origin State cannot be blank");
			}
			if($item['asking'] == ""){
				return array('success' => false, 'message' => "Asking Price cannot be blank");
			}

			//Verify seller exists
			$query="SELECT * FROM `seller` WHERE `id`={$item['seller_id']}";
			$result=mysqli_query($connection, $query);
			//confirm_query($result);

			if(mysqli_num_rows($result) == 0){
				return array('success' => false, 'message' => "Seller doesn't exist");
			}

			//Verify lot is unique
			$query="SELECT * FROM `seller_item` WHERE `lot`={$item['lot']}";
			$result=mysqli_query($connection, $query);
			//confirm_query($result);

			if(mysqli_num_rows($result) > 0){
				return array('success' => false, 'message' => "Lot ".$item['lot']." already exists");
			}
		}

		//Loop through for inserting into DB
		$numInserted = 0;
		$date = date("Y-m-d H:i:s");
		foreach ($_POST['items'] as $item) {
			//Safely escape all data in _POST
			$data = $item;
			foreach ($data as $key => $value) {
				$data[$key] = mysqli_real_escape_string($connection, $value);
			}
			//Set the custom item type if custom
			if($data['item'] == "Custom"){
				$data['item'] = $data['item_custom'];
			}
			$query = "INSERT INTO `seller_item` (`seller_id`, `lot`, `item`, `unit_of_measure`, `count`, `origin_state`, `asking`, `bid_start`, `bid_end`, `date_created`) 
			VALUES ('{$data['seller_id']}', '{$data['lot']}', '{$data['item']}', '{$data['unit_of_measure']}', {$data['count']}, '{$data['origin_state']}', {$data['asking']}, '{$date}', '{$date}', '{$date}')";
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