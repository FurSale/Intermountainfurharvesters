<?php
require_once("../../includes/db_connection.php");
	$pgsettings = array(
		"title" => "Sellers",
		"icon" => "icon-newspaper"
	);
	require_once("../../includes/functions.php");
	require_once("../../includes/begin_html.php");
	require_once("../../includes/nav.php");
	require_once("../../includes/crumbs.php");
	 ?>
   <!-- START CONTENT -->
 <section id="content">
          <!--start container-->
          <div class="container">
              <!--Responsive Table-->
              <div id="responsive-table">
                <h4 class="header">Sellers</h4>
                <div class="row">
                  <div class="col s12">
                    <table class="responsive-table">
                      <thead>
                        <tr>
                          <th data-field="id">ID</th>
                          <th data-field="name">Name</th>
                          <th data-field="company">Company</th>
                          <th data-field="address">Address</th>
                          <th data-field="no">Phone</th>
                          <th data-field="age">Trapper</th>
                          <th data-field="action">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        	$query="SELECT * FROM `seller`";
                          $result=mysqli_query( $connection, $query);
                          //confirm_query($result);
                          while($seller=mysqli_fetch_array($result)){
                            ?>
                       <tr>
                          <td><?php echo $seller['id']; ?></td>
                          <td><?php echo $seller['first_name'] . " " . $seller['last_name']; ?></td>
                          <td><?php echo $seller['first_name'] . " " . $seller['last_name']; ?></td>
                          <td><?php echo $seller['address_1'] . " " . $seller['address_1'] . ", " . $seller['city'] . ", " . $seller['state'] . " " . $seller['zip']; ?></td>
                          <td><?php echo $seller['phone']; ?></td>
                          <td><?php echo $seller['trapper_id']; ?></td>
                          <td>
                            <a href="../items/edit_items.php?sellerId=<?php echo $seller['id']; ?>" class="waves-effect waves-light  btn"><i class="material-icons left">add_box</i>Add Items</a>
                              <a href="edit_sellers.php?id=<?php echo $seller['id']; ?>" class="waves-effect waves-light  btn"><i class="material-icons">edit</i></a>
                              <a class="waves-effect waves-light  btn"><i class="material-icons">delete</i></a>
                          </td>
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
          </div>
				</section>
				<!-- END WRAPPER -->
				</main>
				<?php
			  include '../../includes/footer.php';
			  include '../../includes/end_html.php';
			  ?>
