<?php

declare(strict_types = 1);

use Rector\Config\RectorConfig;
use NeueCommerce\CodingStandards\Config\NeueCommerceRectorConfig;

return static function (RectorConfig $rectorConfig): void {
    NeueCommerceRectorConfig::setup($rectorConfig);

    $rectorConfig->disableParallel();
    // $rectorConfig->parallel(300);

    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);
};
