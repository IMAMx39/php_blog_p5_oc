<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Core\Controller;
use Core\Response;

class PostsListController extends Controller
{

    private PostRepository $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }

    public function index(): Response
    {
        $posts = $this->postRepository->getAllPosts();
        $data = [
            'posts' => $posts
        ];
        return $this->render('postList', $data);

    }
}