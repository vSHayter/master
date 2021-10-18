<?php

use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Carousel;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \app\models\Hotel $hotel
 * @var \app\models\Booking $booking
 */


$this->title = $hotel->name;

$this->params['breadcrumbs'][] = ['label' => 'Hotels', 'url' => [Url::current(['idHotel' => null])]];
$this->params['breadcrumbs'][] = $this->title;

$request = Yii::$app->request;
?>

<!--Warning modal start-->
<?= $this->render('/partials/warning-modal'); ?>
<?= $this->render('/partials/exception-modal'); ?>
<!--Warning modal end-->

<div class="container pt-3">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <!--Main hotel info start-->
    <div class="row no-gutters">
        <!-- image hotel start-->
        <div class="overview"></div>
        <!-- image hotel end-->
        <section></section>
        <div class="hotel-main">
            <div class="row no-gutters">
                <div class="col-md-6 pr-5">
                    <div class="hotel-name">
                        <h1><?= $hotel->name ?></h1>
                    </div>
                    <div class="hotel-reviews"></div>
                    <div class="hotel-description">
                        <p><?= $hotel->description?></p>
                    </div>
                    <div class="hotel-address">
                        <p><?= $hotel->address . ' (' . $hotel->city->country->name . ')'?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="shotel-carousel h344px">
                        <?php $carousel = [];?>
                        <?php foreach ($hotel->hotelImages as $image): ?>
                            <?php $carousel [] = [
                                'content' => '<img src=../img/'.$image->image.'>',
                                'options' => ['class' => '']
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
            <div class="search">
                <h2>Choose your room</h2>
                <form action="<?= Url::current(['hotel/single']) ?>" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="col-md-2">
                            <input type="date" class="form-control" name="checkIn" value="<?= $request->get('checkIn'); ?>">
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" name="checkOut" value="<?= $request->get('checkOut'); ?>">
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?= $request->get('room'); ?> room, <?= $request->get('travelers') ?> travelers">
                            <input type="hidden" name="room" value="<?= $request->get('room'); ?>">
                            <input type="hidden" name="idHotel" value="<?= $hotel->id; ?>">
                            <input type="hidden" name="travelers" value="<?= $request->get('travelers') ?>">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-outline-secondary btn-block">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row">
                <?php foreach ($hotel->rooms as $room): ?>

                <?php if(count($hotel->rooms) < 2): ?>
                    <div class="col mt-5">
                <?php elseif (count($hotel->rooms) < 3): ?>
                    <div class="h-100 col-md-6 mt-5">
                <?php else:?>
                    <div class="h-100 col-lg-4 mt-5">
                <?php endif;?>
                        <div class="card">
                            <img class="room-image card-img-top" src="../img/<?= $room->roomImages[0]->image ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $room->type->name ?></h5>
                                <p class="card-text">Площадь <?= $room->area ?> м <sup><small>2</small></sup></p>
                                <p class="card-text"><?= $room->description ?></p>
                            </div>
                            <div class="card-footer">
                                <p class="card-text">$<?= $room->cost ?></p>
                                <small class="text-muted">per night</small>
                                <?php
                                $amount = $room->checkBookingRoom($room->id, $request->get('checkIn'), $request->get('checkOut'));
                                if ($amount): ?>
                                    <p>We have <?= $amount ?></p>
                                    <button type="button" class="btn btn-outline-secondary btn-block" data-toggle="modal" data-target="#roomModal<?= $room->id; ?>">
                                        Look
                                    </button>

                                    <div class="modal fade" id="roomModal<?= $room->id; ?>" tabindex="-1" role="dialog" aria-labelledby="roomModal<?= $room->id; ?>" aria-hidden="true">
                                        <div class="room-modal modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="container">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Room information</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
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
                                                                            'options' => ['class' => '']
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
                                                    <div class="modal-footer">
                                                        <!--                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                                                        <!--                                                            <button type="button" class="btn btn-primary">Save changes</button>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (Yii::$app->user->isGuest): ?>
                                        <button type="button" class="btn btn-outline-secondary btn-block" data-toggle="modal" data-target="#warningModal">
                                            Reserve
                                        </button>
                                    <?php else: ?>

                                        <button type="button" class="btn btn-outline-secondary btn-block" data-toggle="modal" data-target="#bookingModal<?= $room->id; ?>">
                                            Reserve
                                        </button>

                                        <div class="modal fade" id="bookingModal<?= $room->id; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="bookingModalLabel<?= $room->id; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Review and book</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= Url::to(['booking/booking']) ?>" method="post" class="needs-validation" novalidate>
                                                        <div class="modal-body">
                                                            <div class="form-group mb-0">
                                                                <label for="message-text" class="col-form-label">Room</label>
                                                                <?= $room->type->name; ?>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label for="message-text" class="col-form-label">Дата заезда:</label>
                                                                <?= $request->get('checkIn'); ?>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label for="message-text" class="col-form-label">Дата выезда:</label>
                                                                <?= $request->get('checkOut'); ?>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label for="message-text" class="col-form-label">Человек</label>
                                                                <?= $request->get('travelers'); ?>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label for="message-text" class="col-form-label">Номеров</label>
                                                                <?= $request->get('room'); ?>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label for="message-text" class="col-form-label">Поделания:</label>
                                                                <textarea class="form-control" name="wishes" id="wishes"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="_csrf" value="<?= $request->getCsrfToken()?>" />
                                                            <input type="hidden" name="checkIn" value="<?= $request->get('checkIn'); ?>"/>
                                                            <input type="hidden" name="checkOut" value="<?= $request->get('checkOut'); ?>"/>
                                                            <input type="hidden" name="travelers" value="<?= $request->get('travelers'); ?>"/>
                                                            <input type="hidden" name="amount_room" value="<?= $request->get('room'); ?>"/>
                                                            <input type="hidden" name="idRoom" value="<?= $room->id ?>"/>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                                            <button type="submit" class="btn btn-primary">Забронировать</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
    <!--Hotel service area start-->

    <!--Reviews area start-->
    <div class="row no-gutters">
        <div class="reviews w-100">
            <div class="row">
                <div class="col-4 hotel-rating">
                    <div class="rating">
                        <p>Средний рейтинг отеля по оценкам пользователей составляет: <?= $hotel->getUserRating($hotel->id) ?></p>
                    </div>
                    <div class="create-review">

                        <?php if(Yii::$app->user->isGuest): ?>

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#warningModal">
                                Write a review
                            </button>

                        <?php else: ?>

                            <?php if($booking): ?>

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reviewModal">
                                    Write a review
                                </button>

                                <div class="modal fade" id="reviewModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Hotel review</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= Url::to(['feedback/review']) ?>" method="post" class="needs-validation" novalidate>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <select name="user-rating" class="custom-select" required>
                                                            <option value="" hidden>Open this select menu</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                            <option value="4">Four</option>
                                                            <option value="5">Five</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Review:</label>
                                                        <textarea class="form-control" name="user-feedback" id="user-feedback" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                                                    <input type="hidden" name="hotel" value="<?= $hotel->id ?>"/>
                                                    <input type="hidden" name="booking" value="<?= $booking->id ?>"/>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Send</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            <?php else: ?>

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exceptionModal">
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
                            <p class="mb-1">Имя пользователя: <?= $feedback->booking->user->name; ?></p>
                            <p class="mb-1">Дата отзыва: <?= $feedback->date; ?></p>
                            <p class="mb-1">Дата посещения: <?= $feedback->booking->date_start; ?> - <?= $feedback->booking->date_end; ?></p>
                            <p class="mb-3"><?= $feedback->feedback; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!--Reviews area end-->
</div>