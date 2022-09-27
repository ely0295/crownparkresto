<?php session_start(); 
//check if has access right
if(!(isset($_SESSION['signed_in'])) ){
	?>
	<script>
		window.location.href = "error404.html";
	</script>
	<?php
}

?>