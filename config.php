<?php

require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\Yaml\Yaml;

$intro          = file_get_contents(__DIR__ . '/content/intro.md'); // The introductory text above the letter form
$body           = file_get_contents(__DIR__ . '/content/body.md'); // The body of the letter
$config         = Yaml::parse(file_get_contents(__DIR__ . '/config.yml'));
$recipient      = $config['recipient'];
$salutation     = $config['salutation'];
$signoff        = $config['signoff'];
$filename       = $config['filename'];
$analytics      = $config['analytics'];
