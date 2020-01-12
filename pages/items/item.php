<?php
  require_once("../../includes/db_connection.php");
  require_once("../../includes/functions.php");

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
  <div class="col s1">Lot</div>
  <div class="col s4 offset-s1">Seller</div>
  <div class="col s4">Sold Status nosale/low/sold</div>
</div>
<div class="row">
  <div class="col s3"><input placeholder="Item" id="first_name" type="text" class="validate"></div>
  <div class="col s3"><input placeholder="Count" id="first_name" type="text" class="validate"></div>
  <div class="col s3"><input placeholder="Asking" id="first_name" type="text" class="validate"></div>
  <div class="col s3">Save</div>
</div>
<div class="row">
  <div class="col s2">Bids</div>
</div>
<div class="row">
  <div class="col s2">buyer_name</div>
  <div class="col s2">Price</div>
</div>
</section>
<?php include '../../includes/end_html.php'; ?>
