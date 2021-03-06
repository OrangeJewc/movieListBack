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

  $rows = array();
  $userId = $_GET['userId'];
  $sql = "";

  if(strcmp($userId, 'all') == 0) {
    $sql = "SELECT * FROM list";
  } else {
    $sql = "SELECT * FROM list WHERE userId = $userId";
  }

  $result = $conn->query($sql);

  //select m.* from movie m, list l, user u where m.listId = l.id and l.userId = u.id;

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      // $rows[] = $row;
      $id = $row['id'];
      $movieSql = "SELECT m.* from movie m, list l, user u where m.listId = $id and l.id = m.listId and l.userId = u.id and u.id = $userId"; 
      $movieResult = $conn->query($movieSql);
      
      if($movieResult->num_rows > 0) {
        while($movie = $movieResult->fetch_assoc()) {
          $row['movies'][] = $movie;
        }
      }
      $rows[] = $row;
    }
    echo json_encode($rows);
  } else {
    echo "0 results";
  }
  $conn->close();
?>