<?php

namespace app\controllers;

use app\models\Redirect;
use app\repositories\RedirectsRepository;
use app\repositories\UrlsRepository;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class RedirectController extends Controller
{
    private UrlsRepository $urls;
    private RedirectsRepository $redirects;

    public function __construct($id, $module, UrlsRepository $urls, RedirectsRepository $redirects, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->urls = $urls;
        $this->redirects = $redirects;
    }

    public function actionIndex(string $short)
    {
        // в боевом проекте все вынесу в сервис аналогично созданию линка
        $url = $this->urls->findUrlByShort($short);
        if (!$url) {
            throw new NotFoundHttpException('Адрес не найден');
        }

        $redirect = new Redirect();
        $redirect->url_id = $url->id;
        $redirect->remote_addr = Yii::$app->request->userIP;

        $this->redirects->save($redirect);

        // при большой нагрузке надо заменять на update urls set redirect_count=redirect_count+1 where id=:id
        // или делать пересчет счетчика раз в сутки или как нужно
        // также можно сделать кеширование урлов с пересчетом счетчика. опять же все зависит от требований бизнеса
        $url->redirect_count++;
        $this->urls->save($url);

        return $this->redirect($url->url, 301); // постоянный редирект
    }

}