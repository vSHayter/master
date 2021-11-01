<?php

use yii\bootstrap4\Carousel;

?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="room-info">
                <h4><?= $room->type->name ?></h4>
                <p><?= $room->description ?></p>
                <p class="mb-0">До <?= $room->amount_people ?> человек</p>
                <p class="mb-0">Площадь <?= $room->area ?> м <sup><small>2</small></sup></p>
                <p>Стоимость <?= $room->cost ?>$</p>
            </div>
            <div class="room-service">
                <h4>Room amenities</h4>
                <?php $flag = []; ?>
                <?php foreach ($room->indexRoomServices as $index):?>
                    <?php $category = $index->service->category->name;?>
                    <?php if(!array_key_exists($category, $flag)): ?>
                        <h5 class="mb-0 mt-1"><?= $category; ?></h5>
                    <?php endif; ?>
                    <?php $flag[$category] = 1; ?>
                    <p class="mb-0"><?= $index->service->name ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="room-carousel">
                <?php $carousel = [];?>
                <?php foreach ($room->roomImages as $image): ?>
                    <?php $carousel [] = [
                        'content' => '<img src=../img/'.$image->image.'>',
                        'options' => [
                                'class' => 'room-image',
                        ]
                    ]; ?>
                <?php endforeach; ?>

                <?= Carousel::widget([
                    'items' => $carousel,
                    'options' => [
                        'class' => 'carousel slide',
                        'data-interval' => 'false',
                        'id' => 'room-info' . $room->id
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
