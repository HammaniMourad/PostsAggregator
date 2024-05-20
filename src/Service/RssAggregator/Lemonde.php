<?php

namespace App\Service\RssAggregator;

use SimplePie\SimplePie;
use Symfony\Component\DomCrawler\Crawler;
use App\Service\Common\AggregateInterface;


class Lemonde implements AggregateInterface
{
  
    public function __construct(private string $rssUrl)
    {
    }

    public function fetchPosts(): array
    {
        $feed = new SimplePie();
        $feed->set_feed_url($this->rssUrl);
        $feed->enable_cache(false);
        $feed->init();
        $articles = [];
        foreach ($feed->get_items() as $item) {
            $media_content = $item->get_item_tags('http://search.yahoo.com/mrss/', 'content');
    
            $articles[] = [
                'title' => $item->get_title(),
                'author' => '',
                'description' => $item->get_description() ?? '',
                'url' => $item->get_link(),
                'content' => $item->get_link(),
                'publishedAt' => $item->get_date('Y-m-d H:i:s'),
                'imageUrl' => isset($media_content[0]['attribs']['']['url']) ? $media_content[0]['attribs']['']['url'] : null,
            ];
        }

        return $articles;
    }

}