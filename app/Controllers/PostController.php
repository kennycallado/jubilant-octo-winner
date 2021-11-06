<?php

namespace App\Controllers;

use App\Core\DataBase;
use App\Models\PostRepository;
use App\Views\PostIndex;
use App\Views\PostShow;

class PostController
{
  function index()
  {
    $repo = new PostRepository(new DataBase());

    new PostIndex($repo->getAll());
  }

  function show($post_id)
  {
    $repo = new PostRepository(new DataBase());

    new PostShow($repo->getOne($post_id));
  }
}
