<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

  $server = $url["host"];
  $username = $url["user"];
  $password = $url["pass"];
  $db = substr($url["path"], 1);

  $conn = new mysqli($server, $username, $password, $db);

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $id = $_GET['id'];
  $type = $_GET['type'];
  $text = $_GET['text'];

  $sql = "";

  if(strcmp($type, "name") == 0) {
    $sql = "UPDATE list SET name = "$text" WHERE id = $id";
  } else if(strcmp($type, "description") == 0) {
    $sql = "UPDATE list SET description = "$text" WHERE id = $id";
  }
  
  if ($conn->query($sql) === TRUE) {
    echo "list updated successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
?>