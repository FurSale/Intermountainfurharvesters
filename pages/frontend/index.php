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
   <div class="container">
      <section id="content" class="">
          <form  method="post">
            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='text' name='lot' id='lot' />
                <label for='email'>Lot #</label>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='number' name='bid' id='bid' />
                <label for='password'>Bid Amount</label>
              </div>
            </div>
            <br />
              <div class='row center'>
                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo'>Place Bid</button>
              </div>
          </form>
        </section>
        <!-- END WRAPPER -->
</div>
        <div class="app-bar-bottom">
<a class="btn-floating-center waves-effect waves-light red modal-trigger" href="#modal1"><i class="material-icons">expand_less</i></a>
</div>
</main>
  <div id="modal1" class="modal bottom-sheet">
         <div class="modal-content">
           <ul class="collection with-header">
        <li class="collection-header"><h4>Bids</h4></li>
        <li class="collection-item">
          <div class="row">
            <div class="col s2">#1000</div>
            <div class="col s2">4ct</div>
            <div class="col s2">Muskrat</div>
            <div class="col s2"><input value="&#36;100" id="bids1" type="text" class="validate" disabled></div>
            <div class="col s2">
              <button onclick="swap1()" class="btn waves-effect waves-light blue" id="editbid1">Edit</button>
              <button class="btn waves-effect waves-light green hide"  id="sendbid1">Save</button>
            </div>
            <div class="col s2"><button class="btn waves-effect waves-light red"  id="deletebid1"><i class="material-icons">close</i></button></div>
            </div>
        </li>
        <li class="collection-item">
          <div class="row">
            <div class="col s2">#1001</div>
            <div class="col s2">4lbs</div>
            <div class="col s2">Antler</div>
            <div class="col s2"><input value="&#36;100" id="bids2" type="text" class="validate" disabled></div>
            <div class="col s2">
              <button onclick="swap2()" class="btn waves-effect waves-light blue" id="editbid2">Edit</button>
              <button class="btn waves-effect waves-light green hide"  id="sendbid2">Save</button>
            </div>
            <div class="col s2"><button class="btn waves-effect waves-light red"  id="deletebid2"><i class="material-icons">close</i></button></div>
            </div>
        </li>

</ul>
<a class="waves-effect waves-light btn modal-trigger" href="#modal2">Submit</a>
</div>
<!-- Modal Structure -->
<div id="modal2" class="modal">
  <div class="modal-content">
    <h4>Are you Sure?</h4>
    <p>This is the Final Submission</p>
  </div>
  <div class="modal-footer">
    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
<i class="material-icons right">send</i>
</button>

  </div>
</div>
         </div>
       </div>
<?php
	require_once("../../includes/end_html.php");
	 ?>
