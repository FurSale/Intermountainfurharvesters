<?php


include 'includes\begin_html.php';


?>
      <section id="content">
            <!--breadcrumbs start-->
            <div id="breadcrumbs-wrapper">
              <!-- Search for small screen -->
              <div class="header-search-wrapper grey lighten-2 hide-on-large-only">
                <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
              </div>
              <div class="container">
                <div class="row">
                  <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title">Data Tables</h5>
                    <ol class="breadcrumbs">

                      <li><a href="#">Data</a></li>
                      <li class="active">Buyers</li>
                    </ol>
                  </div>
                  <div class="col s2 m6 l6">
                    <a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="#!" data-activates="dropdown1">
                        <i class="material-icons hide-on-med-and-up">settings</i>
                        <span class="hide-on-small-onl">Sory By</span>
                        <i class="material-icons right">arrow_drop_down</i>
                      </a>
                    <ul id="dropdown1" class="dropdown-content">
                      <li><a href="#!" class="grey-text text-darken-2">Status<span class="badge">1</span></a>
                      </li>
                      <li><a href="#!" class="grey-text text-darken-2">Admin<span class="new badge">2</span></a>
                      </li>
                      <li><a href="#!" class="grey-text text-darken-2">ALL</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!--breadcrumbs end-->
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
        <!-- END CONTENT -->
      </div>
      <!-- END WRAPPER -->
    </div>
    <!-- END MAIN -->
    <?php


    include 'includes\end_html.php';


    ?>
