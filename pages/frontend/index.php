<?php
  require_once("../../includes/db_connection.php");
  require_once("../../includes/functions.php");

  verify_logged_in(array("buyer"));

  $bid['buyer_id'] = null;
  $bid['seller_item_id'] = null;
  $bid['bid_amount'] = null;
  $bid['lot'] = null;

  function AddBid()
  {
      global $connection;
      //Safely escape all data in _POST
      $data = $_POST;
      foreach ($data as $key => $value) {
          $data[$key] = mysqli_real_escape_string($connection, $value);
      }

      if ($data['lot'] == "") {
          return array('success' => false, 'message' => "Lot cannot be blank");
      }
      if ($data['bid_amount'] == "") {
          return array('success' => false, 'message' => "Bid Amount cannot be blank");
      }

      $date = date("Y-m-d H:i:s");

      $query = "SELECT * FROM `seller_item` WHERE `lot` = {$data['lot']}";
      $result = mysqli_query($connection, $query);
      if (mysqli_num_rows($result)!=1) {
          $bid = $data;
          return array('success' => false, 'message' => "Lot \"".$data['lot']."\" doesn\\'t exist");
      }
      $item = mysqli_fetch_array($result);
      if ($item['sale_made']) {
          return array('success' => false, 'message' => "This item has already been sold");
      }
      $query = "INSERT INTO `bid` (`buyer_id`, `seller_item_id`, `bid_amount`, `bid_status`, `date_created`)
    VALUES ({$_SESSION['username']}, {$item['id']}, {$data['bid_amount']}, 'Unconfirmed', '{$date}')";
      $result = mysqli_query($connection, $query);
      confirm_query($result);
      if (mysqli_affected_rows($connection) == 1) {
          return array('success' => true, 'message' => "Bid added");
      } else {
          $bid = $data;
          return array('success' => false, 'message' => "Couldn't update" . "<br />" . mysqli_error($connection));
      }
  }

  function EditBid()
  {
      global $connection;
      //Safely escape all data in _POST
      $data = $_POST;
      foreach ($data as $key => $value) {
          $data[$key] = mysqli_real_escape_string($connection, $value);
      }

      if ($data['id'] == "") {
          return array('success' => false, 'message' => "ID cannot be blank");
      }
      if ($data['bid_amount'] == "") {
          return array('success' => false, 'message' => "Bid Amount cannot be blank");
      }

      $query = "UPDATE `bid` SET
    `bid_amount` = {$data['bid_amount']} WHERE `id` = {$data['id']}";
      $result = mysqli_query($connection, $query);
      confirm_query($result);
      if (mysqli_affected_rows($connection) == 1) {
          return array('success' => true, 'message' => "Bid updated");
      } else {
          return array('success' => false, 'message' => "Couldn't update" . "<br />" . mysqli_error($connection));
      }
  }

  function DeleteBid()
  {
      global $connection;
      $id = mysqli_real_escape_string($connection, $_GET['deleteID']);

      $query = "SELECT * FROM `bid` WHERE `id` = {$id}";
      $result = mysqli_query($connection, $query);
      confirm_query($result);
      if (mysqli_num_rows($result)!=1) {
          return array('success' => false, 'message' => null);
      }

      $bidData = mysqli_fetch_array($result);
      //Make sure the bid is this user's and it is not finalized
      if ($bidData['buyer_id'] == $_SESSION['username'] && $bidData['bid_status'] == "Unconfirmed") {
          $query = "DELETE FROM `bid` WHERE `id` = {$id}";
          $result = mysqli_query($connection, $query);
          confirm_query($result);
          if (mysqli_affected_rows($connection) == 1) {
              return array('success' => true, 'message' => "Bid deleted");
          } else {
              return array('success' => false, 'message' => "Couldn't update" . "<br />" . mysqli_error($connection));
          }
      } else {
          return array('success' => false, 'message' => "Cannot delete this bid");
      }
  }

  if (isset($_POST['add'])) {
      $result = AddBid();
      if ($result['success']) {
          $success = $result['message'];
      } else {
          $error = $result['message'];
      }
  }

  if (isset($_POST['edit'])) {
      $result = EditBid();
      if ($result['success']) {
          $success = $result['message'];
      } else {
          $error = $result['message'];
      }
  }

  if (isset($_GET['deleteID'])) {
      $result = DeleteBid();
      if ($result['success']) {
          $success = $result['message'];
      } else {
          $error = $result['message'];
      }
  }

  if (isset($_POST['confirm'])) {
      //Safely escape all data in _POST
      $data = $_POST;
      foreach ($data as $key => $value) {
          $data[$key] = mysqli_real_escape_string($connection, $value);
      }

      $cutoffDays = $GLOBALS['site_info']['bid_cutoff_days'];
      $cutoffDate = date("Y-m-d H:i:s", strtotime('-'.$cutoffDays.' days', time()));
      $query = "UPDATE `bid` SET
    `bid_status` = 'Confirmed' WHERE `buyer_id` = {$_SESSION['username']} AND `bid_status` = 'Unconfirmed' AND `date_created` > '{$cutoffDate}'";
      $result = mysqli_query($connection, $query);
      confirm_query($result);
      if (mysqli_affected_rows($connection) >= 1) {
          $success = "Bids confirmed";
      } else {
          $error = "Couldn't update";
          $error .= "<br />" . mysqli_error($connection);
          $buyer = $data;
      }
  }

    $pgsettings = array(
        "title" => "Buyers",
        "icon" => "icon-newspaper"
    );
    $nav = ("1");

    require_once("../../includes/begin_html.php");


     ?>

   <div class="container">
      <section id="content" class="">
      <div class="col 12">
        <h1><?php echo $GLOBALS['site_info']['site_name']; ?></h1>
      </div>
        <form method="post" action="index.php" id="form-add">
          <input type="hidden" name="add" value="add" />
            <div class='row'>
              <div class='input-field col s12'>
                <input style="height:6rem; font-size:32px;" placeholder="Lot" class='validate white-text' type='text' name='lot' id='lot' value="<?php echo $bid['lot']; ?>" pattern="\d*"/>

              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input placeholder="Bid" class='validate white-text' name='bid_amount' id='bid_amount' value="<?php echo $bid['bid_amount']; ?>" pattern="\d*"/>

              </div>
            </div>
            <br />
              <div class='row center'>
                <button id="btn-add" class='col s12 btn btn-large waves-effect indigo'>Place Bid</button>
              </div>
          </form>
        </section>
        <!-- END WRAPPER -->
