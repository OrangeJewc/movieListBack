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
  $deleteMovieSql = "DELETE FROM movie WHERE listId IN
                      (SELECT id FROM list WHERE id = $id)";
  $deleteListSql = "DELETE FROM list WHERE userId = $id";
  $deleteUserSql = "DELETE FROM user WHERE id = $id";
  
  if ($conn->query($deleteMovieSql) === TRUE) {
    if($conn->query($deleteListSql) === TRUE) {
      if($conn->query($deleteUserSql) === TRUE) {
        echo "User deleted successfully"; 
      } else {
        echo "Error: " . $deleteUserSql . "<br>" . $conn->error;
      }
    } else {
    echo "Error: " . $deleteListSql . "<br>" . $conn->error;
    }
  } else {
    echo "Error: " . $deleteMovieSql . "<br>" . $conn->error;
  }

  $conn->close();
?>