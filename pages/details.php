<?php


include 'includes\begin_html.php';


?>
<section id="content">
      <!--breadcrumbs start-->
      <div id="breadcrumbs-wrapper">
        <!-- Search for small screen -->
        <div class="header-search-wrapper grey lighten-2 hide-on-large-only">
          <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
        </div>
        <div class="container">
          <div class="row">
            <div class="col s10 m6 l6">
              <h5 class="breadcrumbs-title">Basic Tables</h5>
              <ol class="breadcrumbs">

                <li><a href="#">Data</a></li>
                <li><a href="#">Buyers</a></li>
                <li class="active">Detail ID TRF001</li>
              </ol>
            </div>
            <div class="col s2 m6 l6">
              <a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="#!" data-activates="dropdown1">
                  <i class="material-icons hide-on-med-and-up">settings</i>
                  <span class="hide-on-small-onl">Settings</span>
                  <i class="material-icons right">arrow_drop_down</i>
                </a>
              <ul id="dropdown1" class="dropdown-content">
                <li><a href="#!" class="grey-text text-darken-2">Access<span class="badge">1</span></a>
                </li>
                <li><a href="#!" class="grey-text text-darken-2">Profile<span class="new badge">2</span></a>
                </li>
                <li><a href="#!" class="grey-text text-darken-2">Notifications</a>
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
            <h4 class="header">Data Buyers</h4>
            <div class="row">
              <div class="col s12">
                <table class="responsive-table">
                  <thead>
                    <tr>
                      <th data-field="id">ID Detail</th>
                      <th data-field="name">Item</th>
                      <th data-field="jumlah">Count</th>
                      <th data-field="harga">Price</th>
                      <th data-field="subtotal">Bid</th>
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
                  <tr>
                      <td>TOTAL</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>$285</td>
                  </tr>
                  </tbody>
                </table>
                <div class="col s12 m12 l12">
                    <br/>
                    <a class="waves-effect waves-light  btn right"><i class="material-icons left">send</i> Export</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END CONTENT -->
<?php


include 'includes\end_html.php';


?>
