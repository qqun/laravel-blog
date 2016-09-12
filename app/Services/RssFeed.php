<?php
/**
 * Created by PhpStorm.
 * User: qq
 * Date: 16/8/30
 * Time: 10:28
 */

namespace App\Services;

use App\Models\Article;
use App\Repositories\ArticleRepository;
use Cache;
use Suin\RSSWriter\Channel;
use Suin\RSSWriter\Feed;
use Suin\RSSWriter\Item;

class RssFeed
{
    private $_feed, $_channel, $_item, $_article, $_key;

    public function __construct(
        Feed $feed,
        Channel $channel,
        Item $item,
        ArticleRepository $article
    )
    {
        $this->_channel = $channel;
        $this->_feed = $feed;
        $this->_item = $item;
        $this->_article = $article;
        $this->_key = 'rss-feed';
    }

    public function getRss()
    {
        if (Cache::has($this->_key)) {
            return Cache::get($this->_key);
        }

        $rss = self::buildRss();
        Cache::add($this->_key, $rss, 120);
        return $rss;
    }

    protected function buildRss()
    {
        $this->_channel->title('标题')->appendTo($this->_feed);

        $article = Article::where('status', 1)->orderBy('created_at', 'desc')->take(20)->get();

        foreach ($article as $art) {
            $url = url('article/' . $art->id);
            $this->_item->title($art->title)
                ->description($art->description)
                ->url($url)
                ->pubDate($art->created_at->timestamp)
                ->guid($url, true)
                ->appendTo($this->_channel);
        }

        $feed = (string)$this->_feed;
        $feed = str_replace(
            '<rss version="2.0">',
            '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">',
            $feed
        );
        $feed = str_replace(
            '<channel>',
            '<channel>' . "\n" . '    <atom:link href="' . url('/rss') .
            '" rel="self" type="application/rss+xml" />',
            $feed
        );

        return $feed;
    }

}