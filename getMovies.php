<?php
  header("Access-Control-Allow-Origin: *");
  $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

  $server = $url["host"];
  $username = $url["user"];
  $password = $url["pass"];
  $db = substr($url["path"], 1);

  $conn = new mysqli($server, $username, $password, $db);

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM movie";
  $result = $conn->query($sql);
  $rows = array();

  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          // echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
        $rows[] = $row;   
      }
    echo json_encode($rows);
  } else {
      echo "0 results";
  }
  $conn->close();
?>