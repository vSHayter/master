<?php
/**
 * @var \app\models\Hotel[] $hotels
 * @var \app\models\User $user
 */

use yii\bootstrap4\Carousel;
use yii\helpers\Url;

$this->title = 'Hotels';
$this->params['breadcrumbs'][] = $this->title;
$request = Yii::$app->request;

?>

<?= $this->render('/partials/parameter-modal', [
        'values' => [
            'travelers' => $request->get('travelers'),
            'room' => $request->get('room')
        ]
]);
?>

<!--Search area start-->
<div class="row no-gutters">
    <div class="search">
        <form action="<?= Url::to(['hotel/index']) ?>" class="needs-validation" novalidate>
            <div class="form-row" >
                <div class="col-lg-4">
                    <input type="text" class="form-control" name="cityName" id="cityName" value="<?= $request->get('cityName')?>" placeholder="Going to" required>
                    <div class="invalid-feedback">
                        Please choose city.
                    </div>
                    <input type="text" name="cityId" id="cityId" hidden="true">
                    <div class="list-city" id="display">
                        <ul class="list-group">

                    </div>
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" name="checkIn" value="<?= $request->get('checkIn'); ?>">
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" name="checkOut" value="<?= $request->get('checkOut'); ?>">
                </div>
                <div class="col-lg-2">
                    <label type="text" class="form-control" data-toggle="modal" data-target="#parametersModal">
                        <span class="count" id="travelers"><?= $request->get('travelers') ?> travelers</span>
                        <span class="count" id="room"><?= $request->get('room'); ?> room </span>
                    </label>

                    <input type="hidden" name="room" value="<?= $request->get('room'); ?>">
                    <input type="hidden" name="travelers" value="<?= $request->get('travelers'); ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-secondary btn-block">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--Search area end-->

<div class="row mt-3">
    <div class="col-3 sidebar">
        Lorem ipsum dolor sit amet, j j j j j j consectetur adipisicing elit.
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
                            'content' => '<img src=/'.$image->image.'>',
                            'options' => ['class' => '']
                        ]; ?>
                    <?php endforeach; ?>

                    <?= Carousel::widget([
                        'items' => $carousel,
                        'options' => ['class' => 'carousel slide', 'data-interval' => "false"],
                    ]); ?>
                    <?php if ($user):?>
                            <?php if ($user->checkLikeHotelByUser($hotel->id)): ?>
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
                    <div class="card-body">
                        <h5 class="card-title"><?= $hotel->name; ?></h5>
                        <p class="card-text"><?= $hotel->description; ?></p>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="card-text"><small class="text-muted">Последнее обновление: 3 мин. назад</small></p>
                            </div>
                            <div class="col-md-6">
                                <p class="card-text text-right cost"><strong>$<?= $hotel->getMinCostRoom($hotel->id); ?></strong></p>
                                <p class="card-text text-right"><small>per night</small></p>
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
