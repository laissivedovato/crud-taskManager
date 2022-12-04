<?php
//initializing the session
session_start();
require '../../db/dbcon.php';
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./clients.css">

  <script src="https://unpkg.com/feather-icons"></script>

  <title>Task Manager</title>
</head>
<body>
  <div class="container mt-4">

    <?php include('../../components/message.php'); ?>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a href="../../index.php" class="btn btn-danger float-start">
              <i data-feather="arrow-left"></i>
            </a>
            <a href="addClient.php" class="btn btn-primary float-end">
              <i data-feather="plus"></i>
            </a>

            <h4 class="text-center">Clients</h4>
          </div>
          <div class="card-body">

            <?php
            //select the id client from db and if active deactive it, and if is deactive ative the client registration
              $query = "
                    SELECT  id_clients AS id,
                            client_name AS name,
                            IF(is_active = b'1', 1, 0) AS active
                    FROM    clients
                  ";
              $clients = mysqli_query($con, $query);

              if (mysqli_num_rows($clients) > 0) {
            ?>

              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th id="tableID">ID</th>
                    <th>Client Name</th>
                    <th id="tableActions">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($clients as $client) { ?>
                    <!-- editing button -->
                    <tr>
                      <td><?= $client['id']; ?></td>
                      <td><?= $client['name']; ?></td>
                      <td class="tableActionsLines">
                        <a href="./editClient.php?id=<?= $client['id']; ?>" class="btn btn-warning btn-sm text-white">
                          <i data-feather="edit"></i>
                        </a>

                        <?php if ($client['active'] == 1) { ?>
                          <!-- deactivate button -->
                          <button type="button" class="btn btn-sm btn-danger btn-deactivate-client" data-client_id="<?= $client['id']; ?>" data-bs-toggle="modal" data-bs-target="#toggleActivateClientModal">
                            <i data-feather="x"></i>
                          </button>
                        <?php } else { ?>
                          <!-- activate button -->
                          <button type="button" class="btn btn-sm btn-success btn-activate-client" data-client_id="<?= $client['id']; ?>" data-bs-toggle="modal" data-bs-target="#toggleActivateClientModal">
                            <i data-feather="check"></i>
                          </button>
                        <?php } // endif ?>
                      </td>
                    </tr>
                  <?php } //endforeach ?>
                </tbody>
              </table>
            <?php
            } else {
              echo "<h5> No Record Found </h5>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Modal to deactive client -->
  <div class="modal fade" id="toggleActivateClientModal" tabindex="-1" aria-labelledby="toggleActivateClientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="toggleActivateClientModalLabel">Desativar clientes</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div id="modalBody" class="modal-body">
          Deseja desativar este cliente?
        </div>
        <div class="modal-footer">
          <form action="../../db/clients.php" method="POST">
            <input id="toggleActivateClientInput" type="hidden" name="toggle_activate_client" value=''>
            <input id="clientIdInput" type="hidden" name="client_id" value=''>

            <button class="btn btn-primary">Sim</button>
          </form>

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script> feather.replace(); </script>
  <script src="../js/clientButtons.js"></script>
</body>
</html>
