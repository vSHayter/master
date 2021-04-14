<?php
/**
 * @var \app\models\Hotel $hotel
 * @var \app\models\Booking $booking
 */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $hotel->name;

$this->params['breadcrumbs'][] = ['label' => 'Hotels', 'url' => [Url::current(['idHotel' => null])]];
$this->params['breadcrumbs'][] = $this->title;

$request = Yii::$app->request;
?>
<!--Warning modal start-->
<div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="exceptionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Oops</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Sign in to do this.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= Url::to(['auth/login']) ?>" role="button">Ok</a>
            </div>
        </div>
    </div>
</div>
<!--Warning modal end-->

<div class="row no-gutters">
    <div class="overview"></div>
    <section></section>
    <div class="hotel-main">
        <div class="hotel-name"></div>
        <div class="hotel-reviews"></div>
    </div>
</div>
<!--Rooms area start-->
<div class="row no-gutters">
    <div class="rooms">
        <div class="search">
            <h2>Choose your room</h2>
            <form action="<?= Url::current(['hotel/single']) ?>" class="needs-validation" novalidate>
                <div class="form-row" >
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
        <div class="mt-3 card-deck">
            <?php foreach ($hotel->rooms as $room): ?>
                <div class="card">
                    <img class="card-img-top" src="../<?= $room->roomImages[0]->image ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Name <?= $room->type->name ?> (ID <?= $room->id; ?>)</h5>
                        <p class="card-text">Area <?= $room->area ?></p>
                        <p class="card-text">Description <?= $room->description ?></p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text">$<?= $room->cost ?></p>
                        <small class="text-muted">per night</small>
                        <?php
                        $amount = $room->checkBookingRoom($room->id, $request->get('checkIn'), $request->get('checkOut'));
                        if ($amount): ?>
                            <p>We have <?= $amount ?></p>
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
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Room</label>
                                                        <?= $room->id; ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Check-in:</label>
                                                        <?= $request->get('checkIn'); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Check-out:</label>
                                                        <?= $request->get('checkOut'); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Travelers</label>
                                                        <?= $request->get('travelers'); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Rooms</label>
                                                        <?= $request->get('room'); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Wishes:</label>
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
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Reserve</button>
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
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!--Reviews area end-->

<!--Reviews area start-->
<div class="row no-gutters">
    <div class="reviews">
        <div class="row">
            <div class="col-4 hotel-rating">
                <div class="rating">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam at aut corporis cum
                        earum eius eum illo, itaque magnam nulla, quae reiciendis repellat reprehenderit sunt
                        tempore tenetur veniam veritatis vero.</p>
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

                            <div class="modal fade" id="exceptionModal" tabindex="-1" role="dialog" aria-labelledby="exceptionModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Oops</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            To leave a review about this hotel, you need to book a room in it.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>

                    <?php endif; ?>

                </div>
            </div>
            <div class="col-8 hotel-review">
                <?php foreach ($hotel->feedbacks as $feedback):?>
                    <div class="user-review border-bottom">
                        <p>Rating: <?= $feedback->rating; ?>/5</p>
                        <p>User name: <?= $feedback->booking->user->name; ?></p>
                        <p>Date feedback: <?= $feedback->date; ?></p>
                        <p>Date stayed: <?= $feedback->booking->date_start; ?> - <?= $feedback->booking->date_end; ?></p>
                        <p><?= $feedback->feedback; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!--Reviews area end-->