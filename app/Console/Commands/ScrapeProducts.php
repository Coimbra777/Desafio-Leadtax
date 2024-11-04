<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Product;
use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\Log;

class ScrapeProducts extends Command
{
    protected $signature = 'scrape:products';
    protected $description = 'Scrapes product data from an e-commerce site';

    public function handle()
    {
        $this->info('Realizando Scraping dos produtos, aguarde...');
        $client = new Client([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language' => 'pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',
                'Referer' => 'https://www.mercadolivre.com.br/',
            ],
        ]);

        try {
            $response = $client->get('https://www.mercadolivre.com.br');
            $html = $response->getBody()->getContents();
            $dom = new DOMDocument();
            @$dom->loadHTML($html);
            $xpath = new DOMXPath($dom);

            $productNodes = $xpath->query('//div[contains(@class, "poly-card")]');

            foreach ($productNodes as $node) {
                $linkNode = $xpath->query(".//a[contains(@class, 'poly-component__title')]", $node);
                $productUrl = $linkNode->length > 0 ? $linkNode->item(0)->getAttribute('href') : null;

                if ($productUrl) {
                    if (!str_contains($productUrl, 'http')) {
                        $productUrl = 'https://www.mercadolivre.com.br' . $productUrl;
                    }
                    $productHtml = file_get_contents($productUrl);
                    $productDom = new DOMDocument();
                    @$productDom->loadHTML($productHtml);
                    $productXpath = new DOMXPath($productDom);

                    $descriptionNode = $productXpath->query('//p[contains(@class, "ui-pdp-description__content")]');
                    $nameNode = $productXpath->query('//h1[contains(@class, "ui-pdp-title")]');
                    $priceNode = $productXpath->query('//span[contains(@class, "andes-money-amount__fraction")]');
                    $imageNode = $productXpath->query('//img[contains(@class, "ui-pdp-image ui-pdp-gallery__figure__image")]');

                    $name = $nameNode->length > 0 ? $nameNode->item(0)->nodeValue : 'Nome não encontrado';
                    $description = $descriptionNode->length > 0 ? $descriptionNode->item(0)->nodeValue : 'Descrição não encontrada';
                    $price = $priceNode->length > 0 ? $priceNode->item(0)->nodeValue : 'Preço não encontrado';
                    $imageUrl = $imageNode->length > 0 ? $imageNode->item(0)->getAttribute('src') : null;

                    Product::updateOrCreate(
                        ['name' => $name],
                        [
                            'description' => $description,
                            'price' => $price,
                            'image_url' => $imageUrl,
                        ]
                    );
                }
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
        $this->info('Scraping finalizado!');
    }
}
