<?php session_start() ?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-4">
    <?php include('../../components/message.php'); ?>

    <div class="card">
      <div class="card-header">
        <a href="listClient.php" class="btn btn-danger float-start">Back</a>
        <h4 class="text-center"> Add Client</h4>
      </div>
      <div class="card-body">
        <form action="../../db/clients.php" method="POST">
          <input type="hidden" name="add_client" value="1">

          <div class="form-group">
            <label class="font-normal" for="client_name">Client Name</label>
            <input class="form-control" type="text" name="client_name"
              placeholder="Enter client name"
            >
          </div>

          <div class="mt-3">
            <button type="submit" name="submit" class="btn btn-primary">Save Client </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>
