<?php

session_start();

include 'dbs_conn.php';

if(isset($_SESSION['$username']) && $_SESSION['role']=='Seller'){
    $username = $_SESSION['$username'];

?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Items Sold'],
         <?php
         for($i=1;$i<=12;$i++){
         	if($i==1){
         		$month='January';
         	}
         	if($i==2){
         		$month='Feb';
         	}
         	if($i==3){
         		$month='March';
         	}
         	if($i==4){
         		$month='April';
         	}
         	if($i==5){
         		$month='May';
         	}
         	if($i==6){
         		$month='June';
         	}
         	if($i==7){
         		$month='July';
         	}
         	if($i==8){
         		$month='August';
         	}
         	if($i==9){
         		$month='Sept';
         	}
         	if($i==10){
         		$month='October';
         	}
         	if($i==11){
         		$month='Nove';
         	}
         	if($i==12){
         		$month='Dece';
         	}
         	$totalqty = 0;
         	$sql = "SELECT historycart FROM users WHERE role='Customer'";
         $result = mysqli_query($conn,$sql);
         while($row=mysqli_fetch_assoc($result)){
         	$historycart = unserialize(base64_decode($row['historycart']));
         	foreach ($historycart as $key => $value) {
         		if($value['item_seller']==$username){
         			if($value['month_sold']==$i){
         				$totalqty+=$value['item_qty'];
         			}
         		}
         	}
     }
         echo "['{$month}',{$totalqty}],";
 }
         ?>
        ]);

        var options = {
          chart: {
            title: 'Analysis',
            subtitle: 'Items Sold during each month',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div id="columnchart_material" style="width: 800px; height: 500px; margin:auto;"></div>
    <div style='margin:auto; width:50%;'>
        <p>Click <a href="seller-page.php">Close</a> to close</p>
    </div>
  </body>
</html>

<?php
}
else{
    header('Location:login-page.php');
}