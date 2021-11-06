<?php


$dbopts = parse_url(getenv('DATABASE_URL'));
$db_info = array(
  'driver'   => 'pgsql',
  'user' => $dbopts["user"],
  'password' => $dbopts["pass"],
  'host' => $dbopts["host"],
  'port' => $dbopts["port"],
  'dbname' => ltrim($dbopts["path"], '/')
);

$dsn = "pgsql:host=database;port=5432;dbname=root;user=root;password=root";
$conn;

try {
  $dbh = new PDO($dsn);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $conn = $dbh;
} catch (PDOException $e) {
  echo "$e";
  die("Algún problema con la conexión.");
}

try {
  /* Comprobar si existe la tabla */
  $sql = "SELECT EXISTS ( SELECT FROM information_schema.tables WHERE table_name = 'table_name');";
  $query = $conn->prepare($sql);
  $query->execute();

  $exist = $query->fetch(PDO::FETCH_ASSOC);
  /* sino la crea */
  if (!$exist) {
    $sql = "CREATE TABLE posts (id INT NOT NULL, title CHAR(20), content CHAR(250), PRIMARY KEY (id))";
    $query = $conn->prepare($sql);
    $query->execute();
  }
} catch (PDOException $e) {
  echo "$e";
  die("Algún problema con la creación de la tabla.");
}

echo "Connectado";
