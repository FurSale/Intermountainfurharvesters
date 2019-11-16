<?php
	$pgsettings = array(
		"title" => "Sellers",
		"icon" => "icon-newspaper"
	);
	require_once("includes/begin_html.php");
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
                      <div class="col s12">
                          <a href="edit_sellers.php?action=newseller" class="waves-effect waves-light  btn"><i class="material-icons left">add</i> Add Seller</a>
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
