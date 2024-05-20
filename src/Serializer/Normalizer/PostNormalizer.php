<?php

namespace App\Serializer\Normalizer;

use App\Entity\Post;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class PostNormalizer implements ContextAwareNormalizerInterface
{
    public function normalize($object, $format = null, array $context = [])
    {
        if (!$object instanceof Post) {
            return [];
        }

        return [
            'id' => $object->getId(),
            'title' => $object->getTitle(),
            'description' => $object->getDescription(),
            'content' => $object->getContent(),
            'url' => $object->getUrl(),
            'imageUrl' => $object->getImageUrl(),
            'author' => $object->getAuthor(),
            'publishedAt' => $object->getPublishedAt(),

        ];
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return $data instanceof Post;
    }
}