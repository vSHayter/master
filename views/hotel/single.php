<?php

use app\models\Booking;
use app\models\Feedback;
use app\widgets\SearchWidget;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Button;
use yii\bootstrap4\Carousel;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\helpers\Url;

/**
 * @var \app\models\Hotel $hotel
 * @var \app\models\Booking $booking
 * @var \app\models\SearchForm $searchForm
 */


$this->title = $hotel->name;

$request = Yii::$app->request;
?>

<!-- Exception modal start -->
<?php Modal::begin([
    'title' => 'Oops',
    'footer' => '<button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                 <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>',
    'options' => [
        'id' => 'exceptionModal',
    ],
]);

    Modal::end()
?>
<!-- Exception modal end -->

<!-- Booking modal start -->
<?php Modal::begin([
    'title' => 'Review and book',
    'options' => [
        'id' => 'bookingModal',
    ],
]);

$bookingForm = ActiveForm::begin([
    'method' => 'post',
    'action' => Url::to(['booking/booking']),
]);
$bookingModel = new Booking();
?>

<?= $bookingForm->field($bookingModel, 'id_room')->hiddenInput(['value' => '1'])->label('Room'); ?>
<?= $bookingForm->field($bookingModel, 'date_start')->input('date', ['value' => $searchForm->checkIn])->label('Check in'); ?>
<?= $bookingForm->field($bookingModel, 'date_end')->input('date', ['value' => $searchForm->checkOut])->label('Check out'); ?>
<?= $bookingForm->field($bookingModel, 'amount_people')->textInput(['value' => $searchForm->travelers])->label('Amount travelers'); ?>
<?= $bookingForm->field($bookingModel, 'amount_room')->textInput(['value' => $searchForm->room])->label('Amount rooms'); ?>
<?= $bookingForm->field($bookingModel, 'wishes')->textarea(['rows' => '3'])->label('Wishes'); ?>
<?= $bookingForm->field($bookingModel, 'date_booking')->hiddenInput(['value' => date("Y-m-d")])->label(false); ?>
<?= $bookingForm->field($bookingModel, 'status')->hiddenInput(['value' => 0])->label(false); ?>
<?= $bookingForm->field($bookingModel, 'id_user')->hiddenInput(['value' => Yii::$app->user->id])->label(false); ?>

<?= Button::widget(['label' => 'Cancel', 'options' => ['class' => 'btn btn-secondary float-right', 'data-dismiss' => 'modal']]); ?>
<?= Html::submitButton('Booking', ['class' => 'btn btn-primary float-right mr-2']); ?>

<?php
ActiveForm::end();
Modal::end();
?>
<!-- Booking modal end -->

<!-- Room modal start -->
<?php Modal::begin([
        'title' => 'Room information',
        'options' => [
            'id' => 'roomModal',
            'class' => 'modal-fullscreen'
        ]
]);
?>

<?php
Modal::end();
?>
<!-- Room modal end -->

