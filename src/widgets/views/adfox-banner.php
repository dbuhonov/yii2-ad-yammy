<?php

use dmitrybukhonov\adyammy\widgets\factory\AdFox;

/**
 * @var AdFox $banner
 */

?>

<div class="banner banner-position-<?= $banner->getPositionId() ?>">
    <?= $banner->getCode() ?>
</div>