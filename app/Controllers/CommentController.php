<?php

namespace App\Controllers;

use App\Core\DataBase;
use App\Models\CommentRepository;

class CommentController
{
  private $repo;

  function __construct()
  {
    $this->repo = new CommentRepository(new DataBase());
  }

  function store($values)
  {
    $this->repo->add($values);
    header("Location: /postdetails/$values[post_id]");
  }
}
