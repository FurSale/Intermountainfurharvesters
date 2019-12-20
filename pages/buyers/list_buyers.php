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

  $searchName = null;
  $buyerQuery = "SELECT * FROM `buyer`";
  if(isset($_GET['name'])){
    $searchName = urldecode($_GET['name']);
    $searchName = mysqli_real_escape_string($connection, $searchName);
    $buyerQuery = "SELECT * FROM (
      SELECT *, CONCAT(first_name, ' ', last_name) as firstlast
      FROM `buyer`) base
    WHERE firstLast LIKE '%{$searchName}%'";
  }

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
                  <div class="row">
                    <div class="input-field col s4 offset-s4">
                      <input placeholder="Name" id="search-query" type="text" value="<?php echo $searchName; ?>">
                      <label for="search-query">Name</label>
                    </div>
                    <div class=" col s1">
                      <button class="waves-effect waves-light btn-small" id="btn-search"><i class="material-icons left">search</i>Search</button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col s12">
                      <table class="responsive-table">
                        <thead>
                          <tr>
                            <th data-field="id">ID</th>
                            <th data-field="name">Name</th>
                            <th data-field="company">Company</th>
                            <th data-field="phone">Phone</th>
                            <th data-field="license">License</th>
                            <th data-field="action">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                          $result=mysqli_query( $connection, $buyerQuery);
                          confirm_query($result);
                          while($buyer=mysqli_fetch_array($result)){
                            ?>
                       <tr>
                          <td><?php echo $buyer['id']; ?></td>
                          <td><?php echo $buyer['first_name'] . " " . $buyer['last_name']; ?></td>
                          <td><?php echo $buyer['company_name']; ?></td>
                          <td><?php echo $buyer['phone']; ?></td>
                          <td><?php echo $buyer['fur_buyer_license_num']; ?></td>
                          <td>
                            <a href="edit_buyers.php?id=<?php echo $buyer['id']; ?>" class="waves-effect waves-light  btn-small"><i class="material-icons">edit</i></a>
                            <a href="edit_buyers.php?id=<?php echo $buyer['id']; ?>" class="waves-effect waves-light  btn-small red"><i class="material-icons">delete</i></a>
                            <a href="receipt.php?id=<?php echo $buyer['id']; ?>" class="waves-effect waves-light  btn-small blue"><i class="material-icons">receipt</i></a>
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
            </section>
            <script>
              $(document).ready(function(){
                $( "body" ).on("click", "#btn-search", function(e) {
                  NavigateSearch();
                });
                $( "body" ).on("keypress", "#search-query", function(e) {
                  if(e.which == 13) {
                    NavigateSearch();
                  }
                });
                function NavigateSearch(){
                  var url = window.location.protocol + "//" + window.location.host + window.location.pathname;
                  var query = $("#search-query").val();
                  var newUrl = url + "?name=" + encodeURI(query);
                  window.location.href = newUrl;
                }
              });
              </script>
            <!-- END WRAPPER -->
            </main>

            <?php
            include '../../includes/footer.php';
            include '../../includes/end_html.php';
            ?>
