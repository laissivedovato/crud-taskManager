<?php

require 'dbcon.php';
session_start();

$query = "
  SELECT  id_clients AS id,
          client_name,
  FROM    clients
  WHERE   is_active = b'1'
";

// adding a new project
if (isset($_POST['add_project'])) {

//  print_r ($_POST); exit;

  //verification
  // if the project name is empty, it sets a message and redirects to editing the project sent
  if (empty($_POST['project_name'])) {
    $_SESSION['message'] = "Project name is mandatory!";
    header("Location: ../pages/projects/addProject.php");
    exit(0);
  }

  //if the description is empity, its sets a message and redirects to editing the project sent
  if (empty($_POST['description'])) {
    $_SESSION['message'] = "The Rpoject Description is mandatory!";
    header("Location: ../pages/projects/addProject.php");
    exit(0);
  }

  //if the client name is empity, its sets a message and redirects to editing the project sent
  if (empty($_POST['id_clients'])) {
    $_SESSION['message'] = "Client name is mandatory!";
    header("Location: ../pages/projects/addProject.php");
    exit(0);
  }

  // client intermediary - fazer a verificação de não ser igual ao cliente
  if (!empty($_POST['id_clients_intermediary'])) {
    if ($_POST['id_clients'] === $_POST['id_clients_intermediary']) {
      $_SESSION['message'] = "Intermediary client must be different than client";
      header("Location: ../pages/projects/addProject.php");
      exit(0);
    }
  }

  //if the deadline-date is empity, its sets a message and redirects to editing the project sent
  if (empty($_POST['deadline_date'])) {
    $_SESSION['message'] = "Deadline is mandatory!";
    header("Location: ../pages/projects/addProject.php");
    exit(0);
  }

  //if value is empity, its sets a message and redirects to editing the project sent
  if (empty($_POST['value'])) {
    $_SESSION['message'] = "The Project Price is mandatory!";
    header("Location: ../pages/projects/addProject.php");
    exit(0);
  }



  //additing a new project
  $addProject = searchProjectByName($_POST['project_name'], 0);
  if (!empty($addProject)) {
    $_SESSION['message'] = "Project name is already in use!";
    header("Location: ../pages/projects/addProject.php");
    exit(0);
  }

  //Name's project verification
  $projectName = $_POST['project_name'];
  if (!preg_match('/^[a-zA-Z\s]/', $projectName)) {
    $_SESSION['message'] = 'Name must be letters and spaces only';
    header("Location: ../pages/projects/addProject.php");
    exit(0);
  }

    // $_SESSION['message'] = 'Consegui validar todas as informacoes';
    // header('Location: ../pages/projects/listProjects.php');
    // exit(0);

  $projectName = mysqli_real_escape_string($con, $projectName);

  $dataCriacao = date("Y-m-d H:i:s");

  $insertProjectQuery = "
    INSERT INTO projects (
      name,
      description,
      id_clients,
      ".(empty($_POST['id_clients_intermediary']) ? "" : "id_clients_intermediary,")."
      creation_datetime,
      deadline_date,
      value,
      value_observations,
      project_observations
    ) VALUES (
      '{$projectName}',
      {$_POST['id_clients']},
      ".(empty($_POST['id_clients_intermediary']) ? "" : "{$_POST['id_clients_intermediary']},")."
      '{$dataCriacao}',
      '{$_POST['deadline_date']}',
      {$_POST['value']},
      '{$_POST['description']}',
      '{$_POST['value_observations']}',
      '{$_POST['project_observations']}'
    )";

  //save to db and check
  if (mysqli_query($con, $insertProjectQuery)) {
    //sucess
    $_SESSION['message'] = 'Project created successfully';
    header('Location: ../pages/projects/listProjects.php');
    exit(0);
  } else {
    //error
    $_SESSION['message'] = 'query error: ' . mysqli_error($con);;
    header('Location: ../pages/projects/listProjects.php');
    exit(0);
  }
}

// update project
if (isset($_POST['update_project'])) {
  //if the name is empty, set a message and redirect to editing the
  // project sent
  if (empty($_POST['project_name'])) {
    $_SESSION['message'] = "Project name is mandatory!";
    header("Location: ../pages/projects/editProject.php?id={$projectName}");
    exit(0);
  }
    if (empty($_POST['descrption'])) {
      $_SESSION['message'] = "description is mandatory!";
      header("Location: ../pages/projects/editProject.php?id={$_POST['description']}");
      exit(0);
    }

  if (empty($_POST['id_clients'])) {
    $_SESSION['message'] = "Client name is mandatory!";
    header("Location: ../pages/projects/editProject.php?id={$_POST['project_id']}");
    exit(0);
  }

  if (empty($_POST['deadline_date'])) {
    $_SESSION['message'] = "Deadline is mandatory!";
    header("Location: ../pages/projects/editProject.php?id={$_POST['deadline_date']}");
    exit(0);
  }

  if (empty($_POST['value'])) {
    $_SESSION['message'] = "Deadline is mandatory!";
    header("Location: ../pages/projects/editProject.php?id={$_POST['value']}");
    exit(0);
  }

  if (empty($_POST['value_observations'])) {
    $_SESSION['message'] = "Value observations is mandatory!";
    header("Location: ../pages/projects/editProject.php?id={$_POST['value']}");
    exit(0);
  }







  $addProject = searchProjectByName($_POST['project_name'], $_POST['project_id']);
  if (!empty($addProject)) {
    $_SESSION['message'] = "Project name is already in use!";
    header("Location: ../pages/projects/editProject.php?id={$_POST['project_id']}");
    exit(0);
  }

  $updateQuery = "
    UPDATE  projects
    SET     name='{$projectName}',
            description='{$_POST['description']}',
            id_clients='{$_POST['id_clients']}',
            name='{$_POST['project_name']}',
            name='{$_POST['project_name']}'

    WHERE   id_projects='{$_POST['projects_id']}'
  ";
  $query_run = mysqli_query($con, $updateQuery);

  $_SESSION['message'] = "project name updated successfully!";
  header("Location: ../pages/projects/editProject.php?id={$_POST['project_id']}");
}

// trata a ativação ou desativação de projetos
if (isset($_POST['toggle_activate_project'])) {
  $active = 1;

  if ($_POST['toggle_activate_project'] == 'deactivate') {
    $active = 0;
  }

  if ($_POST['toggle_activate_project'] == 'activate') {
    $active = 1;
  }

  $updateQuery = "
    UPDATE  projects
    SET     is_active=b'{$active}'
    WHERE   id_projects='{$_POST['project_id']}'
  ";
  $query_run = mysqli_query($con, $updateQuery);

  $_SESSION['message'] = "Project{$_POST['toggle_activate_project']}d!";
  header("Location: ../pages/projects/listProject.php");
}

function searchProjectByName($nameProject, $idProject)
{
  require './dbcon.php';

  $query = "
    SELECT  id_projects
    FROM    projects
    WHERE   name = '{$nameProject}'
    AND     id_projects != '{$idProject}'
  ";

  $query_run = mysqli_query($con, $query);

  return mysqli_fetch_row($query_run);
}

function getProjectById($con, $id) {
  $query = "
    SELECT  id_projects AS id,
            name AS project_name,
            description,
            id_clients,
            id_clients_intermediary,
            deadline_date,
            value,
            value_observations,
            project_observations
    FROM    projects
    WHERE   id_projects = '{$id}'
  ";
  $query_run = mysqli_query($con, $query);
  return mysqli_fetch_array($query_run);
}
