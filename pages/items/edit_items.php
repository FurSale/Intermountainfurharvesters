<?php
  require_once("../../includes/db_connection.php");
  require_once("../../includes/functions.php");

  $seller = null;
  if(isset($_GET['sellerId'])){
    $id = htmlspecialchars($_GET["sellerId"]);
    $query="SELECT * FROM `seller` WHERE `id`={$id}";
    $result=mysqli_query($connection, $query);
    //confirm_query($result);
    //Redirect to blog page if nothing returned from DB
    if(mysqli_num_rows($result) == 0){
      header("Location: list_items.php");
    }else{
      $seller=mysqli_fetch_array($result);
    }
  }else{
	header("Location: list_items.php");
  }

	$pgsettings = array(
		"title" => "Edit Items",
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
		  <div class="row">
			  <h4>Adding Items for <?php echo $seller['first_name'] . " " . $seller['last_name']; ?></h4>
	      </div>
		  <div class="row">
			  <span class="waves-effect waves-light btn" id="btn-add-row"><i class="material-icons left">add_box</i>Add Items</span>
			  <span class="waves-effect waves-light btn" id="btn-save">Save</span>
	      </div>
		  <form id="main-form" method="post">
			<div id="editor-rows">
				<div class="row">
				<input id="seller_id[]" name="seller_id[]" type="hidden" value="<?php echo $seller['id']; ?>">
					<div class="input-field col s2">
						<input name="lot[]" type="text" class="validate">
						<label>Lot</label>
					</div>
					<div class="input-field col s2">
					<select name="item[]">
						<?php echo echo_item_types(); ?>
					</select>
						<label>Item</label>
					</div>
					<div class="input-field col s2">
						<div style="display: inline;"><label><input name="unit_of_measure[]" type="radio" checked /><span>ct</span></label></div>
						<div style="display: inline;"><label><input name="unit_of_measure[]" type="radio" /><span>lbs</span></label></div>
					</div>
					<div class="input-field col s2">
						<input name="count[]" type="text" class="validate">
						<label>Qty</label>
					</div>
					<div class="input-field col s2">
						<input name="tag_id[]" type="text" class="validate">
						<label>Tag ID</label>
					</div>
					<div class="input-field col s2">
						<input name="asking[]" type="number" class="validate">
						<label>Asking $</label>
					</div>
				</div>
			</div>
		  </form>

</section>
<script>
	var _editorRow = $("#editor-rows").html();
	$(document).ready(function(){
		$( "#btn-add-row" ).click(function() {
			$("#editor-rows").append(_editorRow);
			$('#editor-rows select').formSelect();
		});
		$( "#btn-save" ).click(function() {
			console.log($("#main-form").serialize());
		});
	});
	</script>
<?php include '../../includes/end_html.php'; ?>
