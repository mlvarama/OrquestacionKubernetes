<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: Application/json');

  include_once '../../Config/Database.php';
  include_once '../../Models/Post.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Post($db);

  // Get ID
  $post->id_subject = isset($_GET['id_subject']) ? $_GET['id_subject'] : die();

  // Get post
  $post->read_single();

  // Create array
  $post_arr = array(
    'id_subject' => $post->id_subject,
    'semester' => $post->semester,
    'name_subject' => $post->name_subject,
    'credits' => $post->credits,
    'code' => $post->code
  );

  // Make JSON
  print_r(json_encode($post_arr));