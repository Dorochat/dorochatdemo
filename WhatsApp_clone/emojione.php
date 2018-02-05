<?php
namespace Emojione;

# include the PHP library (if not autoloaded)
require('lib/php/autoload.php');

$client = new Client(new Ruleset());

################################################
# Optional:
# default is PNG but you may also use SVG
$client->imageType = 'png';

# default is ignore ASCII smileys like :) but you can easily turn them on
$client->ascii = true;

# if you want to host the images somewhere else
# you can easily change the default paths
$client->imagePathPNG = 'assets/png/';
$client->imagePathSVG = 'assets/svg/';
################################################
?>