</div>
        <div class="app-bar-bottom">
<a class="btn-floating-center waves-effect waves-light red modal-trigger" href="#modal1"><i class="material-icons">expand_less</i></a>
</div>
</main>
  <div id="modal1" class="modal bottom-sheet blue-grey darken-2 black-text">
         <div class="modal-content">
           <ul class="collection with-header">
        <li class="collection-header"><h4>Bids</h4></li>
        <?php
            $cutoffDays = $GLOBALS['site_info']['bid_cutoff_days'];
            $cutoffDate = date("Y-m-d H:i:s", strtotime('-'.$cutoffDays.' days', time()));
            $query="SELECT * FROM `bid` WHERE `buyer_id` = {$_SESSION['username']} AND `bid_status` = 'Unconfirmed' AND `date_created` > '{$cutoffDate}'";
            $result=mysqli_query($connection, $query);
            //confirm_query($result);
            while ($bidData=mysqli_fetch_array($result)) {
                $query="SELECT * FROM `seller_item` WHERE `id` = '{$bidData['seller_item_id']}'";
                $result2=mysqli_query($connection, $query);
                confirm_query($result2);
                $item = mysqli_fetch_array($result2); ?>
                <li class="collection-item">
                  <div class="row">
                    <div class="col s2">#<?php echo $item['lot']; ?></div>
                    <div class="col s2">#<?php echo $item['item']; ?></div>
                    <div class="col s2"><?php echo $item['count']." ".$item['unit_of_measure']; ?></div>
                    <div class="col s2"><?php echo $item['item']; ?></div>
                    <form method="post" action="index.php" class="form-edit">
                      <input type="hidden" name="edit" value="edit" />
                      <input type="hidden" name="id" value="<?php echo $bidData['id']; ?>" />
                      <div class="col s2">
                        <!-- <span style="display:inline-block;">&#36;</span> -->
                        <input value="<?php echo $bidData['bid_amount']; ?>" name="bid_amount" type="number" class="validate text-bid-amount" disabled>
                      </div>
                      <div class="col s2">
                        <button class="btn waves-effect waves-light blue btn-swap">Edit</button>
                        <button class="btn waves-effect waves-light green hide btn-send-bid">Save</button>
                      </div>
                    </form>
                    <div class="col s2"><a href="index.php?deleteID=<?php echo $bidData['id']; ?>" class="btn waves-effect waves-light red" id="deletebid1"><i class="material-icons">close</i></a></div>
                    </div>
                </li>
          <?php
            }
        ?>
        <?php
            $cutoffDays = $GLOBALS['site_info']['bid_cutoff_days'];
            $cutoffDate = date("Y-m-d H:i:s", strtotime('-'.$cutoffDays.' days', time()));
            $query="SELECT * FROM `bid` WHERE `buyer_id` = {$_SESSION['username']} AND `bid_status` = 'Confirmed' AND `date_created` > '{$cutoffDate}'";
            $result=mysqli_query($connection, $query);
            //confirm_query($result);
            while ($bidData=mysqli_fetch_array($result)) {
                $query="SELECT * FROM `seller_item` WHERE `id` = '{$bidData['seller_item_id']}'";
                $result2=mysqli_query($connection, $query);
                confirm_query($result2);
                $item = mysqli_fetch_array($result2); ?>
                <li class="collection-item" style="background-color:#cccccc;">
                  <div class="row">
                    <div class="col s2">#<?php echo $item['lot']; ?></div>
                    <div class="col s2"><?php echo $item['count']." ".$item['unit_of_measure']; ?></div>
                    <div class="col s2"><?php echo $item['item']; ?></div>
                    <div class="col s2">$<?php echo $bidData['bid_amount']; ?></div>
                    <div class="col s2"></div>
                    </div>
                </li>
          <?php
            }
        ?>

