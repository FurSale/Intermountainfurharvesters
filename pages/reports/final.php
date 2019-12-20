<?php
  require_once("../../includes/db_connection.php");
	$pgsettings = array(
		"title" => "Buyers",
		"icon" => "icon-newspaper"
	);
	$nav = ("1");
	require_once("../../includes/functions.php");
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
<?php echo echo_cat(); ?>
</table>
        </div>
    </div>
  </main>
  <!-- END CONTENT -->
<?php


include '../../includes/end_html.php';


?>
