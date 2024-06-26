<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Common\AggregateInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AggregationController extends AbstractController
{
    private iterable $aggregators;
    private $entityManager;

    public function __construct(iterable $aggregators, EntityManagerInterface $entityManager)
    {
        $this->aggregators = $aggregators;
        $this->entityManager = $entityManager;
    }  
 
    
    #[Route('/aggregate', name: 'aggregate')]
    public function aggregate(): JsonResponse
    {
        $fetchedPosts = [];
        $savedPost = $this->entityManager->getRepository(Post::class);
        foreach ($this->aggregators as $aggregator) {
            $fetchedPosts = array_merge($fetchedPosts, $aggregator->fetchPosts());
            foreach ($fetchedPosts as $postData) {
                if (!$savedPost ->findOneBy(['url' => $postData['url']])) {
                    $post = new Post();
                    $post->setTitle($postData['title']);
                    $post->setUrl($postData['url']);
                    $post->setImageUrl($postData['imageUrl']);
                    $post->setDescription($postData['description']);
                    $post->setContent($postData['content']);
                    $post->setPublishedAt(new \DateTimeImmutable($postData['publishedAt']));
                    $post->setAuthor($postData['author']);
                    $this->entityManager->persist($post);
                }
            }
        }
        $this->entityManager->flush();
        return new JsonResponse($fetchedPosts);
    }
}