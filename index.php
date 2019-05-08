<?php 

    require('db_connect.php');

    $msg = '';
    $msgClass = '';
    
    if(isset($_POST['submit'])){
        $humidity        = $_POST['humidity'];
        $temperature     = $_POST['temperature'];
        $smoke           = $_POST['smoke'];
        $sound           = $_POST['sound'];

        $sql = "INSERT INTO bar_chart(humidity, temperature, smoke, sound) VALUES('$humidity', '$temperature', '$smoke', '$sound')";
        $result = mysqli_query($conn, $sql);
        if($result) {
            $msg = "Data inserted successfully";
            $msgClass="alert-success";
        }
        else {
            $msg = "Data not inserted";
            $msgClass="alert-danger";
        }
    }
 ?>


 <?php 
    // Delete Student
if (isset($_POST['del_data'])) {
	$query="DELETE FROM bar_chart WHERE id=".$_POST['id'];
	$result = mysqli_query($conn, $query);
	if($result){
        $msg= "Data deleted successfully";
        $msgClass="alert-success";
	}
	else {
        $msg= "Data deleted successfully";
        $msgClass="alert-danger";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <!-- Data Tables -->
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">

      <!-- Modal CSS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
   
    <!-- Title  -->
    <title>Graph</title>   
 </head>

  <body>
    <h2 style = "text-align: center; padding: 20px; background-color: #333; color: #fff;">Results </h2>
    <div class = "container" style = "margin-top: 40px; padding: 30px;">
    <?php
     if (isset($msg)) { ?>
        <div class="form-group">
            <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?>
            </div>
        </div>
        <?php
        }
	?>
  
     <button type="button" class="btn btn-info btn-sm mb-5" style="float:right" data-toggle="modal" data-target="#myModal">Open Modal</button>

   

    <table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No#</th>
                <th>Time</th>
                <th>Humidity</th>
                <th>Temperature</th>
                <th>Smoke</th>
                <th>Sound</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>


<?php
    require 'db_connect.php';
    $sql = "SELECT * FROM bar_chart";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $i = 0;
        while($row = $result->fetch_assoc()) {
            $time          =  $row["time"];
            $humidity      =  $row["humidity"];       
            $temperature   =  $row["temperature"];        
            $smoke         =  $row["smoke"];
            $sound         =  $row["sound"];
?>

            <tr>
                <td><?php $i++; echo $i; ?></td>
                <td><?php echo $time; ?></td>
                <td><?php echo $humidity; ?></td>
                <td><?php echo $temperature; ?></td>
                <td><?php echo $smoke; ?></td>
                <td><?php echo $sound; ?></td>
                <td>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                        <a href="index.php?id=<?php echo $id; ?>"><button class="btn btn-danger btn-sm" name="del_data"><i class="fas fa-trash"></i></button></a>
                    </form>
                </td>
             <?php }  ?>
            </tr>
         <?php } ?>  
     </tbody>
  </table>



  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Electronic Configuration</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <input type="text" name="humidity" class="form-control" placeholder="Enter Humidity">
            </div>
          
              <div class="form-group">
                <input type="text" name="temperature" class="form-control" placeholder="Enter Temperature">
            </div>

              <div class="form-group">
                <input type="text" name="smoke" class="form-control" placeholder="Enter Smoke">
            </div>

              <div class="form-group">
                <input type="text" name="sound" class="form-control" placeholder="Enter Sound">
            </div>

            <input type="submit" value="Submit" name="submit" class="btn btn-success btn-sm">
           </form> 
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



    <button class = "btn btn-primary btn-sm"><a href = "chart.php" style = "text-decoration: none; color: #fff;"><i class="fas fa-chart-bar"></i> Gprahical Results</a></button>


    <script src="https://code.jquery.com/jquery-3.4.0.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
    <!-- Style CSS -->
    </body>
</html>