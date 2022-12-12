<?php
require '../../db/dbcon.php';

$query = "
  SELECT  id_clients AS id,
          client_name AS name
  FROM    clients
  WHERE   is_active = b'1'
";

$clients = mysqli_query($con, $query);
$clientsFetched = mysqli_fetch_all($clients);

//gets the id project from db
require '../../db/project.php';
if (isset($_GET['id'])) {
  $project = getProjectById($con, $_GET['id']);

  //if returns empty
  if (empty($project)) {
    // redirect to listProjects
    header('Location: ../../listProjects.php');
  }
} else {
  // if is not redirect to listProjects
  header('Location: ../../listProjects.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Project</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../projects/projects.css">

  <script src="https://unpkg.com/feather-icons"></script>

</head>

<body>
  <div class="container mt-5">
    <?php include('../../components/message.php'); ?>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a href="./listProjects.php" class="btn btn-danger float-start">
              <i data-feather="arrow-left"></i>
            </a>

            <h4 class="text-center">Edit Project</h4>
          </div>
          <div class="card-body">
            <form action="../../db/project.php" method="POST">
              <input type="hidden" name="update_project" value="1">
              <input type="hidden" name="project_id" value="<?= $project['id']; ?>">

              <div class="mb-3 mb-3">
                <label>Project Name</label>
                <input type="text" name="client_name" value="<?= $project['project_name']; ?>" class="form-control">
              </div>

              <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea class='form-control' id="descriptionProject" rows="3" name="description"><?= $project['description']; ?></textarea>
              </div>

              <div class="row">
                <div class="form-group col-6">
                  <label for="id_clients">Cliente</label>
                  <select class="form-control" id="selectClient" name="id_clients">
                    <?php if (empty($clientsFetched)) { ?>
                      <option disabled selected>Não há clientes cadastrados</option>
                    <?php } else { ?>
                      <option disabled selected>Selecione</option>

                      <?php foreach ($clients as $client) { ?>
                        <option value="<?= $client['id'] ?>" <?= ($client['id'] == $project['id_clients']) ? "selected" : "" ?>>
                          <?= $client['name'] ?>
                        </option>
                      <?php } ?>
                    <?php } // endif (empty($cients))
                    ?>
                  </select>
                </div>

                <div class="form-group col-6 mb-3">
                  <label for="id_clients_intermediary">Cliente Intermediário</label>
                  <select class="form-control" id="selectClient" name="id_clients_intermediary">
                    <?php if (empty($clientsFetched)) { ?>
                      <option disabled selected>Não há clientes cadastrados</option>
                    <?php } else { ?>
                      <option disabled selected>Selecione</option>

                      <?php foreach ($clients as $client) { ?>
                        <option value="<?= $client['id'] ?>" <?= ($client['id'] == $project['id_clients_intermediary']) ? "selected" : "" ?>>
                          <?= $client['name'] ?>
                        </option>
                      <?php } ?>
                    <?php } //endif (empity($clients))
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group mb-3">
                <label class="font-normal">Prazo do Projeto</label>
                <input type="date" id="deadline_date" name="deadline_date" class="form-control" value="<?= $project['deadline_date']; ?>">
              </div>

              <div class=" form-group mb-3">
                <label for="value">Preço do Projeto</label>
                <input type="number" step="0.01" class="form-control" id="valueProject" name="value" value="<?= $project['value']; ?>">
              </div>

              <div class="form-group mb-3">
                <label for="value_observations">Observação do Preço</label>
                <textarea class='form-control' id="descriptionProject" rows="3" name="value_observations"><?= $project['value_observations']; ?></textarea>
              </div>

              <div class="form-group mb-3">
                <label for="project_observations">Observação do Projeto(Opcional)</label>
                <textarea class='form-control' id="descriptionProject" rows="3" name="project_observations"><?= $project['project_observations']; ?></textarea>
              </div>

              <div class="form-group mb-3">
                <button class="btn btn-primary">Update Project </button>
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
