<?php
	$pgsettings = array(
		"title" => "Template",
		"icon" => "icon-newspaper"
	);
	require_once("includes/begin_html.php");
	?>
	<aside id="left-sidebar-nav">
	  <ul id="slide-out" class="side-nav fixed leftside-navigation">
	    <li class="user-details brown darken-2">
	      <div class="row">
	        <div class="col col s4 m4 l4">
	          <img src="../../images/avatar/avatar-7.png" alt="" class="circle responsive-img valign profile-image brown">
	        </div>
	        <div class="col col s8 m8 l8">
	          <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown-nav">Admin<i class="mdi-navigation-arrow-drop-down right"></i></a>
	          <p class="user-roal">Administrator</p>
	        </div>
	      </div>
	    </li>
	    <li class="no-padding">
	        <ul class="collapsible" data-collapsible="accordion">
						<?php
						$dir_open = opendir('./pages');

						while(false !== ($filename = readdir($dir_open))){
						  if($filename != "." && $filename != ".."){
						      $link = "
						      <li><div class='divider'></div></li>
						      <li><a class='subheader'>$filename</a></li>
						      <li class='bold'>
						      <a href='../../pages/$filename/list_$filename.php' class='waves-effect waves-brown'>
						      <span class='nav-text'>$filename List</span>
						      </a>
						      </li>
						      <li class='bold'>
						      <a href='../../pages/$filename/edit_$filename.php' class='waves-effect waves-brown'>
						      <span class='nav-text'>Edit $filename</span>
						      </a>
						      </li>";
						      echo $link;
						  }
						}
						?>
	        </ul>
	      </li>
	  </ul>
	  <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only">
	    <i class="material-icons">menu</i>
	  </a>
	</aside>
<?php
	require_once("includes/crumbs.php");
	$dir_open = opendir('./pages');

while(false !== ($filename = readdir($dir_open))){
    if($filename != "." && $filename != ".."){
        $link = "<a href='./pages/$filename/list_$filename.php'> $filename </a><br />";
        echo $link;
    }
}

closedir($dir_open);
		require_once("includes/end_html.php");
	 ?>
