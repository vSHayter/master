<?php
/**
 * @var \app\models\Hotel $hotel
 */

use yii\helpers\Url;

?>

<div class="row">
    <p>name: <?= $hotel->name; ?></p>
    <p>description: <?= $hotel->description; ?></p>
    <p>phone_number: <?= $hotel->phone_number; ?></p>
    <p>house_number: <?= $hotel->house_number; ?></p>
    <p>address: <?= $hotel->address; ?></p>
    <p>index: <?= $hotel->index; ?></p>
    <p>type: <?= $hotel->type->name; ?></p>
    <p>city: <?= $hotel->city->name; ?></p>
    <p>country: <?= $hotel->city->country->name; ?></p>
</div>
