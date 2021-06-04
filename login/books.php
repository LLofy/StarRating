
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">	 
		<nav class="navtop">
			<div>
				<h1><a  href=home.php>Website Title</a></h1>
				<a href="books.php"><i class="far fa-star"></i>Livros</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Livros </h2>
		</div>

		<?php
			$mysqli = mysqli_connect('localhost', 'root', '', 'pagina');

			// Get the total number of records from our table "books".
			$total_pages = $mysqli->query('SELECT COUNT(*) FROM books')->fetch_row()[0];

			// Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
			$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
			
			// Number of results to show on each page.
			$num_results_on_page = 10;        	
		?>

		<?php
			if ($stmt = $mysqli->prepare('SELECT * FROM books ORDER BY id LIMIT ?,?')) {
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
            <th>NAME</th>           
            <th>DESCRIPTION</th>            
            <th>Nota</th>                          
            <th></th>  
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo "<a href='".  $row['link']. "'>" . $row['name'] . "</a>";?>
            <td><?php echo $row['desc'];?>
            <td><?php echo "5";?>
            <td><?php echo "<a class='button' href='".  $row['link']. "'> AVALIE "  . "</a>";?>
        </tr>
        <?php endwhile; ?>
        </table>

        <?php if (ceil($total_pages / $num_results_on_page) > 0): ?>
			<ul class="pagination">
				<?php if ($page > 1): ?>
				<li class="prev"><a href="books.php?page=<?php echo $page-1 ?>">Prev</a></li>
				<?php endif; ?>

				<?php if ($page > 3): ?>
				<li class="start"><a href="books.php?page=1">1</a></li>
				<li class="dots">...</li>
				<?php endif; ?>

				<?php if ($page-2 > 0): ?><li class="page"><a href="books.php?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
				<?php if ($page-1 > 0): ?><li class="page"><a href="books.php?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php endif; ?>

				<li class="currentpage"><a href="books.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>

				<?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page"><a href="books.php?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php endif; ?>
				<?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page"><a href="books.php?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php endif; ?>

				<?php if ($page < ceil($total_pages / $num_results_on_page)-2): ?>
				<li class="dots">...</li>
				<li class="end"><a href="books.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
				<?php endif; ?>

				<?php if ($page < ceil($total_pages / $num_results_on_page)): ?>
				<li class="next"><a href="books.php?page=<?php echo $page+1 ?>">Next</a></li>
				<?php endif; ?>
			</ul>
        <?php endif; ?>
		
	</body>
</html>   