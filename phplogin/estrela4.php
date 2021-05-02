<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset= "UTF-8">
     <link rel="stylesheet" type="text/css" href="style.css"> 
     <link rel="stylesheet" type="text/css" href="style2.css"> 
    <title>Star rating using pure CSS</title>
</head>
<body>	 
<nav class="navtop">
			<div>
				<h1>Website Title</h1>
				<a href="estrela4.php"><i class="far fa-star"></i>Star rating</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
</nav>

	<div class="item"> <br>Item a 
		<form action="estrela4.php" method="POST">		
			<fieldset class="rating">
									<input type="radio" id="field1_star5" name="rating1" value="5" /><label class = "full" for="field1_star5"></label>
									
									<input type="radio" id="field1_star4" name="rating1" value="4" /><label class = "full" for="field1_star4"></label>
									
									<input type="radio" id="field1_star3" name="rating1" value="3" /><label class = "full" for="field1_star3"></label>
									
									<input type="radio" id="field1_star2" name="rating1" value="2" /><label class = "full" for="field1_star2"></label>
									
									<input type="radio" id="field1_star1" name="rating1" value="1" /><label class = "full" for="field1_star1"></label>
									
			</fieldset>
				<button type="button" class="button1">Avaliar!</button> 
			
		</form>
	</div>
	
	<div class="nota" name="nota">
		nota <span> 4,2 </span>
	</div> 
	<div class="avaliacoes" name="avaliacoes"> avaliacoes <span> 5 </span> </div> 

	<div class="item"> Item b 
        <fieldset class="rating">
								<input type="radio" id="field2_star5" name="rating2" value="5" /><label class = "full" for="field2_star5"></label>
								
								<input type="radio" id="field2_star4" name="rating2" value="4" /><label class = "full" for="field2_star4"></label>
								
								<input type="radio" id="field2_star3" name="rating2" value="3" /><label class = "full" for="field2_star3"></label>
								
								<input type="radio" id="field2_star2" name="rating2" value="2" /><label class = "full" for="field2_star2"></label>
								
								<input type="radio" id="field2_star1" name="rating2" value="1" /><label class = "full" for="field2_star1"></label>
								
							</fieldset>
				<button type="button" class="button1">Avaliar!</button> 
	</div>
	<div class="nota">
		nota <span> 4,2 </span>
	</div> 
	<div class="avaliacoes"> avaliacoes <span> 5 </span> </div> 

	<div class="item"> Item c 
        <fieldset class="rating">
								<input type="radio" id="field3_star5" name="rating3" value="5" /><label class = "full" for="field3_star5"></label>
								
								<input type="radio" id="field3_star4" name="rating3" value="4" /><label class = "full" for="field3_star4"></label>
								
								<input type="radio" id="field3_star3" name="rating3" value="3" /><label class = "full" for="field3_star3"></label>
								
								<input type="radio" id="field3_star2" name="rating3" value="2" /><label class = "full" for="field3_star2"></label>
								
								<input type="radio" id="field3_star1" name="rating3" value="1" /><label class = "full" for="field3_star1"></label>
								
							</fieldset>
				<button type="button" class="button1">Avaliar!</button> 
	<div class="nota">
		nota <span> 4,2 </span>
	</div> 
	<div class="avaliacoes"> avaliacoes <span> 5 </span> </div> 
						
	</div>	
	<div class="item"> Item d 
        <fieldset class="rating">
								<input type="radio" id="field4_star5" name="rating4" value="5" /><label class = "full" for="field4_star5"></label>
								
								<input type="radio" id="field4_star4" name="rating4" value="4" /><label class = "full" for="field4_star4"></label>
								
								<input type="radio" id="field4_star3" name="rating4" value="3" /><label class = "full" for="field4_star3"></label>
								
								<input type="radio" id="field4_star2" name="rating4" value="2" /><label class = "full" for="field4_star2"></label>
								
								<input type="radio" id="field4_star1" name="rating4" value="1" /><label class = "full" for="field4_star1"></label>
								
							</fieldset>
				<button type="button" class="button1">Avaliar!</button> 
	</div>
	
	<div class="nota">
		nota <span> 4,2 </span>
	</div> 
	<div class="avaliacoes"> avaliacoes <span> 5 </span> </div> 
	
	<div class="item"> Item e 
        <fieldset class="rating">
								<input type="radio" id="field5_star5" name="rating5" value="5" /><label class = "full" for="field5_star5"></label>
								
								<input type="radio" id="field5_star4" name="rating5" value="4" /><label class = "full" for="field5_star4"></label>
								
								<input type="radio" id="field5_star3" name="rating5" value="3" /><label class = "full" for="field5_star3"></label>
								
								<input type="radio" id="field5_star2" name="rating5" value="2" /><label class = "full" for="field5_star2"></label>
								
								<input type="radio" id="field5_star1" name="rating5" value="1" /><label class = "full" for="field5_star1"></label>
								
							</fieldset>
				<button type="button" class="button1">Avaliar!</button> 
							
	<div class="nota">
		nota <span> 4,2 </span>
	</div> 
	<div class="avaliacoes"> avaliacoes <span> 5 </span> </div> 

	</div>
</body>

</html>