
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style2.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<div class="content">
			<nav class="navtop">
				<div>
					<div class="title"><h1><a  href=home.php>Website Title</a></h1></div>
					<div class="pages">
						<a href="books.php"><i class="far fa-star"></i>Livros</h1>
						<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
						<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
					</div>
				</div>
			</nav>
			<?php
				// Below function will convert datetime to time elapsed string.
				function time_elapsed_string($datetime, $full = false) {
					date_default_timezone_set('America/Sao_Paulo');
					$now = new DateTime;
					$ago = new DateTime($datetime);
					$diff = $now->diff($ago);
					$diff->w = floor($diff->d / 7);
					$diff->d -= $diff->w * 7;
					$string = array('y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second');
					foreach ($string as $k => &$v) {
						if ($diff->$k) {
							$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
						} else {
							unset($string[$k]);
						}
					}
					if (!$full) $string = array_slice($string, 0, 1);
					return $string ? implode(', ', $string) . ' ago' : 'just now';
				}?>
			<?php
				$mysqli = mysqli_connect('localhost', 'root', '', 'phpreviews');

				
				$a = 1;	$b=0; $c=0; $d=1;
				// Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
				$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
				$table = "SELECT * FROM reviews where page_id = $page ORDER BY submit_date DESC";
				$result = $mysqli->query($table);
				$nota = mysqli_query($mysqli,"SELECT AVG(rating) FROM reviews WHERE page_id =$page");
				$resultado = json_encode(mysqli_fetch_assoc($nota));
				if (preg_match_all('/\d+(\.\d+)?/', $resultado, $matches)) {
					$dim = $matches[0];
				}
				$resultado2 = $dim[0];
			?>
			<h2> Reviews Avarage <?php echo($resultado2);?> </h2>	
			<div class="reviews">
				<div class="write">
					<button class="show" onclick="show()">Enviar rating</button>
					<div id="myDIV">
						<form action="reviews.php" method="post">
							<input type="text" id="nome" name="nome" value="nome"><br>							
							<ul class="rating">
								<li> 
									<span class="ratingSelector">
										<input type="radio" name="radio1" id="Degelijkheid-1-5" value="1" class="radio"/>
										<label class="full" for="Degelijkheid-1-5"></label>
										<input type="radio" name="radio1" id="Degelijkheid-2-5" value="2" class="radio"/>
										<label class="full" for="Degelijkheid-2-5"></label>
										<input type="radio" name="radio1" id="Degelijkheid-3-5" value="3" class="radio"/>
										<label class="full" for="Degelijkheid-3-5"></label>
										<input type="radio" name="radio1" id="Degelijkheid-4-5" value="4" class="radio"/>
										<label class="full" for="Degelijkheid-4-5"></label>
										<input type="radio" name="radio1" id="Degelijkheid-5-5" value="5" class="radio"/>
										<label class="full" for="Degelijkheid-5-5"></label>
									</span>
								</li>
							</ul>
							<input type="text" id="comentario" name="comentario" value="comentário aqui"><br><br>							
							<input type="hidden" id="pagina" name="pagina" value=<?php echo ('"' .$page . '"') ?> style:>	
							<input class="envio" type="submit" value="Enviar">
						</form>
					</div>
				</div>
				<div class="list">
					<?php
						while($row = $result->fetch_assoc()) {
							if (($d-1)%10==0) {
								echo "<div class='page" .$a++  ."'>";
								$b++;
							}
							?>
							<div class="review">
								<h3 class="name"><?=htmlspecialchars($row['name'], ENT_QUOTES)?></h3>
									<div classs=rate>
										<span class="rating"><?=str_repeat('&#9733;', $row['rating'])?></span>
										<span class="date"><?=time_elapsed_string($row['submit_date'])?></span>
									</div>
								<p class="content"><?=htmlspecialchars($row['content'], ENT_QUOTES)?></p>
							</div>
							<?php
								$d++;
								if (($d-1)%10==0) {
								echo "</div>";
								$c++;	
								}
						}
						// Number of results to show on each page.  
						if ($c<$b) {
							echo "</div>";
							$c++;	
						}
					?>
				</div>
			</div>		
			<div class="table">
				<div class="controls">
					<div class="first"></div>
					<div class="prev">PREV</div>
					<div class="numbers">
						1
					</div>
					<div class="next">NEXT</div>
					<div class="last"></div>
				</div>
			</div>	
		</div>	     
	</body>
</html>  
<script type="text/javascript" src="function.js"></script> 
