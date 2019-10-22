<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');

$I->amOnPage('/form.php');
$I->submitForm('#data', [
  'license_plate' => 'AAJ-162', 
  'date' => '26-10-2019',
  'time' => '16:28'
]);
$I->see("Cars are allowed to road on weekends all the day.");
