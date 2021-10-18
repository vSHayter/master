<?php

/**
 * @var \app\models\Booking $trip
 */

use yii\helpers\Url;

?>
<div class="container">
    <h2 class="text-center">Your trips</h2>
        <div class="row">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Hotel</th>
                    <th scope="col">Room</th>
                    <th scope="col">Amount room</th>
                    <th scope="col">Amount people</th>
                    <th scope="col">Wishes</th>
                    <th scope="col">Date booking</th>
                    <th scope="col">Date arrival</th>
                    <th scope="col">Date departure</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($trips as $trip): ?>
                <tr>
                    <td>
                        <a href="<?= Url::current(['hotel/single', 'idHotel' => $trip->room->hotel->id])?>" class="hotel-link">
                        </a>
                        <?= $trip->room->hotel->name ?>
                    </td>
                    <td><?= $trip->room->type->name ?></td>
                    <td><?= $trip->amount_room ?></td>
                    <td><?= $trip->amount_people ?></td>
                    <td><?= $trip->wishes ?></td>
                    <td><?= $trip->date_booking ?></td>
                    <td><?= $trip->date_start ?></td>
                    <td><?= $trip->date_end ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <hr>
        </div>

</div>
