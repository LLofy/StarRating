<?php	include("include/conection1.php"); ?>

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
        <?php	include("pagination.php"); ?>
        <?php endif; ?>