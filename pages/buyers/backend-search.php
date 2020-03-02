<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
require_once("../../includes/db_connection.php");
require_once("../../includes/functions.php");
if (isset($_POST['query'])) {
    $search_query = $_POST['query'];


    $query = "SELECT * FROM (
    SELECT *, CONCAT(first_name, ' ', last_name) as firstlast
    FROM `buyer` ORDER BY `last_name` ASC) base
  WHERE firstLast LIKE '$search_query%' LIMIT 12";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo $row['last_name'].",".$row['first_name']."<br/>";
        }
    } else {
        echo "<p style='color:red'>Country not found...</p>";
    }
}
