<?php
	$pgsettings = array(
		"title" => "Buyers",
		"icon" => "icon-newspaper"
	);
	require_once("../../includes/functions.php");
	require_multi("../../includes/begin_html.php", "../../includes/crumbs.php", "../../includes/nav.php");
	 ?>
            <!--start container-->
            <div class="container">
              <div class="section">
                <div class="row">
                  <div class="col s12">
                      <div class="input-field col s12">
                          <i class="material-icons prefix">search</i>
                          <input type="text" name="Search" placeholder="Search" />
                      </div>
                  </div>
              </div>
          </div>

                <!--Responsive Table-->
                <div class="divider"></div>
                <div id="responsive-table">
                  <h4 class="header">Data Buyers</h4>
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
                            <th data-field="total">Total</th>
                            <th data-field="status">Status</th>
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
                          <td><?php echo $buyer['first_name'] . " " . $buyer['last_name']; ?></td>
                          <td><?php echo $buyer['address_1'] . " " . $buyer['address_1'] . ", " . $buyer['city'] . ", " . $buyer['state'] . " " . $buyer['zip']; ?></td>
                          <td><?php echo $buyer['phone']; ?></td>
                          <td><?php echo $buyer['fur_buyer_license_num']; ?></td>
                          <td></td>
                          <td><a href="detail.html" class="waves-effect waves-light  btn-small"><i class="material-icons left">developer_board</i> Detail</a></td>
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

    <?php


    include '../../includes/end_html.php';


    ?>
