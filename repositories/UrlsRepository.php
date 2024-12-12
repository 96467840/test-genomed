<?php

namespace app\repositories;

use app\models\Url;
use app\infrastructure\AbstractRepository;


/**
 * @method Url get(int $id)
 * @method Url|null find(int $id)
 * @method Url save(Url $model)
 *
 * @extends AbstractRepository<Url>
 */
class UrlsRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(Url::class);
    }

    /**
     * Поиск данных о полном адресе по короткому имени
     *
     * @param string $short_url
     * @return Url|null
     */
    public function findUrlByShort(string $short_url): ?Url
    {
        /** @var Url|null $item */
        $item = Url::find()->where(['short_url' => $short_url])->one();

        return $item;

    }

    /**
     * Поиск данных о полном адресе по короткому имени
     *
     * @param string $short_url
     * @return Url|null
     */
    public function findUrlByFull(string $url): ?Url
    {
        /** @var Url|null $item */
        $item = Url::find()->where(['url' => $url])->one();

        return $item;
    }
}