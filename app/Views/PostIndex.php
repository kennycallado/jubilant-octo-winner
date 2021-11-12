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
      echo "<td><a href='/postdetails/$post->post_id'>$post->title</a></td>";
      // echo "<td><a href='/postdelete/$post->post_id'>Eliminar</a></td>";
      echo "</tr>";
    }
  }
}
