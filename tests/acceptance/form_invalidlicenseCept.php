<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');

$I->amOnPage('/form.php');
$I->submitForm('#data', [
  'license_plate' => 'AAJ4-162', 
  'date' => '26/10/2019',
  'time' => '16:28'
]);
$I->see("The license plate isn't valid.");