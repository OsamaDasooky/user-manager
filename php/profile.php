<?php
require_once 'connectuon.php';
session_start();

if (!isset($_SESSION['currentUser'])) {
    header('Location: http://localhost/curd_task_3/login.html');
    exit();
}
if ($_SESSION['role'] == "admin") {
    header('Location: http://localhost/curd_task_3/admin.php');
    exit();
}
?>
<?php
if(isset($_GET['logout']))
{
    session_destroy();
    echo '<script> alert("hi")</script>';
    header('Location: http://localhost/curd_task_3/login.html');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled">Disabled</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search" method='get'action="<?php basename( $_SERVER['PHP_SELF'] )?>">
                        <button class="btn btn-danger" name="logout" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <h3 class='m-5'>Welcome <?php $fname= explode(' ', $_SESSION['FullName']); echo$fname[0]; ?></h3>
        <div class="container mt-5 justify-content-center">
            <div class="card mb-4" style="max-width: 700px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/506/506185.png" class="img-fluid rounded-start"
                            alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $_SESSION['FullName'] ?></h5>
                            <p class="card-text">Email : <?php echo $_SESSION['currentUser'] ?> </p>
                            <p class="card-text">Phone Number : <?php echo $_SESSION['Mobile'] ?> </p>
                            <p class="card-text">Birthday : <?php echo $_SESSION['Birthday'] ?> </p>
                            <p class="card-text"><small class="text-muted">Last login <?php echo $_SESSION['lastLogin']  ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>

