<?php
/**
 * @var \app\models\Hotel $hotel
 * @var \app\models\Booking $booking
 */

use yii\helpers\Url;

$this->title = $hotel->name;

$this->params['breadcrumbs'][] = ['label' => 'Hotels', 'url' => ['/']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <div class="overview"></div>
    <section></section>
    <div class="hotel-main">
        <div class="hotel-name"></div>
        <div class="hotel-reviews"></div>
    </div>
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
                                        Sign in to leave feedback.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                        <a class="btn btn-primary" href="<?= Url::to(['auth/login']) ?>" role="button">Ok</a>
                                    </div>
                                </div>
                            </div>
                        </div>

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

