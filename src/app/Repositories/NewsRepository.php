<?php

namespace App\Repositories;


use App\Models\News;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use SimpleXMLElement;

/**
 * Класс для работы с rss лентой RBK
 *
 * Class News
 */
class NewsRepository
{

    /** @var string rss link RBK */
    const SOURCE_URL = "http://static.feed.rbc.ru/rbc/internal/rss.rbc.ru/rbc.ru/news.rss";

    /** @var int limit news */
    const ARTICLE_LIMIT = 15;

    /** @var Client  */
    private $httpClient;

    /**
     * News constructor.
     */
    public function __construct()
    {
        $this->httpClient = new Client();

        $this->removeOldNews();
    }


    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        $result = News::query()->select(['*'])->get();

        if ($result->isNotEmpty()) {
            return $result;
        } else {
            return collect([]);
        }
    }

    /**
     * @return bool
     */
    public function upload(): bool
    {
        try {
            $response = $this->httpClient->get(self::SOURCE_URL);

            $body = $response->getBody()->getContents();

            $rss = simplexml_load_string($body, null, LIBXML_NOCDATA);

            for ($i = 0; $i < self::ARTICLE_LIMIT; $i++) {
                /** @var News $model */
                $model = $this->rssToDocument($rss->channel->item[$i]);
                $model->save();
            }
        } catch (\Throwable $throwable) {
            logger($throwable->getMessage());

            return false;
        }

        return true;
    }

    /**
     * @param SimpleXMLElement $rss
     * @return NewsRepository
     */
    private function rssToDocument(SimpleXMLElement $rss): News
    {
        $model = new News([
            'title'       => (string)$rss->title,
            'link'        => (string)$rss->link,
            'description' => (string)$rss->description,
        ]);

        return $model;
    }

    private function removeOldNews()
    {
        News::query()->delete();
    }

}
