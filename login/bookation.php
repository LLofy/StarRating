<?php	include("include/conection1.php"); ?>

<?php
        if ($stmt = $mysqli->prepare('SELECT * FROM students ORDER BY name LIMIT ?,?')) {
            // Calculate the page to get the results we need from our table.
            $calc_page = ($page - 1) * $num_results_on_page;
            $stmt->bind_param('ii', $calc_page, $num_results_on_page);
            $stmt->execute(); 
            // Get the results...
            $result = $stmt->get_result();
            $stmt->close();
        }
?>
        <table>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Join Date</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['joined']; ?></td>
        </tr>
        <?php endwhile; ?>
        </table>

        <?php if (ceil($total_pages / $num_results_on_page) > 0): ?>
        <?php	include("pagination.php"); ?>
        <?php endif; ?>