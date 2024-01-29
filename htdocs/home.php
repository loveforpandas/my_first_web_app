<?php
require_once('db_connection.php');
$query = "select * from connection_requests  ";
$result = mysqli_query($mysqli, $query);
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch data from database</title>
</head>
<body >
    




<div class="container">

<div class="row">
<div class="card">
    <div class=card_header>
<h2> Fetch data form database </h2>
</div>

<div class ="card-body">
    <table>
        <tr>
</td> User id </td>
</td> Username </td>
</td> email</td>
</td> message</td>


<tr>
<?php

while ($row = mysqli_fetch_assoc($result))
{
?>

<td><?php echo $row ['name']; ?> </td>
<td> <?php echo $row ['email']; ?> </td>  
<td> <?php echo $row ['message']; ?> </td>
</tr>
<?php


}



?>

</tr>
<?php

?>
</table>


</body>
</html>