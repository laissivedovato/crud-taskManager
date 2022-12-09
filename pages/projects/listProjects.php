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

  <link rel="stylesheet" href="./projects.css">

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
            <a href="addProject.php" class="btn btn-primary float-end">
              <i data-feather="plus"></i>
            </a>

            <h4 class="text-center">Projects</h4>
          </div>
          <div class="card-body">

            <?php
            //select the id project from db and if active deactive it, and if is deactive ative the project registration
            $query = "
              SELECT      proj.id_projects                AS projectId,
                          proj.name                       AS projectName,
                          proj.deadline_date              AS projectDeadline,
                          IF(proj.is_active = b'1', 1, 0) AS active,
                          cli.client_name                 AS clientName

              FROM        projects  AS proj
              INNER JOIN  clients   AS cli    ON cli.id_clients = proj.id_clients
            ";
            $projects = mysqli_query($con, $query);

            if (mysqli_num_rows($projects) > 0) {
            ?>

              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th id="tableID">ID</th>
                    <th>Project Name</th>
                    <th>Client</th>
                    <th id="tableActions">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($projects as $project) { ?>
                    <!-- editing button -->
                    <tr>
                      <td><?= $project['projectId']; ?></td>
                      <td><?= $project['projectName']; ?></td>
                      <td><?= $project['clientName']; ?></td>
                      <td class="tableActionsLines">
                        <a href="./editProject.php <?= $project['projectId']; ?>" class="btn btn-warning btn-sm text-white">
                          <i data-feather="edit"></i>
                        </a>

                        <?php if ($project['active'] == 1) { ?>
                          <!-- deactivate button -->
                          <button type="button" class="btn btn-sm btn-danger btn-deactivate-project" data-client_id="<?= $project['projectId']; ?>" data-bs-toggle="modal" data-bs-target="#toggleActivateProjectModal">
                            <i data-feather="x"></i>
                          </button>
                        <?php } else { ?>
                          <!-- activate button -->
                          <button type="button" class="btn btn-sm btn-success btn-activate-project" data-client_id="<?= $project['projectId']; ?>" data-bs-toggle="modal" data-bs-target="#toggleActivateProjectModal">
                            <i data-feather="check"></i>
                          </button>
                        <?php } // endif
                        ?>
                      </td>
                    </tr>
                  <?php } //endforeach
                  ?>
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

  <!-- Modal to deactive project -->
  <div class="modal fade" id="toggleActivateProjectModal" tabindex="-1" aria-labelledby="toggleActivateProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="toggleActivateProjectModalLabel">Desativar Projeto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div id="modalBody" class="modal-body">
          Deseja desativar este Projeto?
        </div>
        <div class="modal-footer">
          <form action="../../db/project.php" method="POST">
            <input id="toggleActivateProjectInput" type="hidden" name="toggle_activate_project" value=''>
            <input id="projectIdInput" type="hidden" name="project_id" value=''>

            <button class="btn btn-primary">Sim</button>
          </form>

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    feather.replace();
  </script>
  <script src="../js/projectButtons.js"></script>
</body>

</html>
