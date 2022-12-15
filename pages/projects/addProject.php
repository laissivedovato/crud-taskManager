<?php
//initializing the session
session_start();
require '../../db/dbcon.php';

//select the id project from db and if active deactive it, and if is deactive ative the client registration
$query = "
  SELECT  id_clients AS id,
          client_name AS name
  FROM    clients
  WHERE   is_active = b'1'
";

$clients = mysqli_query($con, $query);
$clientsFetched = mysqli_fetch_all($clients);
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="./projects.css">

  <script src="https://unpkg.com/feather-icons"></script>

</head>

<body>
  <div class="container mt-4">
    <?php include('../../components/message.php'); ?>

    <div class="card">
      <div class="card-header">
        <a href="./listProjects.php" class="btn btn-danger float-start ">
          <i data-feather="arrow-left"></i>
        </a>
        <h4 class="text-center">Add Project</h4>
      </div>
      <div class="card-body">
        <form action="../../db/project.php" method="POST">
          <input type="hidden" name="add_project" value="1">

          <div class="form-group">
            <label class="font-normal" for="project_name">Nome do Projeto</label>
            <input class="form-control" type="text" name="project_name" placeholder="Enter Project name">
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="descriptionProject" rows="3" name="description"></textarea>
          </div>

          <div class="form-group">
            <label for="id_clients">Cliente</label>
            <select class="form-control" id="selectClient" name="id_clients">
              <?php if (empty($clientsFetched)) { ?>
                <option disabled selected>Não há clientes cadastrados</option>
              <?php } else { ?>
                <option disabled selected>Selecione</option>

                <?php foreach ($clients as $client) { ?>
                  <option value="<?= $client['id'] ?>"><?= $client['name'] ?></option>
                <?php } ?>
              <?php } // endif (empty($cients))
              ?>
            </select>
          </div>

          <div class="form-group">
            <label for="id_clients_intermediary">Cliente Intermediário</label>
            <select class="form-control" id="selectClient" name="id_clients_intermediary">
              <?php if (empty($clientsFetched)) { ?>
                <option disabled selected>Não há clientes cadastrados</option>
              <?php } else { ?>
                <option disabled selected>Selecione</option>

                <?php foreach ($clients as $client) { ?>
                  <option value="<?= $client['id'] ?>"><?= $client['name'] ?></option>
                <?php } ?>
              <?php } //endif (empity($clients))
              ?>
            </select>
          </div>

          <div class="form-group">
            <label class="font-normal">Prazo do Projeto</label>
            <input type="date" id="deadline_date" name="deadline_date" value="2022-06-12" class="form-control">
          </div>

          <div class="form-group">
            <label for="value">Preço do Projeto</label>
            <input type="number" step="0.01" class="form-control" id="valueProject" name="value">
          </div>

          <div class="form-group">
            <label for="value_observations">Observação do Preço</label>
            <textarea class="form-control" id="valueObservations" rows="2" name="value_observations"></textarea>
          </div>

          <div class="form-group">
            <label for="project_observations">Observações do Projeto(Opcional)</label>
            <textarea class="form-control" id="projectObservations" rows="2" name="project_observations"></textarea>
          </div>

          <div class="mt-3">
            <button type="submit" name="submit" class="btn btn-primary">Save Project</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script>
    feather.replace();
  </script>

</body>

</html>
