<?php
	$pgsettings = array(
		"title" => "Buyers",
		"icon" => "icon-newspaper"
	);
	require_once("../../includes/begin_html.php");
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
                  <div class="row">
                      <div class="container">
                        <div class="col s12 m12 l12">
                          <a class="waves-effect waves-light  btn"><i class="material-icons left">add</i> Add Data</a>
                          <a class="btn dropdown-settings waves-effect waves-teal breadcrumbs-btn" href="#!" data-activates="dropdown2">
                              <i class="material-icons hide-on-med-and-up">settings</i>
                              <span class="hide-on-small-onl">Export</span>
                              <i class="material-icons right">arrow_drop_down</i>
                            </a>
                          <ul id="dropdown2" class="dropdown-content">
                            <li><a href="#!" class="grey-text text-darken-2">PDF</a>
                            </li>
                            <li><a href="#!" class="grey-text text-darken-2">WORD</a>
                            </li>
                            <li><a href="#!" class="grey-text text-darken-2">EXCEL</a>
                            </li>
                          </ul>
                        </div>
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
                            <th data-field="total">Total</th>
                            <th data-field="status">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>TRF001</td>
                            <td>Alfin</td>
                            <td>$17544</td>
                            <td>Final</td>
                            <td><a href="detail.html" class="waves-effect waves-light  btn-small"><i class="material-icons left">developer_board</i> Detail</a></td>
                          </tr>
                          <tr>
                            <td>TRF002</td>
                            <td>Rahma</td>
                            <td>$234</td>
                            <td>Empty</td>
                            <td><a href="detail.html" class="waves-effect waves-light  btn-small"><i class="material-icons left">developer_board</i> Detail</a></td>
                          </tr>
                          <tr>
                              <td>TRF003</td>
                              <td>Maulana</td>
                              <td>$5376</td>
                              <td>Final</td>
                              <td><a href="detail.html" class="waves-effect waves-light  btn-small"><i class="material-icons left">developer_board</i> Detail</a></td>
                          </tr>
                          <tr>
                              <td>TRF004</td>
                              <td>Alfin</td>
                              <td>$1000/td>
                              <td>Editing</td>
                              <td><a href="detail.html" class="waves-effect waves-light  btn-small"><i class="material-icons left">developer_board</i> Detail</a></td>
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


    include '../../includes/end_html.php';


    ?>