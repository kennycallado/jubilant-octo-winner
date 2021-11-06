<?php

namespace App\Core;

use App\Core\Interfaces\IDataBase;
use PDO;
use PDOException;

class DataBase implements IDataBase
{
  private $conn;

  public function __construct()
  {
    $dbopts = parse_url(getenv('DATABASE_URL'));
    $db_info = array(
      'driver'   => 'pgsql',
      'user'     => $dbopts["user"],
      'password' => $dbopts["pass"],
      'host'     => $dbopts["host"],
      'port'     => $dbopts["port"],
      'dbname'   => ltrim($dbopts["path"], '/')
    );
    $dsn = "$db_info[driver]:host=$db_info[host];port=$db_info[port];dbname=$db_info[dbname];user=$db_info[user];password=$db_info[password]";
    $this->connect($dsn);
  }

  private function connect($dsn)
  {
    try {
      $dbh = new PDO($dsn);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $this->conn = $dbh;
    } catch (PDOException $e) {
      die("Fallo en la conexión. Programa muere. $e");
    }
  }

  public function executeSQL($sql)
  {
    return $this->conn->query($sql);
  }
  public function __destruct()
  {
    if ($this->conn != null) $this->conn = null;
  }
}
