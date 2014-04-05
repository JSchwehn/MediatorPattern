<?php

require_once 'Mediator.php';
require_once 'EventBus.php';
require_once 'Colleague.php';
require_once 'testPlugin.php';


$eventSystem = new \MediatorPattern\EventBus();

$testPlugin = new \MediatorPattern\testPlugin('testThingy', 'message given');
$testPlugin2 = clone $testPlugin;
$testPlugin2->setMessage('Somewhere over the rainbow');

$eventSystem->attach('NewUser',$testPlugin);

$eventSystem->notify('foobar');
$eventSystem->handle('foobar',array('UserName'=>'Jens Schwehn'));
$eventSystem->handle('NewUser',array('UserName'=>'Bobby Tables'));
$eventSystem->handle('NewUser',array('UserName'=>'Randall Munroe'));