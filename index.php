<?php
  // Start session
  session_start();
  // Import all required database files
  require "includes/functions.php";
  // Figure out the url the user is visiting
  $path = $_SERVER["REQUEST_URI"];
  // Once the url is determined, lead the user to the specific route
  switch($path) {
    // Actions
    case '/auth/login':
      require 'includes/auth/login.php';
      break;
    case '/auth/signup':
      require 'includes/auth/signup.php';
      break;
    case '/tasks/add':
      require 'includes/tasks/add.php';
      break;
    case '/tasks/update':
      require 'includes/tasks/update.php';
      break;
    case '/tasks/delete':
      require 'includes/tasks/delete.php';
      break;
    // Pages
    case '/login':
      require 'pages/login.php';
      break;
    case '/signup':
      require 'pages/signup.php';
      break;
    case '/logout':
      require 'pages/logout.php';
      break;
    default:
      require 'pages/home.php';
      break;
  }
?>