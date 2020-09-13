<?php
include_once("Views/header.php");
?>

<?php  
if( $_SESSION["token"] ){
	echo('
		<div class="jumbotron my-5 bg-light">
		<div class="container-md">
		<div id="mainTable"></div>
		</div>
		</div>
		');
}
else header("Location: login.php");
?>

<?php
include_once("Views/footer.php");
?>

<?php  
if( isset($_POST["dashboard"]) ){
	switch( $_POST["dashboard"] ){
		case "access":
		echo('
			<script type="text/javascript">
			$(document).ready(function(){
				$("#mainTable").load("Views/tables/access.php");
				});
				</script>
				');
		break;

		case "users":
		echo('
			<script type="text/javascript">
			$(document).ready(function(){
				$("#mainTable").load("Views/tables/users.php");
				});
				</script>
				');
		break;

		case "files":
		echo('
			<script type="text/javascript">
			$(document).ready(function(){
				$("#mainTable").load("Views/tables/files.php");
				});
				</script>
				');
		break;

		case "change-info":
		echo('
			<script type="text/javascript">
			$(document).ready(function(){
				$("#mainTable").load("Views/tables/info.php");
				});
				</script>
				');
		break;

		case "category":
		echo('
			<script type="text/javascript">
			$(document).ready(function(){
				$("#mainTable").load("Views/tables/category.php");
				});
				</script>
				');
		break;

		case "support":
		echo('
			<script type="text/javascript">
			$(document).ready(function(){
				$("#mainTable").load("Views/tables/support.php");
				});
				</script>
				');
		break;

		default: ;break;
	}
}
?>

</body>
</html>