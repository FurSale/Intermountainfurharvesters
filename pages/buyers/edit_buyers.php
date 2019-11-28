<?php
  require_once("../../includes/db_connection.php");
	$pgsettings = array(
		"title" => "Username",
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
      <div class="container">
        <div class="row">
           <form class="col s12">
             <div class="row">
               <div class="input-field col s3">
                 <i class="material-icons prefix">contacts</i>
                 <input placeholder="License" id="License" type="text" class="validate">
                 <label for="License">License</label>
               </div>
               <div class="input-field col s3">
                 <i class="material-icons prefix">contacts</i>
                 <input placeholder="License" id="License" type="text" class="validate">
                 <label for="License">Company</label>
               </div>
             </div>
             <div class="row">
               <div class="input-field col s3">
                 <i class="material-icons prefix">account_circle</i>
                 <input id="first_name" type="text" class="validate">
                 <label for="first_name">First Name</label>
               </div>
               <div class="input-field col s3">
                 <input id="last_name" type="text" class="validate">
                 <label for="last_name">Last Name</label>
               </div>
        <div class="input-field col s3">
          <i class="material-icons prefix">contact_phone</i>
          <input id="telephone" type="tel" class="validate">
          <label for="telephone">Telephone</label>
        </div>
               <div class="input-field col s3">
                 <i class="material-icons prefix">contact_mail</i>
                 <input id="email" type="email" class="validate">
                 <label for="email">Email</label>
               </div>
             </div>
             <div class="row">
               <div class="input-field col s3">
                 <i class="material-icons prefix">home</i>
                 <input placeholder="Address" id="Address" type="text" class="validate">
                 <label for="address">Address</label>
               </div>
               <div class="input-field col s3">
                 <input id="city" type="text" class="validate">
                 <label for="city">City</label>
               </div>
        <div class="input-field col s3">
          <?php require("../../includes/states.php"); ?>
        </div>
               <div class="input-field col s3">
                 <input id="zip" type="number" class="validate">
                 <label for="zip">Zip</label>
               </div>
             </div>

           </form>
         </div>
          <!--Responsive Table-->
          <div id="responsive-table">
	<h4 class="header">Items</h4>
	<div class="row">
		<div class="col s12">
			<table>
				<thead>
					<tr>
						<th>Lot #</th>
						<th>Item Type</th>
						<th>Quantity</th>
						<th>lbs / ct</th>
						<th>Asking Price</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							#1000
						</td>
						<td>
							ID
						</td>
						<td>
							10
						</td>
						<td>
							ct
						</td>
						<td>
							<div class="input-field">
								<input placeholder="$0" id="Asking_Price" type="number" class="validate">
								<label for="Asking_Price">Asking Price</label>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="input-field col s3"><a class="waves-effect waves-light btn">Save</a>
			</div>
		</div>
	</div>
</div>
   </section>
 <!-- END WRAPPER -->
 </main>
<?php
include '../../includes/footer.php';
include '../../includes/end_html.php';
?>
