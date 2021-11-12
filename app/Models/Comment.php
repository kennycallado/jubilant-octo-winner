<?php

namespace App\Models;

class Comment
{
  public $content;
  public $comment_id;
  public $post_id;

  function __construct($content, $comment_id = null, $post_id = null)
  {
    $this->content = $content;
    $this->comment_id = $comment_id;
    $this->post_id = $post_id;
  }
}
