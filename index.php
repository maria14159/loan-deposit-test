<?php

require_once 'classes/Forms/Form.php';
require_once 'classes/Fields/Field.php';
require_once 'classes/Fields/CapitalizationField.php';
require_once 'classes/Fields/PassportField.php';
require_once 'classes/Fields/DateField.php';
require_once 'classes/Fields/TextField.php';

require_once 'classes/Forms/PhysicalForm.php';
require_once 'classes/Forms/LegalForm.php';

require 'classes/Router.php';

$url = key($_GET);

$router = new Router();
$router->addRoute('/', 'main.php');
$router->addRoute('/physical', 'physical.php');
$router->addRoute('/legal', 'legal.php');
$router->addRoute('/send', 'handler.php');

$router->route('/'.$url);