<div class="container pt-3">
    <!--Main hotel info start-->
    <div class="row no-gutters">
        <div class="hotel-main">
            <div class="row no-gutters">
                <div class="col-md-6 pr-5">
                    <div class="hotel-name">
                        <h1><?= $hotel->name ?></h1>
                    </div>
                    <div class="hotel-description">
                        <p><?= $hotel->description?></p>
                    </div>
                    <div class="hotel-address">
                        <p><?= $hotel->address . ' (' . $hotel->city->country->name . ')'?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="hotel-carousel">
                        <?php $carousel = [];?>
                        <?php foreach ($hotel->hotelImages as $image): ?>
                            <?php $carousel [] = [
                                'content' => '<img src=../img/'.$image->image.'>',
                                'options' => ['class' => 'hotel-image']
                            ]; ?>
                        <?php endforeach; ?>

                        <?= Carousel::widget([
                            'items' => $carousel,
                            'options' => ['class' => 'carousel slide', 'data-interval' => "false"],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Main hotel info end-->

    <!--Rooms area start-->
    <div class="row no-gutters">
        <div class="rooms">
            <h2>Choose your room</h2>
            <?= SearchWidget::widget([
                    'model' => $searchForm,
                    'options' => [
                        'type' => 'single',
                        'action' => Url::toRoute(['hotel/single', 'idHotel' => $hotel->id]),
                    ]
            ]) ?>

            <div class="row">
                <?php foreach ($hotel->rooms as $room): ?>

                <?php if(count($hotel->rooms) < 2): ?>
                    <div class="col mt-5">
                <?php elseif (count($hotel->rooms) < 3): ?>
                    <div class="col-md-6 mt-5">
                <?php else:?>
                    <div class="col-lg-4 mt-5">
                <?php endif;?>
                        <div class="card h-100">
                            <img class="room-image card-img-top" src="../img/<?= $room->roomImages[0]->image ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $room->type->name ?></h5>
                                <p class="card-text">Площадь <?= $room->area ?> м <sup><small>2</small></sup></p>
                                <p class="card-text"><?= $room->description ?></p>
                            </div>
                            <div class="card-footer">
                                <p class="card-text float-right">$<?= $room->cost ?></p>
                                <small class="text-muted mr-2 float-right">per night</small>

                                <?php
                                $amount = $room->checkRoomAvailability($room->id, $request->get()['SearchForm']['checkIn'], $request->get()['SearchForm']['checkOut']);
                                if ($amount): ?>
                                    <p>We have <?= $amount ?></p>
                                    <button type="button" class="btn btn-outline-secondary btn-block" data-toggle="modal" data-target="#roomModal" data-room-id="<?=$room->id?>">
                                        Look
                                    </button>

                                    <?php if (Yii::$app->user->isGuest): ?>

                                        <button type="button" class="btn btn-outline-secondary btn-block" data-toggle="modal" data-target="#exceptionModal" data-type="warning">
                                            Reserve
                                        </button>

                                    <?php else: ?>

                                        <button type="button" class="btn btn-outline-secondary btn-block mt-2" data-toggle="modal" data-target="#bookingModal" data-booking-room="<?=$room->id?>" data-room-type="<?=$room->type->name?>">
                                            Reserve
                                        </button>

                                    <?php endif; ?>

                                <?php else: ?>

                                    <p>We are sold out</p>

                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!--Rooms area end-->

    <!--Hotel service area start-->
    <div class="row no-gutters pt-3">
        <div class="col-4">
            <h2>Property amenities</h2>
        </div>
        <div class="col-8">
            <h4>Hotel amenities</h4>
            <?php foreach ($hotel->indexHotelServices as $service): ?>
                <p class="mb-1"><?= $service->service->name ?></p>
            <?php endforeach; ?>
            <hr>
        </div>
    </div>
    <!--Hotel service area end-->

    <!--Reviews area start-->
    <div class="row no-gutters">
        <div class="reviews w-100">
            <div class="row">
                <div class="col-4 hotel-rating">
                    <div class="rating">
                        <p>The average hotel rating according to user ratings is: <?= $hotel->getUserRating($hotel->id) ?></p>
                    </div>
                    <div class="create-review">

                        <?php if(Yii::$app->user->isGuest): ?>

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exceptionModal" data-type="warning">
                                Write a review
                            </button>

                        <?php else: ?>

                            <?php if($booking): ?>

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reviewModal">
                                    Write a review
                                </button>

                                <!-- Feedback modal start -->
                                <?php Modal::begin([
                                    'title' => 'Hotel review',
                                    'options' => [ 'id' => 'reviewModal' ],
                                ]);

                                $form = ActiveForm::begin([
                                    'method' => 'post',
                                    'action' => Url::to(['feedback/review']),
                                ]);

                                $feedback = new Feedback();
                                $stars = [ '1' => 'One', '2' => 'Two', '3' => 'Three', '4' => 'Four', '5' => 'Five'];
                                ?>

                                <?= $form->field($feedback, 'rating')->dropdownList($stars); ?>
                                <?= $form->field($feedback, 'feedback')->textarea(['rows' => '3'])->label('Review'); ?>
                                <?= $form->field($feedback, 'date')->hiddenInput(['value' => date("Y-m-d")])->label(false); ?>
                                <?= $form->field($feedback, 'id_hotel')->hiddenInput(['value' => $hotel->id])->label(false); ?>
                                <?= $form->field($feedback, 'id_booking')->hiddenInput(['value'=> $booking->id])->label(false); ?>

                                <?= Button::widget([
                                    'label' => 'Close',
                                    'options' => [
                                        'class' => 'btn btn-secondary float-right',
                                        'data-dismiss' => 'modal',
                                    ]
                                ]);
                                ?>

                                <?= Html::submitButton('Send', ['class' => 'btn btn-primary mr-2 float-right']) ?>

                                <?php ActiveForm::end();
                                Modal::end();
                                ?>
                                <!-- Feedback modal end -->

                            <?php else: ?>

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exceptionModal" data-type="exception">
                                    Write a review
                                </button>

                            <?php endif; ?>

                        <?php endif; ?>

                    </div>
                </div>
                <div class="col-8 hotel-review">
                    <?php foreach ($hotel->feedbacks as $feedback):?>
                        <div class="user-review border-bottom">
                            <p class="mb-1">Рейтинг: <?= $feedback->rating; ?>/5</p>
                            <p class="mt-1">Имя пользователя: <?= $feedback->booking->user->name; ?></p>
                            <p class="mt-1">Дата отзыва: <?= $feedback->date; ?></p>
                            <p class="mt-1">Дата посещения: <?= $feedback->booking->date_start; ?> - <?= $feedback->booking->date_end; ?></p>
                            <p class="mt-3"><?= $feedback->feedback; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!--Reviews area end-->
</div>