<?php
/**
 * Created by PhpStorm.
 * User: qq
 * Date: 16/8/30
 * Time: 10:59
 */

namespace App\Services;


use App\Models\Article;

class SiteMap
{

    public function __construct()
    {
    }

    public function getSiteMap()
    {
        return self::buildSiteMap();
    }

    protected function buildSiteMap()
    {
        $article = Article::where('status', 1)->orderBy('created_at', 'desc')->take(20)->get();
        $data = array_build($article, function ($k, $v) {
            return [$k, $v->created_at];
        });
        $dates = array_values($data);
        sort($dates);
        $lastmod = last($dates);
        $url = trim(url(), '/') . '/';

        $xml = [];
        $xml[] = '<?xml version="1.0" encoding="UTF-8"?' . '>';
        $xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $xml[] = '  <url>';
        $xml[] = "    <loc>$url</loc>";
        $xml[] = "    <lastmod>$lastmod</lastmod>";
        $xml[] = '    <changefreq>qq</changefreq>';
        $xml[] = '    <priority>0.8</priority>';
        $xml[] = '  </url>';

        foreach ($article as $slug => $art) {
            $xml[] = '  <url>';
            $xml[] = "    <loc>{$url}article/$art->id</loc>";
            $xml[] = "    <lastmod>$art->created_at</lastmod>";
            $xml[] = "  </url>";
        }

        $xml[] = '</urlset>';

        return join("\n", $xml);
    }

}