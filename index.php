<?php
session_start();
require './db/dbcon.php';
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <title>Task Manager</title>
</head>

<body>

  <div class="container mt-4">
    <div class="text-center">
      <h1 class="title-main">Task Manager</h1>

      <div class="d-grid gap-2 col-6 mx-auto">
        <a href="pages/clients/listClient.php" class="btn btn-primary" type="button">Clients</a>

        <a href="pages/projects/listProjects.php" class="btn btn-primary" type="button">Projects</a>

      </div>

    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
