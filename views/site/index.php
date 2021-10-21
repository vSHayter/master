<?php

/* @var $this yii\web\View */
/* @var $model app\models\SearchForm */


use app\widgets\SearchWidget;

$this->title = 'Master';
?>

<div class="search-background" style="background-image: url(img/site/desert.jpg)">
    <div class="search-form">
        <div class="container search-nav">
            <?= SearchWidget::widget()?>
        </div>
    </div>
</div>

<div class="site-body">
    <div class="container">
        <div class="offer">
            <div class="offer-card card text-white">
                <div class="dark_block"></div>
                <img class=" card-img" src="../../img/site/offer4.jpg" alt="Card image">
                <div class="card-img-overlay">
                    <h2 class="card-title">Nature is calling</h2>
                    <p class="card-text">See what the great outdoors has to offer</p>
                </div>
            </div>
            <div class="offer-card card mt-5 text-white">
                <div class="dark_block"></div>
                <img class="card-img" src="../img/site/offer5.jpg" alt="Card image">
                <div class="card-img-overlay">
                    <h2 class="card-title">Italy is amazing</h2>
                    <p class="card-text">Take a Night Tour of Florence with Dinner in the City Center</p>
                </div>
            </div>
            <div class="offer-card card mt-5 text-white">
                <div class="dark_block"></div>
                <img class="card-img" src="../img/site/offer6.jpg" alt="Card image">
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
                    <img class="card-img-top" src="../img/site/offer1.jpg" alt="Card image cap">
                </div>
                <div class="offer-card card">
                    <img class="card-img-top" src="../img/site/offer2.jpg" alt="Card image cap">
                </div>
                <div class="offer-card card">
                    <img class="card-img-top" src="../img/site/offer3.jpg" alt="Card image cap">
                </div>
            </div>
        </div>
    </div>
</div>