<div class="container">
    <h2 class="text-center">Your Feedback</h2>
    <div class="row">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Hotel</th>
                <th scope="col">Rating</th>
                <th scope="col">Date feedback</th>
                <th scope="col">Text</th>
            </tr>
            </thead>
            <tbody>
            <?php use yii\helpers\Url;

            foreach ($feedbacks as $feedback): ?>
                <tr>
                    <td>
                        <a href="<?= Url::current(['hotel/single', 'idHotel' => $feedback->id_hotel])?>" class="hotel-link">
                        </a>
                        <?= $feedback->hotel->name ?>
                    </td>
                    <td><?= $feedback->rating ?></td>
                    <td><?= $feedback->date ?></td>
                    <td><?= $feedback->feedback ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <hr>
    </div>

</div>