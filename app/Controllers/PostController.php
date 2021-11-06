<?php

namespace App\Controllers;

use App\Core\DataBase;
use App\Models\PostRepository;
use App\Views\PostCreate;
use App\Views\PostIndex;
use App\Views\PostShow;

class PostController
{
  private $repo;
  function __construct()
  {
    $this->repo = new PostRepository(new Database());
  }
  /* show all the posts */
  function index()
  {
    new PostIndex($this->repo->getAll());
  }

  /* show one post */
  function show($post_id)
  {
    new PostShow($this->repo->getOne($post_id));
  }

  /* show create post */
  /* quizá me sirve para add y update */
  function create()
  {
    new PostCreate();
  }

  /* store a post */
  function store($values)
  {
    $this->repo->add($values);
    header("Location: /posts");
  }

  /* delete a post */
  function delete($post_id)
  {
    $this->repo->delete($post_id);
    header("Location: /posts");
  }
}
