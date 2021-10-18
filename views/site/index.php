<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Master';
?>

<?= $this->render('/partials/parameter-modal', ['values' => $values]); ?>

<div class="site-head">
    <div class="search-background" style="background-image: url(img/site/desert.jpg)">
<!--        <div class="search-img">-->
<!--            <img src="img/site/desert.jpg">-->
<!--        </div>-->
        <div class="search-form">
            <div class="container search-nav">
                <ul class="nav nav-tabs justify-content-md-around" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="hotel-tab" data-toggle="tab" href="#hotel" role="tab" aria-controls="hotel" aria-selected="true">Hotels</a>
                    </li>
<!--                    <li class="nav-item" role="presentation">-->
<!--                        <a class="nav-link" id="flights-tab" data-toggle="tab" href="#flights" role="tab" aria-controls="flights" aria-selected="false">Flights</a>-->
<!--                    </li>-->
<!--                    <li class="nav-item" role="presentation">-->
<!--                        <a class="nav-link" id="cars-tab" data-toggle="tab" href="#cars" role="tab" aria-controls="cars" aria-selected="false">Cars</a>-->
<!--                    </li>-->
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane mt-3 fade show active" id="hotel" role="tabpanel" aria-labelledby="hotel-tab">
                        <form action="<?= Url::to(['hotel/index']) ?>" class="needs-validation" novalidate>
                            <div class="form-row" >
                                <div class="col-lg-5">
                                    <input type="text" class="form-control" name="cityName" id="cityName" autocomplete="off" placeholder="Going to" required>
                                    <div class="invalid-feedback">
                                        Please choose city.
                                    </div>
                                    <div class="list-city" id="display">
                                        <ul class="list-group">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" class="form-control" name="checkIn" value="<?= $values['checkIn']; ?>">
                                </div>
                                <div class="col-md-2">
                                    <input type="date" class="form-control" name="checkOut" value="<?= $values['checkOut']; ?>">
                                </div>
                                <div class="col-lg-3">
                                    <label type="text" class="form-control" data-toggle="modal" data-target="#parametersModal">
                                        <span class="count" id="travelers"><?= $values['travelers']; ?> travelers</span>
                                        <span class="count" id="room"><?= $values['room']; ?> room </span>
                                    </label>

                                    <input type="hidden" name="cityId" id="cityId">
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
            </div>
        </div>
    </div>
</div>

<div class="site-body">
    <div class="container">
        <div class="offer">
            <div class="offer-card card text-white">
                <div class="dark_block"></div>
                <img class=" card-img" src="img/site/offer4.jpg" alt="Card image">
                <div class="card-img-overlay">
                    <h2 class="card-title">Nature is calling</h2>
                    <p class="card-text">See what the great outdoors has to offer</p>
<!--                    <a href="#" class="btn btn-primary">Button</a>-->
                </div>
            </div>
            <div class="offer-card card mt-5 text-white">
                <div class="dark_block"></div>
                <img class="card-img" src="img/site/offer5.jpg" alt="Card image">
                <div class="card-img-overlay">
                    <h2 class="card-title">Italy is amazing</h2>
                    <p class="card-text">Take a Night Tour of Florence with Dinner in the City Center</p>
                </div>
            </div>
            <div class="offer-card card mt-5 text-white">
                <div class="dark_block"></div>
                <img class="card-img" src="img/site/offer6.jpg" alt="Card image">
                <div class="card-img-overlay">
                    <h2 class="card-title">Tea is not only tasty</h2>
                    <p class="card-text">Learn the amazing history of tea by visiting its homeland</p>
                </div>
            </div>
        </div>
        <div class="offer">
            <h2>Ideas for your next trip</h2>
            <div class="card-deck">
                <div class="offer-card card">
                    <img class="card-img-top" src="img/site/offer1.jpg" alt="Card image cap">
                </div>
                <div class="offer-card card">
                    <img class="card-img-top" src="img/site/offer2.jpg" alt="Card image cap">
                </div>
                <div class="offer-card card">
                    <img class="card-img-top" src="img/site/offer3.jpg" alt="Card image cap">
                </div>
            </div>
        </div>
    </div>
</div>