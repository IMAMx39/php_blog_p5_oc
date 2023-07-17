<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Service\UserService;
use Core\Controller;
use Core\Request;
use Core\Response;
use RuntimeException;

class CommentController extends Controller
{

    private CommentRepository $commentRepository;
    private UserService $userService;


    public function __construct()
    {
        $this->commentRepository = new CommentRepository();
        $this->userService = new UserService();
    }

    function index(Request $request, array $action): Response
    {
        $request = new Request();
        $postId = $request->post('postId', true);

        switch ($action[0]) {
            case 'add':
                $comment = $request->post('commentContent');
                $this->add($comment, $postId);
                break;

            case 'delete':
                $commentId = $request->post('commentId', true);
                $this->delete($commentId);
                break;

            case 'approve':
                $commentId = $request->post('commentId', true);
                $this->approve($commentId);
                break;


        }
       return $this->redirectTo('/articles/' . $postId);

    }

    private function add(string $comment, int $postId): void
    {
        $user = $this->userService->getUserFromSession();

        $username = $user?->getPseudo();
        $isAdmin = $user?->getStatus() === 'admin';

        $rslt = $this->commentRepository->add($postId, $comment, $username, $isAdmin);

        if (!$rslt) {
            throw new RuntimeException('Un problème est survenu..');
        }

    }

    private function approve(int $commentId): void
    {
        $user = $this->userService->getUserFromSession();

        if (!$user->getStatus() == 'Admin') {
            throw new RuntimeException();
        }

        $rslt = $this->commentRepository->approve($commentId);

        if ($rslt === false) {
            throw new RuntimeException('Un problème est survenu.');
        }
    }

    private function delete(int $commentId): void
    {
        $user = $this->userService->getUserFromSession();

        if (!$user->getStatus() == 'Admin') {
            throw new RuntimeException();
        }

        $rslt = $this->commentRepository->delete($commentId);

        if (!$rslt) {
            throw new RuntimeException('Un problème est survenu.');
        }
    }

}
