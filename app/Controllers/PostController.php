<?php

namespace App\Controllers;

use App\Core\DataBase;
use App\Models\{PostRepository, CommentRepository};
use App\Views\{PostCreate, PostEdit, PostIndex, PostShow};

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
    /* limitar el número de posts */
    /* cada vez que se visita el index */
    /* hacer un check y borrar en caso */
    /* de que se superen los 50 */
    new PostIndex($this->repo->getAll());
  }

  /* show one post */
  function show($post_id)
  {
    $data = [];
    $data["post"] = $this->repo->getOne($post_id);

    $commentsRepo = new CommentRepository(new DataBase());
    $comments = $commentsRepo->getAllByPostId($data["post"]->post_id);

    $data["comments"] = $comments;

    new PostShow($data);
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

  function edit($post_id)
  {
    $post = $this->repo->getOne($post_id);
    new PostEdit($post);
  }

  function update($values)
  {
    $this->repo->update($values);
    header("Location: /postdetails/$values[post_id]");
  }

  /* delete a post */
  function delete($post_id)
  {
    $this->repo->delete($post_id);
    header("Location: /posts");
  }
}
