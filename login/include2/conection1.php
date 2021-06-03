<?php
        $mysqli = mysqli_connect('localhost', 'root', '', 'pagina');

        // Get the total number of records from our table "books".
        $total_pages = $mysqli->query('SELECT COUNT(*) FROM books')->fetch_row()[0];

        // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

        // Number of results to show on each page.
        $num_results_on_page = 1;        
?>