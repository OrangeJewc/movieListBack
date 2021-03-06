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
  $listId = $_GET['listId'];

  $sql = "DELETE FROM movie WHERE id = $id AND listId = $listId";
  
  if($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
  } else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
?>