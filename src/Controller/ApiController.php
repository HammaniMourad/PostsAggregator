<?php

namespace App\Controller;


use App\Repository\PostRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    #[Route('/api/posts', name: 'api_posts', methods: ['GET'])]
    public function getPosts(): JsonResponse
    {
        $posts = $this->postRepository->findAll();
        return $this->json($posts);
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
}