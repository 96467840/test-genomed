<?php


namespace app\exceptions;


use RuntimeException;
use Throwable;
use Yii;
use yii\db\ActiveRecord;

class ActiveRecordDeleteFailedException extends RuntimeException
{
    private ActiveRecord $model;

    public function __construct(ActiveRecord $model, $code = 0, Throwable $previous = null)
    {
        $this->model = $model;
        $class = get_class($model);
        $attributes = $model->attributes;

        Yii::error(
            'Error while deleting ' . $class . ' model' . PHP_EOL .
            (json_encode(
                [
                    'class' => $class,
                    'errors' => $model->errors,
                    'attributes' => $attributes
                ],
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            ) ?: '')
        );

        parent::__construct('Error while deleting ' . $class . ' model', $code, $previous);
    }

    public function getModel(): ActiveRecord
    {
        return $this->model;
    }
}