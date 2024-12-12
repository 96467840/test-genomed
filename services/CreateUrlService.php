<?php

namespace app\services;

use app\models\Url;
use app\models\UrlForm;
use app\repositories\UrlsRepository;

/**
 * Создание краткой сылки
 */
class CreateUrlService
{
    private UrlsRepository $urls;
    private const MAX_RECURSION = 5;

    public function __construct(UrlsRepository $urls)
    {
        $this->urls = $urls;
    }

    /**
     * Генерируем краткую ссылку
     *
     * @return string
     */
    private function genShortUrl(): string
    {
        return uniqid();
    }

    /**
     * Создаем запись в БД
     *
     * @param UrlForm $form
     * @return Url
     * @throws \yii\db\Exception
     */
    public function create(UrlForm $form): Url
    {
        // проверим на существование такого же урла, по условиям задачи насчет дублей ничего не сказано
        $url = $this->urls->findUrlByFull($form->url);
        if (!$url) {
            $url = new Url();
            $url->url = $form->url;

            $url->short_url = $this->genShortUrl();

            $this->urls->save($url);
        }

        return $url;
    }

}