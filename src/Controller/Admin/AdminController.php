<?php

namespace App\Controller\Admin;

use App\Model\Post;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Service\UserService;
use Core\Controller;
use Core\Request;
use Core\Response;
use Exception;

class AdminController extends Controller
{
    private UserRepository $userRepository;
    private UserService $userService;
    private PostRepository $postRepository;
    private CommentRepository $commentRepository;


    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->userService = new UserService();
        $this->postRepository = new PostRepository();
        $this->commentRepository = new CommentRepository();
    }

    /**
     * @throws Exception
     */

    public function index(Request $request, ?array $action): Response
    {
        $user = $this->userService->getUserFromSession();

        if ($user->getStatus() !== 'admin') {

           $this->redirectTo('/');
        }

        if (empty($action)) {
            return $this->displayPostsPanel();
        }

        return $this->handleAction($action[0]);

    }

    /**
     * @throws Exception
     */
    private function handleAction(string $action): Response
    {
        $request = new Request();
        $postId = $request->getOrNull('postId', true);

        switch ($action) {
            case 'delete':
                return $this->deletePost($postId);

            case 'users':
                return $this->displayUsers();

            case 'edit':
                return $this->displayPostEdit($postId);

            case 'articles':
                $post = $this->buildPostInstance($postId);
                return $postId == 0 ? $this->createPost($postId) : $this->updatePost($post);
            case 'userstatus':
                $name = $request->post('userPseudo');
                $status = $request->post('userStatus');
                $this->setUserStatus($name, $status);
                return $this->displayUsers();

            default:
                throw new Exception('Action demandée invalide.');
        }
    }


    public function displayUsers(): Response
    {
        $users = $this->userRepository->getAllUsers();

        $data = [
            'users' => $users,
        ];

        return $this->render('admin/adminUsers', $data);
    }


    public function createPost(?int $postId): Post
    {

        $request = new Request();
        $title = $request->post('title');
        $head = $request->post('head');
        $content = $request->post('content');

        $post = (new Post())
            ->setTitle($title)
            ->setHead($head)
            ->setContent($content);
        $postId = $this->postRepository->createPost($post,
            $this->userService->getUserFromSession()->getPseudo());


       return $this->redirectTo('/articles/'.$postId);

    }

    private function displayPostsPanel(): Response
    {
        // Get all posts, then build their $comments array
        $posts = $this->postRepository->getAllPosts();
        foreach ($posts as $p) {
            $postComments = $this->commentRepository->find($p->getId());
            $p->setComments($postComments);
        }

        $data['posts'] = $posts;
        $data['comments'] = $postComments;


        return $this->render('admin/admin', $data);
    }

    private function deletePost(int $postId): Response
    {
        $rslt = $this->postRepository->deletePost($postId);
        if (!$rslt) {
            throw new Exception('La suppression du Post a rencontré un problème.');
        }

        return $this->displayPostsPanel();
    }

    private function updatePost(Post $post): void
    {
        $rslt = $this->postRepository->updatePost($post);
        if (!$rslt) {
            throw new Exception('La mise à jour du Post a rencontré un problème.');
        }

        $this->redirectTo('/articles/' .$post->getId());
    }

    private function displayPostEdit(?int $postId): Response
    {
        $data['title'] = $postId ? 'Éditer un Post' : 'Créer un Post';
        $data['post'] = $postId ? $this->postRepository->getPostByID($postId) : null;

        return $this->render('admin/adminPost', $data);
    }

    private function buildPostInstance(?int $postId): Post
    {
        $request = new Request();
        return (new Post())
            ->setId($postId)
            ->setTitle($request->post('title'))
            ->setHead($request->post('head'))
            ->setContent($request->post('content'));
    }

    private function setUserStatus(string $name, string $status): bool
    {
        if ($status === "banned") {
            return $this->userRepository->banUser($name);
        } else if ($status === "visitor") {
            return $this->userRepository->unbanUser($name);
        }

        throw new Exception("Mauvais status d'utilisateur envoyé au controlleur.");
    }
}
