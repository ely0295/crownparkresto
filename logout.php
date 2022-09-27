<?php
	session_start();
	include('connect.php');
	if(isset($_REQUEST['action'])){
		$getaction = $_REQUEST['action'];
		if($getaction = "out"){
			session_destroy();
			?>
			<script>
				window.location.href = "index.php";
			</script>
				<?php
		}
	}
	
?>
