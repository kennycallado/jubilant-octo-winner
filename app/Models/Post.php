<?php

namespace App\Models;

class Post
{
  public $title;
  public $content;
  public $post_id;

  function __construct($title, $content, $post_id = null)
  {
    $this->title = $title;
    $this->content = $content;
    $this->post_id = $post_id;
  }
}
