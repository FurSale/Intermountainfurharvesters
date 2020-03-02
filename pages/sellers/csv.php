<?php
require_once("../../includes/db_connection.php");
    $pgsettings = array(
        "title" => "Sellers",
        "icon" => "icon-newspaper"
    );
  require_once("../../includes/functions.php");

  verify_logged_in(array("administrator"));

  function Delete()
  {
      global $connection;
      $id = mysqli_real_escape_string($connection, $_GET['deleteID']);

      $query = "SELECT * FROM `seller` WHERE `id` = {$id}";
      $result = mysqli_query($connection, $query);
      confirm_query($result);
      if (mysqli_num_rows($result)!=1) {
          return array('success' => false, 'message' => "Seller does not exist to delete");
      }
      $sellerData = mysqli_fetch_array($result);

      //Delete all the bids under the items
      $query = "SELECT * FROM `seller_item` WHERE `seller_id` = {$id}";
      $result = mysqli_query($connection, $query);
      confirm_query($result);
      while ($sellerItem=mysqli_fetch_array($result)) {
          $query = "DELETE FROM `bid` WHERE `seller_item_id` = {$sellerItem['id']}";
          $result2 = mysqli_query($connection, $query);
          confirm_query($result2);
      }

      //Delete the items
      $query = "DELETE FROM `seller_item` WHERE `seller_id` = {$sellerData['id']}";
      $result = mysqli_query($connection, $query);
      confirm_query($result);

      //Delete the seller
      $query = "DELETE FROM `seller` WHERE `id` = {$sellerData['id']}";
      $result = mysqli_query($connection, $query);
      confirm_query($result);

      if (mysqli_affected_rows($connection) == 1) {
          return array('success' => true, 'message' => "Item {$sellerData['first_name']} deleted");
      }
      return array('success' => false, 'message' => "Couldn't update" . "<br />" . mysqli_error($connection));
  }

  if (isset($_GET['deleteID'])) {
      $result = Delete();
      if ($result['success']) {
          $success = $result['message'];
      } else {
          $error = $result['message'];
      }
  }



  $searchName = null;
  $sellerQuery = "SELECT * FROM `seller` ORDER BY `last_name` ASC";
  if (isset($_GET['name'])) {
      $searchName = urldecode($_GET['name']);
      $searchName = mysqli_real_escape_string($connection, $searchName);
      $sellerQuery = "SELECT * FROM (
      SELECT *, CONCAT(first_name, ' ', last_name) as firstlast
      FROM `seller` ORDER BY `last_name` ASC) base
    WHERE firstLast LIKE '%{$searchName}%'";
  }

     ?>

				<?php
                          $result=mysqli_query($connection, $sellerQuery);
                          confirm_query($result);
                          while ($seller=mysqli_fetch_array($result)) {
                              ?>
															<?php echo $seller['last_name'] . ", " . $seller['first_name'] . ", "; ?>
<?php echo $seller['address_1'] . " " . $seller['address_2'] . ", " . $seller['city'] . " " . $seller['state'] . " " . $seller['zip'] . ","; ?>


								<?php
                                  $subtotal = 0;
                              $query = "SELECT * FROM `seller_item` WHERE `seller_id` = {$seller['id']}";
                              $result2=mysqli_query($connection, $query);
                              confirm_query($result2);
                              //Check each of the buyer's bid to see if it's the winning one
                              while ($itemData=mysqli_fetch_array($result2)) {
                                  //Get first record of the highest bid in case of tie bids
                                  $query = "SELECT * FROM `bid` WHERE `seller_item_id` = {$itemData['id']} AND `bid_status` = 'Confirmed' ORDER BY `bid_amount` DESC, `DATE_CREATED` ASC LIMIT 1";
                                  $result3=mysqli_query($connection, $query);
                                  confirm_query($result3);
                                  if (mysqli_num_rows($result3) > 0) {
                                      $bid=mysqli_fetch_array($result3);
                                      $amount = 0;
                                      if ($bid['bid_amount'] >= $itemData['asking']) {
                                          $amount = $bid['bid_amount'];
                                      }
                                      $subtotal += $amount; ?>

								<?php
                                  }
                              } ?>

									<?php echo "$" . number_format($subtotal - (($seller['commission']/100)* $subtotal), 2, '.', '') ; ?>

				<?php
                          }
                      ?>
                      <script>
                      const presentationRequest = new PresentationRequest(['receiver/index.html']);

