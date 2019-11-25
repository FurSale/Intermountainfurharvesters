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

          <!--Responsive Table-->
          <div class="divider"></div>
          <div id="responsive-table">
            <h4 class="header">Data Buyers</h4>
            <div class="row">
              <div class="col s12">
                <table class="responsive-table">
                  <thead>
                    <tr>
                      <th data-field="id">ID Detail</th>
                      <th data-field="name">Item</th>
                      <th data-field="jumlah">Count</th>
                      <th data-field="harga">Price</th>
                      <th data-field="subtotal">Bid</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>2001</td>
                      <td>Coyote</td>
                      <td>16</td>
                      <td>$12</td>
                      <td class="green-text">$127</td>

                    </tr>
                    <tr>
                      <td>2003</td>
                      <td>Coyote</td>
                      <td>1</td>
                      <td>$34</td>
                      <td class="red-text">$23</td>

                    </tr>
                    <tr>
                      <td>2007</td>
                      <td>Coyote</td>
                      <td>8</td>
                      <td>$56</td>
                      <td class="green-text">$123</td>
                    </tr>
                    <tr>
                      <td>2015</td>
                      <td>Bobcat</td>
                      <td>102</td>
                      <td>$78</td>
                      <td class="red-text">$12</td>
                    </tr>
										<tr>
												<td></td>
												<td></td>
												<td>Subtotal</td>
												<td></td>
												<td>$285</td>
										</tr>
										<tr>
												<td></td>
												<td></td>
												<td>Commission</td>
												<td>6%</td>
												<td>$17</td>
										</tr>
									<tr>
                      <td></td>
                      <td></td>
                      <td>Total Due</td>
                      <td></td>
                      <td>$302</td>
                  </tr>
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- END CONTENT -->
<?php


include '../../includes/end_html.php';


?>
