<?php

namespace App\Views;

class PostIndex
{
  public $posts;
  function __construct($posts)
  {
    $this->posts = $posts;
    include_once "PostIndex.html";
  }

  function showAll()
  {
    foreach ($this->posts as $post) {
      echo "<tr>";
      echo "<td>";
      echo "<a href='/postdetails/$post->post_id'>$post->title</a>";
      echo "</td>";
      echo "</tr>";
    }
  }
}
