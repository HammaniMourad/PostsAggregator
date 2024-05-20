<?php

namespace App\Controller;


use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
 
    public function __construct(
        private PostRepository $postRepository, 
        private EntityManagerInterface $entityManager
    ) {
    }

    #[Route('/api/posts', name: 'api_posts', methods: ['GET'])]
    public function getPosts(): JsonResponse
    {
        $posts = $this->postRepository->findAll();
        return $this->json($posts, 200, [], ['groups' => 'post-read']);
    }

    #[Route('/api/posts/{id}', name: 'api_post', methods: ['GET'])]
    public function getPost($id): JsonResponse
    {
        $post = $this->postRepository->find($id);
        if (!$post) {
            return $this->json(['error' => 'post not found'], 404);
        }
        return $this->json($post);
    }

    #[Route('/api/posts/{id}', name: 'api_update_post', methods: ['PUT', 'PATCH'])]
    public function updatePost(Request $request, int $id): JsonResponse
    {
        $post = $this->postRepository->find($id);

        if (!$post) {
            return $this->json(['message' => 'Post not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        if (isset($data['title'])) {
            $post->setTitle($data['title']);
        }

        if (isset($data['content'])) {
            $post->setContent($data['content']);
        }

        if (isset($data['description'])) {
            $post->setDescription($data['description']);
        }

        $this->entityManager->flush();

        return $this->json($post, Response::HTTP_OK, [], ['groups' => 'post:read']);
    }

    #[Route('/api/posts/{id}', name: 'api_delete_post', methods: ['DELETE'])]
    public function deletePost(int $id): JsonResponse
    {
        $post = $this->postRepository->find($id);

        if (!$post) {
            return $this->json(['message' => 'Post not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($post);
        $this->entityManager->flush();

        return $this->json(['message' => 'Post deleted'], Response::HTTP_NO_CONTENT);
    }

    #[Route('/api/articles/search', name: 'api_article_search', methods: ['GET'])]
    public function searchArticles(Request $request): JsonResponse
    {
        $query = $request->query->get('q');
        $posts = $this->postRepository->findBySearchLike($query);
        return $this->json($posts);
    }
}