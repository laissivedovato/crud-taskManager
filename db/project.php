<?php

require 'dbcon.php';
session_start();

// adding a new project
if (isset($_POST['add_project'])) {

  // if the name is empty, it sets a message and redirects to editing the project sent
  if (empty($_POST['name'])) {
    $_SESSION['message'] = "Project name is mandatory!";
    header("Location: ../pages/projects/addProject");
    exit(0);
  }

  $addProject = searchProjectByName($_POST['name'], 0);
  if (!empty($addProject)) {
    $_SESSION['message'] = "Project name is already in use!";
    header("Location: ../pages/projects/addProject.php");
    exit(0);
  }

  $projectName = $_POST['name'];
  if (!preg_match('/^[a-zA-Z\s]/', $projectName)) {
    $_SESSION['message'] = 'Name must be letters and spaces only';
    header("Location: ../pages/projects/addProject.php");
    exit(0);
  }

  $projectName = mysqli_real_escape_string($con, $_POST['name']);

  //create sql
  $insertProjectQuery = "
    INSERT INTO projects (name)
    VALUES ('{$projectName}')
  ";

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

// atualização de projetos
if (isset($_POST['update_project'])) {
  // se o nome estiver vazio seta uma mensagem e redireciona para a edição do
  // projeto enviado
  if (empty($_POST['name'])) {
    $_SESSION['message'] = "Project name is mandatory!";
    header("Location: ../pages/projects/editProject.php?id={$_POST['project_id']}");
    exit(0);
  }

  $addProject = searchProjectByName($_POST['name'], $_POST['project_id']);
  if (!empty($addProject)) {
    $_SESSION['message'] = "Project name is already in use!";
    header("Location: ../pages/projects/editProject.php?id={$_POST['project_id']}");
    exit(0);
  }

  $updateQuery = "
    UPDATE  projects
    SET     name='{$_POST['project_name']}'
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

function searchProjectByName($nomeProject, $idProject)
{
  require './dbcon.php';

  $query = "
    SELECT  id_projects
    FROM    projects
    WHERE   name = '{$nomeProject}'
    AND     id_projects != '{$idProject}'
  ";

  $query_run = mysqli_query($con, $query);

  return mysqli_fetch_row($query_run);
}

function getProjectById($con, $id)
{
  $query = "
    SELECT  id_projects AS id,
            name
    FROM    projects
    WHERE   id_projects = '{$id}'
  ";
  $query_run = mysqli_query($con, $query);
  return mysqli_fetch_array($query_run);
}
