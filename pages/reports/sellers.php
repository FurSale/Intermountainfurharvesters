<?php
require_once("../../includes/db_connection.php");
	$pgsettings = array(
		"title" => "Sellers",
		"icon" => "icon-newspaper"
	);
  require_once("../../includes/functions.php");
  
  verify_logged_in(array("administrator"));

  function Delete(){
    global $connection;
    $id = mysqli_real_escape_string($connection, $_GET['deleteID']);

    $query = "SELECT * FROM `seller` WHERE `id` = {$id}";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    if (mysqli_num_rows($result)!=1){
      return array('success' => false, 'message' => "Seller does not exist to delete");
    }
    $sellerData = mysqli_fetch_array($result);

    //Delete all the bids under the items
    $query = "SELECT * FROM `seller_item` WHERE `seller_id` = {$id}";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    while($sellerItem=mysqli_fetch_array($result)){
      $query = "DELETE FROM `bid` WHERE `seller_item_id` = {$sellerItem['id']}";
      $result2 = mysqli_query($connection, $query);
      confirm_query($result2);
    }

    //Delete the items
    $query = "DELETE FROM `seller_item` WHERE `seller_id` = {$sellerData['id']}";
    $result = mysqli_query($connection, $query);
    confirm_query($result);

    //Delete the seller
    $query = "DELETE FROM `seller` WHERE `id` = {$sellerData['id']}";
    $result = mysqli_query($connection, $query);
    confirm_query($result);

    if (mysqli_affected_rows($connection) == 1) {
      return array('success' => true, 'message' => "Item {$sellerData['first_name']} deleted");
    }
    return array('success' => false, 'message' => "Couldn't update" . "<br />" . mysqli_error($connection));
  }

  if(isset($_GET['deleteID'])){
    $result = Delete();
    if($result['success']){
      $success = $result['message'];
    }else{
      $error = $result['message'];
    }
  }

	require_once("../../includes/begin_html.php");
	require_once("../../includes/nav.php");
  require_once("../../includes/crumbs.php");

  $searchName = null;
  $sellerQuery = "SELECT * FROM `seller` ORDER BY `last_name` ASC";
  if(isset($_GET['name'])){
    $searchName = urldecode($_GET['name']);
    $searchName = mysqli_real_escape_string($connection, $searchName);
    $sellerQuery = "SELECT * FROM (
      SELECT *, CONCAT(first_name, ' ', last_name) as firstlast
      FROM `seller` ORDER BY `last_name` ASC) base
    WHERE firstLast LIKE '%{$searchName}%'";
  }

	 ?>
   <!-- START CONTENT -->
 <section id="content" class="print">
          <!--start container-->
          <div class="container">
              <!--Responsive Table-->
              <div id="responsive-table">
                <h4 class="header">Sellers</h4>
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
                          <th data-field="trapper">Trapper</th>
                          <th data-field="action">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                          $result=mysqli_query( $connection, $sellerQuery);
                          confirm_query($result);
                          while($seller=mysqli_fetch_array($result)){
                            ?>
                       <tr>
                          <td><?php echo $seller['id']; ?></td>
                          <td><?php echo $seller['last_name'] . ", " . $seller['first_name']; ?></td>
                          <td><?php echo $seller['first_name'] . " " . $seller['last_name']; ?></td>
                          <td><?php echo $seller['phone']; ?></td>
                          <td><?php echo $seller['trapper_id']; ?></td>
                          <td>
                            <!-- <a href="../items/edit_items.php?sellerId=<?php echo $seller['id']; ?>" class="waves-effect waves-light  btn-small"><i class="material-icons">add_box</i></a> -->
                              <a href="edit_sellers.php?id=<?php echo $seller['id']; ?>" class="waves-effect waves-light  btn-small"><i class="material-icons">edit</i></a>
															<a href="receipt.php?id=<?php echo $seller['id']; ?>" class="waves-effect waves-light  btn-small blue"><i class="material-icons">receipt</i></a>
															<a href="list_sellers.php?deleteID=<?php echo $seller['id']; ?>" class="waves-effect waves-light red btn-small"><i class="material-icons">delete</i></a>
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
