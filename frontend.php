<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    <title>Trapping sale Manager <?php echo $pgsettings['title']; ?></title>
    <link rel='manifest' href='../../manifest.json'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons-->
    <link rel="icon" href="../../images/favicon/favicon-32x32.png" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="../../images/favicon/mstile-144x144.png">
    <!-- For Windows Phone -->
    <!-- CORE CSS-->
    <link href="../../css/materialize.css" type="text/css" rel="stylesheet">
    <link href="../../css/style.css" type="text/css" rel="stylesheet">
    <!-- Custome CSS-->
    <link href="css/custom/custom.css" type="text/css" rel="stylesheet">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="../../vendors/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet">
  </head>
  <body>
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START HEADER -->
    <header id="header" class="page-topbar">
      <!-- start header nav-->
      <div class="navbar-fixed">
        <nav class="navbar-color brown">
          <div class="nav-wrapper">
            <ul class="left">
              <li>
                <h1 class="logo-wrapper">
                  <a href="#" class="brand-logo darken-1">
                    <img src="../../images/logo/materialize-logo.png" alt="materialize logo">

                  </a>
                </h1>
              </li>
            </ul>
            <div class="header-search-wrapper hide-on-med-and-down">
              <i class="material-icons">search</i>
              <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Search" />
            </div>
            <ul class="right hide-on-med-and-down">

              <li>
              </li>
            </ul>
          </div>
        </nav>
      </div>
      <!-- end header nav-->
    </header>
    <!-- END HEADER -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START MAIN -->
    <div id="main">
      <!-- START WRAPPER -->
      <div class="wrapper">
        <!-- START CONTENT -->
      <section id="content">
<!--breadcrumbs start-->
	 <div id="breadcrumbs-wrapper">
	   <!-- Search for small screen -->
	   <div class="container">
	     <div class="row">
	       <div class="col s10 m6 l6">
	         <h5 class="breadcrumbs-title">Data Tables</h5>
	         <ol class="breadcrumbs">

	           <li>User</li>
	           <li class="active"><?php echo $pgsettings['title']; ?></li>
	         </ol>
	       </div>
	     </div>
	   </div>
	 </div>
	 <button data-target="modal1" class="btn modal-trigger">Modal</button>

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
	 <!--breadcrumbs end-->
<?php
	require_once("includes/end_html.php");
	 ?>
