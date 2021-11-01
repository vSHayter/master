<?php

/**
 * @var $citys array
 */

?>
<ul class="list-group">
    <?php foreach ($citys as $city): ?>
        <li class="list-group-item" onclick='fillCityName("<?= $city['name']; ?>, <?= $city->country->name; ?>"); fillCityId("<?= $city['id']; ?>");'>
            <a>
                <?= $city->name . '(' . $city->country->name . ')' ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>