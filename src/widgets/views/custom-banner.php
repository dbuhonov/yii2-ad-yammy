<?php

use dmitrybukhonov\adyammy\widgets\factory\CustomBanner;

/**
 * @var CustomBanner $banner
 */

?>
<?php if ($banner->getImageUrl()) : ?>
    <div class="module">
        <div class="bns <?= $banner->getImageClass() ?> banner-position-<?= $banner->getPositionId() ?>">
            <a href="<?= $banner->getBannerUrl() ?>" target="_blank">
                <img src="<?= $banner->getImageUrl() ?>" alt="<?= $banner->getTitle() ?>">
            </a>
        </div>
    </div>
<?php endif; ?>