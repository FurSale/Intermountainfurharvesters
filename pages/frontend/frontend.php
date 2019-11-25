<?php
  require_once("../../includes/db_connection.php");
	$pgsettings = array(
		"title" => "Buyers",
		"icon" => "icon-newspaper"
	);
	$nav = ("1");
	require_once("../../includes/functions.php");
	require_once("../../includes/begin_html.php");


	 ?>
      <section id="content">
        <?php
     	 	require_once("../../includes/crumbs.php");
     	 	 ?>
         <div class="app-bar-bottom">
<a class="btn-floating-center waves-effect waves-light red modal-trigger" href="#modal1"><i class="material-icons">add</i></a>
</div>
	 <div id="modal1" class="modal bottom-sheet"">
          <div class="modal-content">
            <h3 class="header">Modal Header</h3>
            <ul class="collection">
              <li class="collection-item avatar">
              <i class="material-icons circle blue">account_balance_wallet</i>
                <span class="title">Title</span>
                <p>First Line
                  <br> Second Line
                </p>
                <a href="#!" class="secondary-content">
                  <i class="material-icons">account_balance_wallet</i>
                </a>
              </li>
              <li class="collection-item avatar">
                <i class="material-icons circle yellow">account_balance_wallet</i>
                <span class="title">Title</span>
                <p>First Line
                  <br> Second Line
                </p>
                <a href="#!" class="secondary-content">
                  <i class="material-icons">account_balance_wallet</i>
                </a>
              </li>
              <li class="collection-item avatar">
                <i class="material-icons circle green">account_balance_wallet</i>
                <span class="title">Title</span>
                <p>First Line
                  <br> Second Line
                </p>
                <a href="#!" class="secondary-content">
                  <i class="material-icons">account_balance_wallet</i>
                </a>
              </li>
              <li class="collection-item avatar">
                <i class="material-icons circle red">account_balance_wallet</i>
                <span class="title">Title</span>
                <p>First Line
                  <br> Second Line
                </p>
                <a href="#!" class="secondary-content">
                  <i class="material-icons">account_balance_wallet</i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </section>
      <!-- END WRAPPER -->
      </main>

<?php
	require_once("../../includes/end_html.php");
	 ?>
