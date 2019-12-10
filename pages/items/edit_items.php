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

		  <form id="main-form" method="post">
			<div id="editor-rows">
				<div class="row">
				<input id="[0]seller_id" name="items[0][seller_id]" type="hidden" value="<?php echo $seller['id']; ?>">
					<div class="input-field col s2">
						<input name="items[0][lot]" type="text" class="validate">
						<label>Lot</label>
					</div>
					<div class="input-field col s2">
						<select name="items[0][item]" class="select-item">
							<?php echo echo_item_types(); ?>
						</select>
						<label>Item</label>
						<input name="items[0][item_custom]" type="text" class="validate item-custom" style="display:none;">
					</div>
					<div class="input-field col s2">
						<div style="display: inline;"><label><input name="items[0][unit_of_measure]" value="Count" type="radio" class="radio-count" checked /><span>ct</span></label></div>
						<div style="display: inline;"><label><input name="items[0][unit_of_measure]" Value="Lbs" type="radio" class="radio-lbs" /><span>lbs</span></label></div>
					</div>
					<div class="input-field col s1">
						<input name="items[0][count]" type="number" class="validate">
						<label>Qty</label>
					</div>
					<div class="input-field col s2">
						<input name="items[0][tag_id]" type="text" class="validate">
						<label>Tag ID</label>
					</div>
					<div class="input-field col s2">
						<select name="items[0][origin_state]">
							<?php echo echo_states(); ?>
						</select>
						<label>Origin State</label>
					</div>
					<div class="input-field col s1">
						<input name="items[0][asking]" type="number" class="validate">
						<label>Asking $</label>
					</div>
				</div>
			</div>
		  </form>
      <div class="row">
			  <span class="waves-effect waves-light btn" id="btn-add-row"><i class="material-icons left">add_box</i>Add Items</span>
			  <span class="waves-effect waves-light btn" id="btn-save">Save</span>
	      </div>
</section>
<script>
	var _editorRow = $("#editor-rows").html();
	var _rowIndex = 1;
	$(document).ready(function(){
		$( "#btn-add-row" ).click(function() {
			//Replace index
			var modified = _editorRow.toString().replace(/\[0\]/g, "["+_rowIndex+"]");
			$("#editor-rows").append(modified);
			//materialize
			$('#editor-rows select').formSelect();

			_rowIndex += 1;
		});
		$( "#btn-save" ).click(function() {
			$.ajax({
				type: "POST",
				url: "add_items_post.php",
				data: $("#main-form").serialize(),
				success: function(data){
					console.log(data);
					if(data.success){
						M.toast({html:data.message});
						$("#editor-rows").html(_editorRow);
						//materialize
						$('#editor-rows select').formSelect();
					}else{
						M.toast({html:data.message});
					}
					//console.log(JSON.parse(data));
				}
			});
		});
		$( "body" ).on("change", "select.select-item", function(e) {
			if($(this).val() == "Custom"){
				$(this).parents().eq(1).find("input.item-custom").css( "display", "block" );
			}else{
				$(this).parents().eq(1).find("input.item-custom").css( "display", "none" );
			}

			if($(this).val() == "Antlers" || $(this).val() == "Castor" ){
				$(this).parents().eq(2).find("input.radio-lbs").prop("checked", true);
			}
		});
	});
	</script>
<?php include '../../includes/end_html.php'; ?>
