<?php

require 'dbcon.php';
session_start();

// adding a new client
if(isset($_POST['add_client'])) {
  // if the name is empty, it sets a message and redirects to editing the client sent
  if(empty($_POST['client_name'])) {
    $_SESSION['message'] = "Client name is mandatory!";
    header("Location: ../pages/clients/addClient.php");
    exit(0);
  }

  $addClient = searchClientByName($_POST['client_name'], 0);
  if (!empty($addClient)) {
    $_SESSION['message'] = "Client name is already in use!";
    header("Location: ../pages/clients/addClient.php");
    exit(0);
  }

  $clientName = $_POST['client_name'];
  if (!preg_match('/^[a-zA-Z\s]/', $clientName)) {
    $_SESSION['message'] = 'Name must be letters and spaces only';
    header("Location: ../pages/clients/addClient.php");
    exit(0);
  }

  $clientName = mysqli_real_escape_string($con, $_POST['client_name']);

  //create sql
  $insertClientQuery = "
    INSERT INTO clients (client_name)
    VALUES ('{$clientName}')
  ";

  //save to db and check
  if (mysqli_query($con, $insertClientQuery)) {
    //sucess
    $_SESSION['message'] = 'Client created successfully';
    header('Location: ../pages/clients/listClient.php');
    exit(0);
  } else {
    //error
    $_SESSION['message'] = 'query error: ' . mysqli_error($conn);;
    header('Location: ../pages/clients/listClient.php');
    exit(0);
  }
}

//update clients
if (isset($_POST['update_client'])) {
  // if the name is empty, set a message and redirect to editing the client sent
  if(empty($_POST['client_name'])) {
    $_SESSION['message'] = "Client name is mandatory!";
    header("Location: ../pages/clients/editClient.php?id={$_POST['client_id']}");
    exit(0);
  }

  $addClient = searchClientByName($_POST['client_name'], $_POST['client_id']);
  if (!empty($addClient)) {
    $_SESSION['message'] = "Client name is already in use!";
    header("Location: ../pages/clients/editClient.php?id={$_POST['client_id']}");
    exit(0);
  }


  $updateQuery = "
    UPDATE  clients
    SET     client_name='{$_POST['client_name']}'
    WHERE   id_clients='{$_POST['client_id']}'
  ";
  $query_run = mysqli_query($con, $updateQuery);

  $_SESSION['message'] = "Client name updated successfully!";
  header("Location: ../pages/clients/editClient.php?id={$_POST['client_id']}");
}


// handle activation or deactivation of clients
if (isset($_POST['toggle_activate_client'])) {
  $active = 1;

  if ($_POST['toggle_activate_client'] == 'deactivate') {
    $active = 0;
  }

  if ($_POST['toggle_activate_client'] == 'activate') {
    $active = 1;
  }

  $updateQuery = "
    UPDATE  clients
    SET     is_active=b'{$active}'
    WHERE   id_clients='{$_POST['client_id']}'
  ";
  $query_run = mysqli_query($con, $updateQuery);

  $_SESSION['message'] = "Client {$_POST['toggle_activate_client']}d!";
  header("Location: ../pages/clients/listClient.php");
}

function searchClientByName($clientName, $idClient) {
  require './dbcon.php';

  $query = "
    SELECT  id_clients
    FROM    clients
    WHERE   client_name = '{$clientName}'
    AND     id_clients != '{$idClient}'
  ";

  $query_run = mysqli_query($con, $query);

  return mysqli_fetch_row($query_run);
}

function getClientById($con, $id) {
  $query = "
    SELECT  id_clients AS id,
            client_name AS name
    FROM    clients
    WHERE   id_clients = '{$id}'
  ";
  $query_run = mysqli_query($con, $query);
  return mysqli_fetch_array($query_run);
}
