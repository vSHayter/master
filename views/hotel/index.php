<?php
/**
 * @var \app\models\Hotel[] $hotels
 * @var \app\models\User $user
 */

use yii\helpers\Url;

$this->title = 'Hotels';
$this->params['breadcrumbs'][] = $this->title;
?>
<script type="text/javascript" src="../js/jquery.min.js"></script>

<div class="row">
    <div class="col-3 sidebar">
        Lorem ipsum dolor sit amet, j j j j j j consectetur adipisicing elit.
    </div>
    <div class="col-9 main">
        <?php foreach ($hotels as $hotel): ?>
        <div class="card mb-2">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <div id="carouselHotelImage" class="carousel slide" data-ride="carousel" data-interval="false">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselHotelImage" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselHotelImage" data-slide-to="1"></li>
                            <li data-target="#carouselHotelImage" data-slide-to="2"></li>
                            <li data-target="#carouselHotelImage" data-slide-to="3"></li>
                            <li data-target="#carouselHotelImage" data-slide-to="4"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://picsum.photos/280/200" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://picsum.photos/280/210" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://picsum.photos/280/205" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://picsum.photos/280/203" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://picsum.photos/280/220" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselHotelImage" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselHotelImage" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <?php if ($user):?>
                            <?php if ($user->checkLikeHotelByUser($hotel->id)): ?>
                                <button class="like btn btn-danger" data-id="<?=$hotel->id?>" id="like">♥</button>
                            <?php else: ?>
                                <button class="like" data-id="<?=$hotel->id?>" id="like">♥</button>
                            <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <a href="<?= Url::toRoute(['hotel/single', 'id' => $hotel->id])?>" class="hotel-link">
                    <div class="card-body">
                        <h5 class="card-title"><?= $hotel->name; ?> ID = <?= $hotel->id; ?></h5>
                        <p class="card-text"><?= $hotel->description; ?></p>
                        <p class="card-text"><small class="text-muted">Последнее обновление: 3 мин. назад</small></p>
                    </div>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</div>
