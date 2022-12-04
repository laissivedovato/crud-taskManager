<?php
require '../../db/dbcon.php';

//gets the id clients from db
require '../../db/clients.php';
if (isset($_GET['id'])) {
  $client = getClientById($con, $_GET['id']);

  //if returns empty
  if (empty($client)) {
    // redirect to listClients
    header('Location: ./listClient.php');
  }
} else {
  // if is not redirect to listClients
  header('Location: ./listClient.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Client Edit</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="./clients.css">

  <script src="https://unpkg.com/feather-icons"></script>

</head>

<body>

  <div class="container mt-5">
    <?php include('../../components/message.php'); ?>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a href="./listClient.php" class="btn btn-danger float-start">
              <i data-feather="arrow-left"></i>
            </a>

            <h4 class="text-center">Client Edit</h4>
          </div>
          <div class="card-body">
            <form action="../../db/clients.php" method="POST">
              <input type="hidden" name="update_client" value="1">
              <input type="hidden" name="client_id" value="<?= $client['id']; ?>">

              <div class="mb-3">
                <label>Client Name</label>
                <input type="text" name="client_name" value="<?= $client['name']; ?>" class="form-control">
              </div>

              <div class="mb-3">
                <button class="btn btn-primary">Update Client </button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    feather.replace();
  </script>
</body>

</html>
