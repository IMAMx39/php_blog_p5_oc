<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Service\UserService;
use Core\Controller;
use Core\Request;
use Core\Response;
use RuntimeException;

class PostController extends Controller
{

    private PostRepository $postRepository;
    private CommentRepository $commentRepository;
    private UserService $userService;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
        $this->commentRepository = new CommentRepository();
        $this->userService = new UserService();
    }


    public function index(Request $request, array $args): Response
    {
        $user = $this->userService->getUserFromSession();
        $post = $this->postRepository->getPostByID($args[0]);
        $comments = $this->commentRepository->find($args[0]);
        if (!$post) {
            throw new RuntimeException("Ce post n'existe pas.");
        }
        $data = [
            "user" => $user,
            "post" => $post,
            "comments" => $comments,
            "postId" => $args[0]
        ];

        return $this->render('post', $data);

    }

}
