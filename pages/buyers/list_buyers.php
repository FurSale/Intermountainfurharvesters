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

  function Delete(){
    global $connection;
    $id = mysqli_real_escape_string($connection, $_GET['deleteID']);

    $query = "SELECT * FROM `buyer` WHERE `id` = {$id}";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    if (mysqli_num_rows($result)!=1){
      return array('success' => false, 'message' => "Buyer does not exist to delete");
    }
    $buyerData = mysqli_fetch_array($result);

    //Delete all the bids under the buyer
    $query = "DELETE FROM `bid` WHERE `buyer_id` = {$buyerData['id']}";
    $result = mysqli_query($connection, $query);
    confirm_query($result);

    //Delete the buyer login
    $query = "DELETE FROM `user` WHERE `username` = '{$buyerData['id']}'";
    $result = mysqli_query($connection, $query);
    confirm_query($result);

    //Delete the buyer
    $query = "DELETE FROM `buyer` WHERE `id` = {$buyerData['id']}";
    $result = mysqli_query($connection, $query);
    confirm_query($result);

    if (mysqli_affected_rows($connection) == 1) {
      return array('success' => true, 'message' => "Buyer {$buyerData['first_name']} deleted");
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

  $searchName = null;
  $buyerQuery = "SELECT * FROM `buyer` ORDER BY `last_name` ASC";
  if(isset($_GET['name'])){
    $searchName = urldecode($_GET['name']);
    $searchName = mysqli_real_escape_string($connection, $searchName);
    $buyerQuery = "SELECT * FROM (
      SELECT *, CONCAT(first_name, ' ', last_name) as firstlast
      FROM `buyer` ORDER BY `last_name` ASC) base
    WHERE firstLast LIKE '%{$searchName}%'";
  }

	 ?>
	 <!-- START CONTENT -->
 <section id="content" class="print">
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

                          <div class="row">
                            <!--<div class="col" data-field="id">ID</div>-->
                            <div class="col s2" data-field="name">Name</div>
                            <div class="col s2" data-field="company">Company</div>
                            <!--<div class="col" data-field="phone">Phone</div>
                            <div class="col" data-field="license">License</div>-->
                            <div class="col s2" data-field="action">Actions</div>
                          </div>


                        <?php
                          $result=mysqli_query( $connection, $buyerQuery);
                          confirm_query($result);
                          while($buyer=mysqli_fetch_array($result)){
                            ?>
                            <a class="white-text" href="edit_buyers.php?id=<?php echo $buyer['id']; ?>" >
                       <div class="row section card-panel  sheet">
                          <!--<div class="col s2"><?php echo $buyer['id']; ?></div>-->
                          <div class="col s2"><?php echo $buyer['last_name'] . ", " . $buyer['first_name']; ?></div>
                          <div class="col s2"><?php echo $buyer['company_name']; ?></div>
                          <!--<div class="col"><?php echo $buyer['phone']; ?></div>
                          <div class="col"><?php echo $buyer['fur_buyer_license_num']; ?></div>-->
                          <div class="col s1">

                            <a href="receipt.php?id=<?php echo $buyer['id']; ?>" class="waves-effect waves-light  btn-small blue"><i class="material-icons">receipt</i></a>
                          </div>
                            <div class="col s1">
                            <a href="list_buyers.php?deleteID=<?php echo $buyer['id']; ?>" class="waves-effect waves-light  btn-small red"><i class="material-icons">delete</i></a>
                          </div>
                        </div>
                      </a>
                        <?php
                          }
                      ?>

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
