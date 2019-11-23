<?php
	$pgsettings = array(
		"title" => "Details",
		"icon" => "icon-newspaper"
	);
	require_once("../includes/begin_html.php");
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
                      <td>TOTAL</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>$285</td>
                  </tr>
                  </tbody>
                </table>
                <div class="col s12 m12 l12">
                    <br/>
                    <a class="waves-effect waves-light  btn right"><i class="material-icons left">send</i> Export</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END CONTENT -->
<?php


include '../includes/end_html.php';


?>
