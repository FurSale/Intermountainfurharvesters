<!--<ul id="dropdown1" class="dropdown-content">
  <li><a href="../../pages/sellers/edit_sellers.php?new">Add</a></li>
  <li><a href="../../pages/buyers/list_buyers.php">Buyers</a></li>
  <li><a href="../../pages/items/list_items.php">Items</a></li>
</ul>
<ul id="dropdown2" class="dropdown-content">
  <li><a href="../../pages/sellers/edit_buyers.php?new">Add</a></li>
  <li><a href="../../pages/buyers/list_buyers.php">Buyers</a></li>
  <li><a href="../../pages/items/list_items.php">Items</a></li>
</ul>
<ul id="dropdown3" class="dropdown-content">
  <li><a href="../../pages/sellers/edit_items.php?new">Add</a></li>
  <li><a href="../../pages/buyers/list_buyers.php">Buyers</a></li>
  <li><a href="../../pages/items/list_items.php">Items</a></li>
</ul>-->
<nav class="nav-extended printhide blue-grey darken-2">
<div class="nav-wrapper " id="header">
<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
<ul class="left hide-on-med-and-down">
  <li><a class="dropdown-trigger" href="../../pages/reports/final.php" data-target="dropdown1"><i class="material-icons">assessment</i></a></li>
  <li><a class="dropdown-trigger" href="../../pages/logout.php" data-target="dropdown1"><i class="material-icons">logout</i></a></li>
</ul>
<ul class="right hide-on-med-and-down">
  <li><a href="../../pages/sellers/list_sellers.php" data-target="dropdown1">Sellers</a></li>
  <li><a href="../../pages/buyers/list_buyers.php" data-target="dropdown2">Buyers</a></li>
  <li><a href="../../pages/items/list_items.php" data-target="dropdown3">Items</a></li>
  <li><a href="/pages/site_settings.php" data-target="dropdown4"><i class="material-icons">settings_applications</i></a></li>
</ul>
</div>
<div class="nav-content">
<span class="nav-title"><?php echo $pgsettings['title']; ?></span>
  <div class="fab">
    <a class="btn-floating btn-large halfway-fab waves-effect waves-light red pulse">
      <i class="large material-icons">library_add</i>
    </a>
    <ul>
      <li><a href="../../pages/sellers/new_sellers.php?new" class="btn-floating halfwayfab red tooltipped" data-position="bottom" data-tooltip="Sellers"><i class="material-icons">person_add</i></a></li>
      <li><a href="../../pages/buyers/edit_buyers.php?new" class="btn-floating halfwayfab blue tooltipped" data-position="bottom" data-tooltip="Buyers"><i class="material-icons">store_mall_directory</i></a></li>
      <!--<li><a href="../../pages/items/edit_items.php?new" class="btn-floating halfwayfab green tooltipped" data-position="bottom" data-tooltip="Items"><i class="material-icons left">publish</i></a></li>-->
    </ul>
  </div>
</div>
</nav>
<ul id="slide-out" class="sidenav">
  <li><a href="../../pages/sellers/list_sellers.php" data-target="dropdown1">Sellers</a></li>
  <li><a href="../../pages/buyers/list_buyers.php" data-target="dropdown2">Buyers</a></li>
  <li><a href="../../pages/items/list_items.php" data-target="dropdown3">Items</a></li>
  <li><a href="/pages/site_settings.php" data-target="dropdown4"><i class="material-icons">settings_applications</i></a></li>
  </ul>
