<?php
use yii\bootstrap4\Carousel;
use yii\helpers\Url;

/**
 * @var \app\models\Favourite $favourite
 */

?>

<div class="container">
    <div class="hotel">
        <h2 class="text-center">Liked</h2>
        <?php foreach ($favourites as $favourite):?>
            <div class="card mb-2">
                <div class="row no-gutters">

                    <div class="col-md-4">
                        <div class="hotel-carousel">
                            <?php $carousel = [];?>
                            <?php foreach ($favourite->hotel->hotelImages as $image): ?>
                                <?php $carousel [] = [
                                    'content' => '<img src=/'.$image->image.'>',
                                    'options' => ['class' => '']
                                ]; ?>
                            <?php endforeach; ?>

                            <?= Carousel::widget([
                                'items' => $carousel,
                                'options' => ['class' => 'carousel slide', 'data-interval' => "false"],
                                'showIndicators' => false,
                            ]); ?>
                            <?php if ($user):?>
                                <?php if ($user->checkFavouriteHotelByUser($favourite->hotel->id)): ?>
                                    <a class="like liked" data-id="<?=$favourite->hotel->id?>">
                                        <i class="fa fa-heard" aria-hidden="true"></i>
                                    </a>
                                <?php else: ?>
                                    <a class="like" data-id="<?=$favourite->hotel->id?>">
                                        <i class="fa fa-heard" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <a href="<?= Url::current(['hotel/single', 'idHotel' => $favourite->hotel->id])?>" class="hotel-link">
                            <div class="card-body card-tmp pt-3 pl-3 pr-3">
                                <h5 class="card-title mb-0"><?= $favourite->hotel->name; ?></h5>
                                <p class="card-text mb-1"><small class="text-muted"><?= $favourite->hotel->city->name . ', ' . $favourite->hotel->city->country->name ?></small></p>
                                <p class="card-text mb-1"><?= substr($favourite->hotel->description, 0, 337) . '...' ?></p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="card-text"><small class="text-muted">Rating:<?=  $favourite->hotel->getUserRating($favourite->hotel->id); ?></small></p>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-lg-end">
                                        <p class="card-text text-right cost mb-0"><strong>$<?= $favourite->hotel->getMinCostRoom($favourite->hotel->id) . ' ' ?> </strong></p>
                                        <p class="card-text text-right mb-0"><small>за ночь</small></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="row no-gutters justify-content-between">
                            <div class="pt-2 pl-2">
                                <a href="<?= Url::toRoute(['hotel/item-based', 'idHotel' => $favourite->hotel->id])?>" class="btn btn-info btn-sm ">Item-based</a>
                            </div>
                            <div class="stars">
                                <form action="">
                                    <input class="star star-5" id="star-5" type="radio" name="star"/>
                                    <label class="star star-5 mb-0" for="star-5"></label>
                                    <input class="star star-4" id="star-4" type="radio" name="star" />
                                    <label class="star star-4 mb-0" for="star-4"></label>
                                    <input class="star star-3" id="star-3" type="radio" name="star" />
                                    <label class="star star-3 mb-0" for="star-3"></label>
                                    <input class="star star-2" id="star-2" type="radio" name="star" />
                                    <label class="star star-2 mb-0" for="star-2"></label>
                                    <input class="star star-1" id="star-1" type="radio" name="star" />
                                    <label class="star star-1 mb-0" for="star-1"></label>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
