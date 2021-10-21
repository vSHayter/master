<?php
/**
 * @var \app\models\Hotel[] $hotels
 * @var \app\models\User $user
 * @var \app\models\TypeHotel $type
 * @var \app\models\ServiceHotel $service
 *
 */

use app\widgets\SearchWidget;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Carousel;
use yii\helpers\Url;

$this->title = 'Hotels';
$this->params['breadcrumbs'][] = $this->title;
$request = Yii::$app->request;

?>

<div class="container pt-3">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <!--Search area start-->
    <?= SearchWidget::widget(['model' => $model, 'type' => 'index']) ?>
    <!--Search area end-->

    <div class="row mt-3">
        <div class="col-3 sidebar">
            <div class="sidebar-category">
                <div class="filter">
                    <h5>Your budget</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="defaultCheck1" value="option1">
                        <label class="form-check-label" for="defaultCheck1">Less $75</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="defaultCheck1" value="option1">
                        <label class="form-check-label" for="defaultCheck1">$75 - $125</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="defaultCheck1" value="option1">
                        <label class="form-check-label" for="defaultCheck1">$125 - $200</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="defaultCheck1" value="option1">
                        <label class="form-check-label" for="defaultCheck1">$200 - $300</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="defaultCheck1" value="option1">
                        <label class="form-check-label" for="defaultCheck1">More $300</label>
                    </div>
                </div>
            </div>
            <div class="sidebar-category">
                <div class="filter">
                    <h5>Hotel type</h5>
                    <?php foreach ($types as $type): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="typeCheck<?= $type->id ?>" value="option1">
                        <label class="form-check-label" for="defaultCheck1"><?= $type->name ?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="sidebar-category">
                <div class="filter">
                    <h5>Hotel service</h5>
                    <?php foreach ($services as $service): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="serviceCheck<?= $service->id ?>" value="option1">
                        <label class="form-check-label" for="serviceCheck<?= $service->id ?>"><?= $service->name ?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-9 hotel">
            <?php foreach ($hotels as $hotel): ?>
            <div class="card mb-2">
                <div class="row no-gutters">

                    <div class="col-md-4">
                        <div class="hotel-carousel">
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

                        <?php if ($user):?>
                                <?php if ($user->checkFavouriteHotelByUser($hotel->id)): ?>
                                    <a class="like liked" data-id="<?=$hotel->id?>">
                                        <i class="fa fa-heard" aria-hidden="true"></i>
                                    </a>
                                <?php else: ?>
                                    <a class="like" data-id="<?=$hotel->id?>">
                                        <i class="fa fa-heard" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
                        <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <a href="<?= Url::current(['hotel/single', 'idHotel' => $hotel->id])?>" class="hotel-link">
                        <div class="card-body card-tmp pt-3 pl-3 pr-3">
                            <h5 class="card-title mb-0"><?= $hotel->name; ?></h5>
                            <p class="card-text mb-1"><small class="text-muted"><?= $hotel->city->name . ', ' . $hotel->city->country->name ?></small></p>
                            <p class="card-text mb-1"><?= substr($hotel->description, 0, 337) . '...' ?></p>
                            <div class="row justify-content-sm-between">
                                <div class="col-md-6 d-flex justify-content-lg-start"
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
                                <div class="col-md-6 d-flex justify-content-lg-end">
                                    <p class="card-text text-right cost mt-2 "><strong>$<?= $hotel->getMinCostRoom($hotel->id) . ' ' ?> </strong></p>
                                    <p class="card-text text-right mt-2 "><small>за ночь</small></p>
                                </div>
                            </div>
                        </div>
                        </a>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>