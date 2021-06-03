
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">	 
		<?php	include("include/navbar.php"); ?>
		<?php	include("include/time.php"); ?>
		<div class="content">
			<h2> Reviews </h2>
		</div>
		<?php
			$mysqli = mysqli_connect('localhost', 'root', '', 'phpreviews');

			// Get the total number of records from our table "books".
			$total_pages = $mysqli->query('SELECT COUNT(*) FROM  reviews')->fetch_row()[0];

			$pages = $mysqli->query('SELECT COUNT(*) FROM  reviews')->fetch_row()[0];
		
			echo $pages;

			// Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
			$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
			
			// Number of results to show on each page.
			$num_results_on_page = 1;        
		?>
		<?php
				if ($stmt = $mysqli->prepare('SELECT * FROM reviews ORDER BY id LIMIT ?,?')) {
					// Calculate the page to get the results we need from our table.
					$calc_page = ($page - 1) * $num_results_on_page;
					$stmt->bind_param('id', $calc_page, $num_results_on_page);
					$stmt->execute(); 
					// Get the results...
					$result = $stmt->get_result();
					$stmt->close();
				}
		?>
		<table>  
			<tr>           
				<th>ID</th>                     
				<th>NOME</th>                          
				<th></th>  
			</tr>
			<?php while ($row = $result->fetch_assoc()): ?>
			<tr>
				<td><?php echo $row['id'];?>
				<td><?php echo $row['name'];?>
			</tr>
			<?php endwhile; ?>
		</table>

		<?php if (ceil($total_pages / $num_results_on_page) > 0): ?>
		<?php	include("pagination.php"); ?>
		<?php endif; ?>
		     
	</body>
</html>  