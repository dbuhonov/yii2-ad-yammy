<?php

return [
    'backendAppId' => 'app-backend',
    'imagePath' => '@storage/ad-image/',
    'imageUrl' => '@frontendUrl/images/storage/ad-image',
    'adPositionList' => \dmitrybukhonov\adyammy\helpers\AdPosition::getAll(),
];
