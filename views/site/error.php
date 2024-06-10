<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Во время обработки запроса возникла ошибка.
    </p>
    <p>
        Пожалуйста, попробуйте перегрузить страницу или свяжитесь с нами.
    </p>

</div>
