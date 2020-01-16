<?php
  require_once("../../includes/db_connection.php");
  require_once("../../includes/functions.php");
$query="SELECT * FROM 'seller_item'}";
  //Fetch 3 rows from actor table
    $result =$connection->query("SELECT item, count FROM seller_item");

  //Initialize array variable
    $dbdata = array();

  //Fetch into associative array
    while ($row = $result->fetch_assoc()) {
        $dbdata[]=$row;
    }

        $datainput = json_encode($dbdata, true);
        $jsonDecoded = json_decode($datainput, true);

        //Give our CSV file a name.
        $csvFileName = 'example.csv';

        //Open file pointer.
        $fp = fopen($csvFileName, 'w');

        //Loop through the associative array.
        foreach ($jsonDecoded as $row) {
            //Write the row to the CSV file.
            fputcsv($fp, $row);
        }

        //Finally, close the file pointer.
        fclose($fp);
     ?>

<?php  ?>
<!DOCTYPE HTML>
<html>
<head>
<script>
Chart.defaults.global.defaultFontFamily = 'Roboto';
Chart.defaults.global.defaultFontColor = '#333';

function makeChart(players) {
  // players is an array of objects where each object is something like:
  // {
  //   "Name": "Steffi Graf",
  //   "Weeks": "377",
  //   "Gender": "Female"
  // }

  var playerLabels = players.map(function(d) {return d.Name});
  var weeksData = players.map(function(d) {return +d.Weeks});
  var playerColors = players.map(function(d) {return d.Gender === 'Female' ? '#F15F36' : '#19A0AA';});

  var chart = new Chart('chart', {
    type: 'horizontalBar',
    options: {
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      scales: {
        xAxes: [
          {
            scaleLabel: {
              display: true,
              labelString: 'Weeks at No.1',
              fontSize: 16
            }
          }
        ]
      }
    },
    data: {
      labels: playerLabels,
      datasets: [
        {
          item: weeksData,
          backgroundColor: playerColors
        }
      ]
    }
  })
}

// Request data using D3
d3.csv('https://raw.githubusercontent.com/johnsondelbert1/Intermountainfurharvesters/master/pages/items/example.csv?token=AARG4VKRDMPKQDYE6LTQTB26EAUUS')
  .then(makeChart);
</script>
</head>
<body>
<canvas id="chart"></canvas>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.7.0/d3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<?php echo $datainput ?>
</body>
</html>
