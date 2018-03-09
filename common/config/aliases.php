<?php

return [
    '@vendor' => dirname(dirname(__DIR__)) . '/vendor',
    '@webApp' => dirname(dirname(__DIR__)) . '/app',
    '@console' => dirname(dirname(__DIR__)) . '/console',
    '@common' => dirname(dirname(__DIR__)) . '/common',
    '@bower' => '@vendor/bower-asset',
    '@npm'   => '@vendor/npm-asset',
];