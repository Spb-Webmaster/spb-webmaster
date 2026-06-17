<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Sitemap\SitemapGenerator;

class SitemapController extends Controller
{
    public function sitemap(): void
    {
        $path = public_path('sitemap.xml');
        SitemapGenerator::create(config('app.url'))->writeToFile($path);
        $this->deduplicateSitemap($path);
    }

    private function deduplicateSitemap(string $path): void
    {
        $xml = new \SimpleXMLElement(file_get_contents($path));
        $seen = [];

        foreach ($xml->url as $url) {
            $normalized = rtrim((string) $url->loc, '/');
            if (isset($seen[$normalized])) {
                $dom = dom_import_simplexml($url);
                $dom->parentNode->removeChild($dom);
            } else {
                $seen[$normalized] = true;
            }
        }

        file_put_contents($path, $xml->asXML());
    }
}
