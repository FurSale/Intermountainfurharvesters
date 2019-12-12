<?php
  require_once("../../includes/db_connection.php");
	$pgsettings = array(
		"title" => "Buyers",
		"icon" => "icon-newspaper"
	);
	$nav = ("1");
  require_once("../../includes/functions.php");
  if(!logged_in()){
    header("Location: ../login.php");
  }
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
                <!--Responsive Table-->
                <div id="responsive-table">
                  <h4 class="header">Buyers</h4>
                  <div class="row">
                    <div class="col s12">
                      <table class="responsive-table">
                        <thead>
                          <tr>
                            <th data-field="id">ID</th>
                            <th data-field="name">Buyer</th>
                            <th data-field="company">Company</th>
                            <th data-field="address">Address</th>
                            <th data-field="phone">Phone</th>
                            <th data-field="license">License</th>
                            <th data-field="commission">Commission</th>
                            <th data-field="total">Total</th>
                            <th data-field="status">Detail</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        	$query="SELECT * FROM `buyer`";
                          $result=mysqli_query( $connection, $query);
                          //confirm_query($result);
                          while($buyer=mysqli_fetch_array($result)){
                            ?>
                       <tr>
                          <td><?php echo $buyer['id']; ?></td>
                          <td><?php echo $buyer['first_name'] . " " . $buyer['last_name']; ?></td>
                          <td><?php echo $buyer['company_name']; ?></td>
                          <td><?php echo $buyer['address_1'] . " " . $buyer['address_2'] . ", " . $buyer['city'] . ", " . $buyer['state'] . " " . $buyer['zip']; ?></td>
                          <td><?php echo $buyer['phone']; ?></td>
                          <td><?php echo $buyer['fur_buyer_license_num']; ?></td>
                          <td><?php echo $buyer['commission']; ?>%</td>
                          <td></td>
                          <td><a href="edit_buyers.php?id=<?php echo $buyer['id']; ?>" class="waves-effect waves-light  btn-small"><i class="material-icons left">developer_board</i> Detail</a></td>
                        </tr>
                        <?php
                          }
                      ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <!-- END WRAPPER -->
            </main>

            <?php
            include '../../includes/footer.php';
            include '../../includes/end_html.php';
            ?>
