<?php


include 'includes\begin_html.php';


?>
<section id="content">
      <!--breadcrumbs start-->
      <div id="breadcrumbs-wrapper">
        <!-- Search for small screen -->
        <div class="header-search-wrapper grey lighten-2 hide-on-large-only">
          <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Search">
        </div>
        <div class="container">
          <div class="row">
            <div class="col s10 m6 l6">
              <h5 class="breadcrumbs-title">Data Tables</h5>
              <ol class="breadcrumbs">

                <li><a href="#">Data</a></li>
                <li class="active">sale</li>
              </ol>
            </div>
            <div class="col s2 m6 l6">
              <a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="#!" data-activates="dropdown1">
                  <i class="material-icons hide-on-med-and-up">settings</i>
                  <span class="hide-on-small-onl">Sort By</span>
                  <i class="material-icons right">arrow_drop_down</i>
                </a>
              <ul id="dropdown1" class="dropdown-content">
                <li><a href="#!" class="grey-text text-darken-2">ALL<span class="new badge">25</span></a>
                </li>
                <li><a href="#!" class="grey-text text-darken-2">Item<span class="badge">2</span></a>
                </li>
                <li><a href="#!" class="grey-text text-darken-2">Category</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!--breadcrumbs end-->
      <!--start container-->
      <div class="container">

          <!--Responsive Table-->
          <div class="divider"></div>
          <div id="responsive-table">
            <h4 class="header">Data sale</h4>
            <div class="row">
              <div class="col s12">
                <table class="responsive-table">
                  <thead>
                    <tr>
                      <th data-field="id">Lot</th>
                      <th data-field="name">Item</th>
                      <th data-field="email">Count</th>
                      <th data-field="address">Price</th>
                      <th data-field="address">High Bid</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>2001</td>
                      <td>Coyote</td>
                      <td>16</td>
                      <td>$12</td>
                      <td class="green-text">$127</td>

                    </tr>
                    <tr>
                      <td>2003</td>
                      <td>Coyote</td>
                      <td>1</td>
                      <td>$34</td>
                      <td class="red-text">$23</td>

                    </tr>
                    <tr>
                      <td>2007</td>
                      <td>Coyote</td>
                      <td>8</td>
                      <td>$56</td>
                      <td class="green-text">$123</td>
                    </tr>
                    <tr>
                      <td>2015</td>
                      <td>Bobcat</td>
                      <td>102</td>
                      <td>$78</td>
                      <td class="red-text">$12</td>
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
