<?php

namespace App\Views;


class PostShow
{
  public $post;

  function __construct($post)
  {
    $this->post = $post;
    include_once "PostShow.html";
  }

  function showOne()
  {
  }
}
