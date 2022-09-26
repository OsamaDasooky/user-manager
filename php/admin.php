<?php
require_once 'connectuon.php';

session_start();

if (!isset($_SESSION['currentUser'])) {
    header('Location: http://localhost/curd_task_3/login.html');
    exit();
}


if(isset($_GET['logout']))
{
    session_destroy();
    echo '<script> alert("hi")</script>';
    header('Location: http://localhost/curd_task_3/login.html');
}


// Code for record deletion
if(isset($_REQUEST['del']))
{
//Get row id
$uid=$_GET['del'];
//Qyery for deletion
$sql = "DELETE  FROM info WHERE  Email = '$uid'";
// Prepare query for execution
$query = $conn->prepare($sql);
// Query Execution
$query -> execute();
// Mesage after updation
echo "<script>alert('Record Updated successfully');</script>";
// Code for redirection
echo "<script>window.location.href='http://localhost/curd_task_3/php/admin.php'</script>"; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Patients Information </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        
    </style>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://getbootstrap.com/dist/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <table id="mytable" class="table table-bordred table-striped">                 
    <thead>
        <th>Full Name</th>
        <th>Email </th>
        <th>Password </th>
        <th>date created</th>
        <th>date last login </th>
        <th>role</th>
        <th>Edit</th>
        <th>Delete</th>
    </thead>
<?php
    $insert = $conn->prepare("SELECT * FROM info ");
    $insert->execute();
    $results=$insert->fetchAll(PDO::FETCH_OBJ);
    foreach($results as $result)
    {  
        ?>
    <tr>
        <td><?php echo htmlentities($result->FullName);?></td>
        <td><?php echo htmlentities($result->Email);?></td>
        <td><?php echo htmlentities($result->Password);?></td>
        <td><?php echo htmlentities($result->created_date);?></td>
        <td><?php echo htmlentities($result->lastLogin);?></td>
        <td><?php echo htmlentities($result->role);?></td>
        <td><a href="update.php?id=<?php echo htmlentities($result->Email);?>"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil" style="font-size:16px;"></span></button></a></td>
        <td><a href="admin.php?del=<?php echo htmlentities($result->Email);?>"><button class="btn btn-danger btn-xs " onClick="return confirm('Do you really want to delete');"><span class="glyphicon glyphicon-trash" style="font-size:16px;"></span></button></a></td>

    </tr>
    <?php } ?>
</table>
    <form class="d-flex" role="search" method='get'action="<?php basename( $_SERVER['PHP_SELF'] )?>">
        <button class="btn btn-danger" name="logout" type="submit">Logout</button>
    </form>
</div>
</body>
</html>