<?php 
//index.php
require('db_connect.php');
$query = "SELECT * FROM bar_chart";
$result = mysqli_query($conn, $query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{
 $chart_data .= "{ time:'".$row["time"]."', humidity:".$row["humidity"].", temperature:".$row["temperature"]."}, ";
}
$chart_data = substr($chart_data, 0, -2);
?>


<!DOCTYPE html>
<html>
 <head>
  <title>Graphs</title>
  
  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

  
 </head>
 <body>
  <br /><br />
  <div class="container" style="width:900px;">
   <h2 class="text-center">Fetch your real world data from database</h2>
   <h3 class="text-center">Dynamic Values of Graph</h3>   
   <br /><br />
   <div id="chart"></div>
  </div>

  <div class = "container">
  <button class = "btn btn-warning btn-sm"><a href = "index.php" style = "text-decoration: none; color: #333;">Back to Results</a></button>
</div>

 </body>
</html>

<script>
Morris.Bar({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'time',
 ykeys:['temperature'],
 labels:['temperature', 'humidity'],
 hideHover:'auto',
 stacked:true
});
</script>