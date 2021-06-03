<?php	include("include2/conection2.php"); ?>

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