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

echo "<pre>";
var_dump($db_info);
echo "</pre>";
