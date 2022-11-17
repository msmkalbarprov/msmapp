<!DOCTYPE html>
<html>
<head>
	<title><?=$title;?></title>
	<style type="text/css">
		body{
			font-family: sans-serif;
		}
		table{
			margin: 20px auto;
			border-collapse: collapse;
		}
		table th,
		table td{
			/*border: 1px solid #3c3c3c;*/
			padding: 3px 8px;
			vertical-align: middle;

		}
		a{
			background: blue;
			color: #fff;
			padding: 8px 10px;
			text-decoration: none;
			border-radius: 2px;
		}
	</style>
</head>
<body>

	<?php
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=".$filename.".xls");
	?>

	<?=$html;?>

</body>
</html>