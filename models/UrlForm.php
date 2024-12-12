<?php

namespace app\models;

use yii\base\Model;

class UrlForm extends Model
{
    public $url;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['url', 'trim'],
            [['url'], 'required'],
            [
                'url',
                'url',
                'enableIDN' => true,
                // запретим валидацию на клиенте
                'whenClient' => "function (attribute, value) { return false;  }"
            ],
            ['url', 'validateUrl'],
        ];
    }

    /**
     * Прроверим доступность адреса.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateUrl($attribute, $params)
    {
        if (!$this->hasErrors()) {
            try {
                $file = $this->url;
                $file_headers = @get_headers($file);
                if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
                    $this->addError($attribute, 'Данный URL не доступен');
                }
            } catch (\Exception $e) {
                $this->addError($attribute, 'Данный URL не доступен: ' . $e->getMessage());
            }
        }
    }

}