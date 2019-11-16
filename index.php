<?php


include 'includes\begin_html.php';


?>
      <!-- START CONTENT -->
    <section id="content">
          <!--breadcrumbs start-->
          <div id="breadcrumbs-wrapper">
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey lighten-2 hide-on-large-only">
              <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Search">
            </div>
            <div class="container">
              <div class="row">
                <div class="col s10 m6 l6">
                  <h5 class="breadcrumbs-title">Data Tables</h5>
                  <ol class="breadcrumbs">

                    <li><a href="#">Data</a></li>
                    <li class="active">Sellers</li>
                  </ol>
                </div>
                <div class="col s2 m6 l6">
                  <a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="#!" data-activates="dropdown1">
                      <i class="material-icons hide-on-med-and-up">settings</i>
                      <span class="hide-on-small-onl">Sort By</span>
                      <i class="material-icons right">arrow_drop_down</i>
                    </a>
                  <ul id="dropdown1" class="dropdown-content">
                    <li><a href="#!" class="grey-text text-darken-2">ALL<span class="new badge">25</span></a>
                    </li>
                    <li><a href="#!" class="grey-text text-darken-2">Name<span class="badge">2</span></a>
                    </li>
                    <li><a href="#!" class="grey-text text-darken-2">Address</a>
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
                      <div class="col s12">
                          <a class="waves-effect waves-light  btn"><i class="material-icons left">add</i> Add Data</a>
                      </div>
                      </div>
                  </div>
              </div>
          </div>

              <!--Responsive Table-->
              <div class="divider"></div>
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

                        <tr>
                          <td><a href="https://www.w3schools.com">S01</a></td>
                          <td>Alfin</td>
                          <td></td>
                          <td>Surakarta, Central Java</td>
                          <td>+62 8190 4073 250</td>
                          <td>21</td>
                          <td>
                            <a class="waves-effect waves-light  btn"><i class="material-icons left">add_box</i>Add Items</a>
                              <a class="waves-effect waves-light  btn"><i class="material-icons">edit</i></a>
                              <a class="waves-effect waves-light  btn"><i class="material-icons">delete</i></a>
                          </td>
                        </tr>

                      <a href="https://www.w3schools.com">
                        <tr>
                          <td>S02</td>
                          <td>Maulana</td>
                          <td></td>
                          <td>Boyolali, Central Java</td>
                          <td>+62 8944 9112 095</td>
                          <td>17</td>
                          <td>
                            <a class="waves-effect waves-light  btn"><i class="material-icons left">add_box</i>Add Items</a>
                              <a class="waves-effect waves-light  btn"><i class="material-icons">edit</i></a>
                              <a class="waves-effect waves-light  btn"><i class="material-icons">delete</i></a>
                          </td>
                        </tr>
                      </a>
                      <a href="https://www.w3schools.com">
                        <tr>
                          <td>S03</td>
                          <td>Citra</td>
                          <td></td>
                          <td>Jakarta, West Java</td>
                          <td>+62 8572 6534 114</td>
                          <td>34</td>
                          <td>
                            <a class="waves-effect waves-light  btn"><i class="material-icons left">add_box</i>Add Items</a>
                              <a class="waves-effect waves-light  btn"><i class="material-icons">edit</i></a>
                              <a class="waves-effect waves-light  btn"><i class="material-icons">delete</i></a>
                          </td>
                        </tr>
                      </a>

                        <tr>
                          <td>S04</td>
                          <td>Rahma</td>
                          <td></td>
                          <td>Surabaya, East Java</td>
                          <td>+62 8555 4145 279</td>
                          <td>28</td>
                          <td>
                            <a class="waves-effect waves-light  btn"><i class="material-icons left">add_box</i>Add Items</a>
                              <a class="waves-effect waves-light  btn"><i class="material-icons">edit</i></a>
                              <a class="waves-effect waves-light  btn"><i class="material-icons">delete</i></a>
                          </td>
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
