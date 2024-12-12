<?php

namespace app\repositories;

use app\models\Redirect;
use app\models\Url;
use app\infrastructure\AbstractRepository;


/**
 * @method Redirect get(int $id)
 * @method Redirect|null find(int $id)
 * @method Redirect save(Redirect $model)
 *
 * @extends AbstractRepository<Redirect>
 */
class RedirectsRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(Redirect::class);
    }

}