<?php
	$pgsettings = array(
		"title" => "Items",
		"icon" => "icon-newspaper"
	);
	require_once("includes/begin_html.php");
?>
      <!--start container-->
      <div class="container">

          <!--Responsive Table-->
          <div class="divider"></div>
          <div id="responsive-table">
            <h4 class="header">Data sale</h4>
            <div class="row">
              <div class="col s12">
                <table class="responsive-table">
                  <thead>
                    <tr>
                      <th data-field="id">Lot</th>
                      <th data-field="name">Item</th>
                      <th data-field="email">Count</th>
                      <th data-field="address">Price</th>
                      <th data-field="address">High Bid</th>
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
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>

  <?php


  include 'includes\end_html.php';


  ?>
