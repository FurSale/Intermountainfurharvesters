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
  <li><a href="../../pages/items/list_items.php">Items</a></li>-->
</ul>
<nav class="nav-extended brown">
<div class="nav-wrapper " id="header">
<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
<div class="header-search-wrapper hide-on-med-and-down">
  <i class="material-icons">search</i>
  <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Search" disabled/>
</div>
<ul class="right hide-on-med-and-down">
  <li><a class="dropdown-trigger" href="../../pages/sellers/list_sellers.php" data-target="dropdown1">Sellers</a></li>
  <li><a class="dropdown-trigger" href="../../pages/buyers/list_buyers.php" data-target="dropdown2">Buyers</a></li>
  <li><a class="dropdown-trigger" href="../../pages/items/list_items.php" data-target="dropdown3">Items</a></li>
</ul>
</div>
<div class="nav-content">
<span class="nav-title"><?php echo $pgsettings['title']; ?></span>
  <div class="fab">
    <a class="btn-floating btn-large halfway-fab waves-effect waves-light red pulse">
      <i class="large material-icons">library_add</i>
    </a>
    <ul>
      <li><a href="../../pages/sellers/edit_sellers.php?new" class="btn-floating halfwayfab red tooltipped" data-position="bottom" data-tooltip="Sellers"><i class="material-icons-two-tone">person_add</i></a></li>
      <li><a href="../../pages/buyers/edit_buyers.php?new" class="btn-floating halfwayfab blue tooltipped" data-position="bottom" data-tooltip="Buyers"><i class="material-icons-two-tone">store_mall_directory</i></a></li>
      <!--<li><a href="../../pages/items/edit_items.php?new" class="btn-floating halfwayfab green tooltipped" data-position="bottom" data-tooltip="Items"><i class="material-icons left">publish</i></a></li>-->
    </ul>
  </div>
</div>
</nav>
<ul id="slide-out" class="sidenav">
  <li><a href="../../pages/sellers/list_sellers.php">Sellers</a></li>
  <li><a href="../../pages/buyers/list_buyers.php">Buyers</a></li>
  <li><a href="../../pages/items/list_items.php">Items</a></li>
  </ul>
