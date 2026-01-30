<?php

declare(strict_types=1);

use ScreenScraper\Data\AuthData;

it('establish properly the object', function (): void {
    $authData = new AuthData(
        devId: 'myDevId',
        devPassword: 'myDevPassword',
        softwareName: 'mySoftname',
    );

    expect($authData->devId)
        ->toBe('myDevId')
        ->and($authData->devPassword)
        ->toBe('myDevPassword')
        ->and($authData->softwareName)
        ->toBe('mySoftname')
        ->and($authData->output)
        ->toBe('json');
});