</ul>
<a class="waves-effect waves-light btn modal-trigger" href="#modal2">Confirm Bids</a>
</div>
<!-- Modal Structure -->
<div id="modal2" class="modal">
  <div class="modal-content">
    <h4>Are you Sure?</h4>
    <p>This is the Final Submission</p>
  </div>
  <div class="modal-footer">
    <form method="post" action="index.php" id="form-confirm">
      <input type="hidden" name="confirm" value="confirm" />
      <button class="btn waves-effect waves-light btn-confirm">Submit
        <i class="material-icons right">send</i>
      </button>
    </form>
  </div>
</div>
         </div>
       </div>
  <script>
	$(document).ready(function(){
		$( "body" ).on("click", "#btn-add", function(e) {
      //Prevent form submission via button
      e.preventDefault();
      $("#form-add").submit();
		});

		$( "body" ).on("click", ".btn-send-bid", function(e) {
      //Prevent form submission via button
      e.preventDefault();
      $(this).parents().eq(2).find("form.form-edit").submit();
		});

    $( "body" ).on("click", "#btn-confirm", function(e) {
      //Prevent form submission via button
      e.preventDefault();
      $("#form-confirm").submit();
		});

		$( "body" ).on("click", ".btn-swap", function(e) {
      //Prevent form submission via button
      e.preventDefault();
      //Hide edit btn
			$(this).parents().eq(1).find("button.btn-swap").addClass( "hide" );
      //Show save btn
      $(this).parents().eq(1).find("button.btn-send-bid").removeClass( "hide" );
      //Enable textbox
      $(this).parents().eq(2).find("input.text-bid-amount").prop( "disabled", false );
		});
	});
	</script>
<?php
    require_once("../../includes/end_html.php");
     ?>
