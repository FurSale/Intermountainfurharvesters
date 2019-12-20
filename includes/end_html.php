
    <!-- ================================================
    Scripts
    ================================================ -->
    <script type="text/javascript">
    if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('../../service-worker.js');
}
    </script>
    <script type="text/javascript">

    let deferredPrompt = null;

window.addEventListener('beforeinstallprompt', (e) => {
  // Prevent Chrome 67 and earlier from automatically showing the prompt
  e.preventDefault();
  // Stash the event so it can be triggered later.
  deferredPrompt = e;
});

async function install() {
  if (deferredPrompt) {
    deferredPrompt.prompt();
    console.log(deferredPrompt)
    deferredPrompt.userChoice.then(function(choiceResult){

      if (choiceResult.outcome === 'accepted') {
      console.log('Your PWA has been installed');
    } else {
      console.log('User chose to not install your PWA');
    }

    deferredPrompt = null;

    });


  }
}

    </script>

    <script>
//Sellers
//   document.getElementById("type1").onchange = function () {
//   document.getElementById("custom").setAttribute("class", "hide");
//   if (this.value == 'custom')
//     document.getElementById("custom").removeAttribute("class", "hide");
// };
// document.getElementById("type1").onchange = function () {
// if (this.value == 'Antlers' || this.value == 'Castor') {
// document.getElementById("item_count1").checked = false;
// document.getElementById("item_weight1").checked = true;
// }else {
// document.getElementById("item_count1").checked = true;
// document.getElementById("item_weight1").checked = false;
// }
// };
//Buyers
// function swap1() {
//   document.getElementById("editbid1").setAttribute("class", "hide");
//   document.getElementById("sendbid1").classList.remove("hide");
//   document.getElementById("bids1").removeAttribute("disabled");
//   };
//   function swap2() {
//     document.getElementById("editbid2").setAttribute("class", "hide");
//     document.getElementById("sendbid2").classList.remove("hide");
//     document.getElementById("bids2").removeAttribute("disabled");
//     };
</script>
    <script src="../../js/manup.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="../../js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="../../vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="../../js/plugins.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="../../js/custom-script.js"></script>
    <script>
      //Display messages
      $(document).ready(function(){
      <?php
      //Display messages
      if(isset($error)&&!is_array($error)){
          echo "M.toast({html:'".$error."'});";
      }elseif(isset($error)&&is_array($error)&&!empty($error)){
          foreach ($error as $value) {
            echo "M.toast({html:'".$value."'});";
          }
      }
      ?>
      <?php
      if(isset($success)&&!is_array($success)){
          echo "M.toast({html:'".$success."'});";
      }elseif(isset($success)&&is_array($success)&&!empty($success)){
          foreach ($success as $value) {
            echo "M.toast({html:'".$value."'});";
          }
      }
      ?>
      <?php
      if(isset($message)&&!is_array($message)){
          echo "M.toast({html:'".$message."'});";
      }elseif(isset($message)&&is_array($message)&&!empty($message)){
          foreach ($message as $value) {
            echo "M.toast({html:'".$value."'});";
          }
      }
      ?>
    });
    <script>
  </body>
</html>
