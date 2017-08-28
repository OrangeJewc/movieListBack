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
  $title = $_GET['title'];
  $overview = $_GET['overview'];
  $listId = $_GET['listId'];
  $releaseDate = $_GET['releaseDate'];
  $posterPath = $_GET['posterPath'];

  $sql = "INSERT INTO movie(id, title, overview, listId, releaseDate, posterPath) VALUES($id, '$title', '$overview', $listId, '$releaseDate', '$posterPath')";
  
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
?>