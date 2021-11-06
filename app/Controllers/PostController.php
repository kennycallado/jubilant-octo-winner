<?php

namespace App\Controllers;

use App\Core\DataBase;
use App\Models\PostRepository;
use App\Views\PostCreate;
use App\Views\PostIndex;
use App\Views\PostShow;

class PostController
{
  /* show all the posts */
  function index()
  {
    $repo = new PostRepository(new DataBase());

    new PostIndex($repo->getAll());
  }

  /* show one post */
  function show($post_id)
  {
    $repo = new PostRepository(new DataBase());

    new PostShow($repo->getOne($post_id));
  }

  /* show create post */
  /* quizá me sirve para add y update */
  function create($values = null)
  {
    new PostCreate();
  }

  /* store a post */
  function store($values)
  {
    $repo = new PostRepository(new DataBase());
    $repo->add($values);
    header("Location: /posts");
  }
}