// Make this presentation the default one when using the "Cast" browser menu.
navigator.presentation.defaultRequest = presentationRequest;

let presentationConnection;

document.querySelector('#start').addEventListener('click', function() {
  log('Starting presentation request...');
  presentationRequest.start()
  .then(connection => {
    log('> Connected to ' + connection.url + ', id: ' + connection.id);
  })
  .catch(error => {
    log('> ' + error.name + ': ' + error.message);
  });
});

presentationRequest.addEventListener('connectionavailable', function(event) {
  presentationConnection = event.connection;
  presentationConnection.addEventListener('close', function() {
    log('> Connection closed.');
  });
  presentationConnection.addEventListener('terminate', function() {
    log('> Connection terminated.');
  });
  presentationConnection.addEventListener('message', function(event) {
    log('> ' + event.data);
  });
});

document.querySelector('#sendMessage').addEventListener('click', function() {
  const message = document.querySelector('#message').value.trim();
  const lang = document.body.lang || 'en-US';

  log('Sending "' + message + '"...');
  presentationConnection.send(JSON.stringify({message, lang}));
});

document.querySelector('#close').addEventListener('click', function() {
  log('Closing connection...');
  presentationConnection.close();
});

document.querySelector('#terminate').addEventListener('click', function() {
  log('Terminating connection...');
  presentationConnection.terminate();
});

document.querySelector('#reconnect').addEventListener('click', () => {
  const presentationId = document.querySelector('#presentationId').value.trim();

  presentationRequest.reconnect(presentationId)
  .then(connection => {
    log('Reconnected to ' + connection.id);
  })
  .catch(error => {
    log('Presentation.reconnect() error, ' + error.name + ': ' + error.message);
  });
});

/* Availability monitoring */

presentationRequest.getAvailability()
.then(availability => {
  log('Available presentation displays: ' + availability.value);
  availability.addEventListener('change', function() {
    log('> Available presentation displays: ' + availability.value);
  });
})
.catch(error => {
  log('Presentation availability not supported, ' + error.name + ': ' +
      error.message);
});
let connectionIdx = 0;
let messageIdx = 0;

function addConnection(connection) {
  connection.connectionId = ++connectionIdx;
  addMessage('New connection #' + connectionIdx);

  connection.addEventListener('message', function(event) {
    messageIdx++;
    const data = JSON.parse(event.data);
    const logString = 'Message ' + messageIdx + ' from connection #' +
        connection.connectionId + ': ' + data.message;
    addMessage(logString, data.lang);
    maybeSetFruit(data.message);
    connection.send('Received message ' + messageIdx);
  });

  connection.addEventListener('close', function(event) {
    addMessage('Connection #' + connection.connectionId + ' closed, reason = ' +
        event.reason + ', message = ' + event.message);
  });
};

/* Utils */

const fruitEmoji = {
  'grapes':      '\u{1F347}',
  'watermelon':  '\u{1F349}',
  'melon':       '\u{1F348}',
  'tangerine':   '\u{1F34A}',
  'lemon':       '\u{1F34B}',
  'banana':      '\u{1F34C}',
  'pineapple':   '\u{1F34D}',
  'green apple': '\u{1F35F}',
  'apple':       '\u{1F34E}',
  'pear':        '\u{1F350}',
  'peach':       '\u{1F351}',
  'cherries':    '\u{1F352}',
  'strawberry':  '\u{1F353}'
};

function addMessage(content, language) {
  const listItem = document.createElement("li");
  if (language) {
    listItem.lang = language;
  }
  listItem.textContent = content;
  document.querySelector("#message-list").appendChild(listItem);
};

function maybeSetFruit(message) {
  const fruit = message.toLowerCase();
  if (fruit in fruitEmoji) {
    document.querySelector('#main').textContent = fruitEmoji[fruit];
  }
};

document.addEventListener('DOMContentLoaded', function() {
  if (navigator.presentation.receiver) {
    navigator.presentation.receiver.connectionList.then(list => {
      list.connections.map(connection => addConnection(connection));
      list.addEventListener('connectionavailable', function(event) {
        addConnection(event.connection);
      });
    });
  }
});
                      </script>
