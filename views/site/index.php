<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Master';
?>

<div class="site-index">
    <ul class="nav nav-tabs justify-content-between" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="hotel-tab" data-toggle="tab" href="#hotel" role="tab" aria-controls="hotel" aria-selected="true">Hotels</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="flights-tab" data-toggle="tab" href="#flights" role="tab" aria-controls="flights" aria-selected="false">Flights</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="cars-tab" data-toggle="tab" href="#cars" role="tab" aria-controls="cars" aria-selected="false">Cars</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane mt-3 fade show active" id="hotel" role="tabpanel" aria-labelledby="hotel-tab">
            <form action="<?= Url::to(['hotel/index']) ?>" class="needs-validation" novalidate>
                <div class="form-row" >
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="cityName" id="cityName" placeholder="Going to" required>
                        <div class="invalid-feedback">
                            Please choose city.
                        </div>
                        <input type="text" name="cityId" id="cityId" hidden="true">
                        <div id="display"></div>
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" name="checkIn" value="<?= $values['checkIn']; ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" name="checkOut" value="<?= $values['checkOut']; ?>">
                    </div>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" value="<?= $values['room']; ?> room, <?= $values['travelers']; ?> travelers">
                        <input type="hidden" name="room" value="<?= $values['room']; ?>">
                        <input type="hidden" name="travelers" value="<?= $values['travelers']; ?>">
                    </div>
                </div>
                <div class="col text-center">
                    <button type="submit" formmethod="get" class="mt-3 btn btn-outline-secondary">Search</button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="flights" role="tabpanel" aria-labelledby="flights-tab">
            <button>2</button>
        </div>
        <div class="tab-pane fade" id="cars" role="tabpanel" aria-labelledby="cars-tab">
            <button>3</button>
        </div>
    </div>

    <div class="body-content">
<!--        <div id="topCity" class="carousel slide" data-ride="carousel">-->
<!--            <ol class="carousel-indicators">-->
<!--                <li data-target="#topCity" data-slide-to="0" class="active"></li>-->
<!--                <li data-target="#topCity" data-slide-to="1"></li>-->
<!--                <li data-target="#topCity" data-slide-to="2"></li>-->
<!--            </ol>-->
<!--            <div class="carousel-inner">-->
<!--                <div class="carousel-item active">-->
<!--                    <img src="/web/img/la.jpg" class="d-block w-100" alt="...">-->
<!--                    <div class="carousel-caption d-none d-md-block">-->
<!--                        <h5>Метка первого слайда</h5>-->
<!--                        <p>Некоторый репрезентативный заполнитель для первого слайда.</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="carousel-item">-->
<!--                    <img src="./web/img/bali.jpg" class="d-block w-100" alt="...">-->
<!--                    <div class="carousel-caption d-none d-md-block">-->
<!--                        <h5>Метка второго слайда</h5>-->
<!--                        <p>Некоторый репрезентативный заполнитель для второго слайда.</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="carousel-item">-->
<!--                    <img src="/web/img/mayami.jpg" class="d-block w-100" alt="...">-->
<!--                    <div class="carousel-caption d-none d-md-block">-->
<!--                        <h5>Метка третьего слайда</h5>-->
<!--                        <p>Некоторый репрезентативный заполнитель для третьего слайда.</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <a class="carousel-control-prev" href="#topCity" role="button" data-slide="prev">-->
<!--                <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
<!--                <span class="sr-only">Предыдущий</span>-->
<!--            </a>-->
<!--            <a class="carousel-control-next" href="#topCity" role="button" data-slide="next">-->
<!--                <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
<!--                <span class="sr-only">Следующий</span>-->
<!--            </a>-->
<!--        </div>-->
    </div>
</div>