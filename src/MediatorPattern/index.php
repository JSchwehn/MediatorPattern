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
$data1 = $eventSystem->handle('foobar', array('UserName' => 'Jens Schwehn'));
$data2 = $eventSystem->handle('NewUser', array('UserName' => 'Bobby Tables'));
$data3 = $eventSystem->handle('NewUser', array('UserName' => 'Randall Munroe'));