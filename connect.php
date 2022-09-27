
 <?php
		/*$conn = mysqli_connect("localhost","id15669428_edgeusername","Paytsana:2020","id15669428_edgedb_v2");
	$conn = mysqli_connect("localhost","root","","loid_db");
	$conn = new PDO mysqli_connect("localhost","root","","loid_db");

    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }
	*/
	$servername = "localhost";
	$username = "root";
	$password = "mylocalpass";
	$dbname = "crown_db";
	try {
	  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	  // set the PDO error mode to exception
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
	  echo "Connection failed: " . $e->getMessage();
	}
?>