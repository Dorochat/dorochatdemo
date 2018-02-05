<?php
require_once("emojione.php");// include Emojione Php Library from Emoji one

 $smileys = array(':see_no_evil:',':hear_no_evil:',':speak_no_evil:',':gorilla:',':dog:',':dog2:',':poodle:',':wolf:',':fox:',':cat:',':cat2:',':lion_face:',':tiger:',':leopard:',':horse:',':racehorse:',':deer:',':unicorn:',':unicorn:',':ox:',':water_buffalo:',':cow2:',':pig:',':ram:',':sheep:',':goat:',':dromedary_camel:',':camel:',':elephant:',':rhino:',':mouse:',':mouse2:',':hamster:',':rabbit:',':rabbit2:',':chipmunk:',':bat:',':bear:',':bear:',':panda_face:',':feet:',':turkey:',':chicken:',':rooster:',':hatching_chick:',':baby_chick:',':hatched_chick:',':bird:',':penguin:',':dove:',':eagle:',':duck:',':owl:',':frog:',':crocodile:',':turtle:',':lizard:',':snake:',':dragon_face:',':dragon:',':whale:',':whale2:',':dolphin:',':fish:',':tropical_fish:',':tropical_fish:',':shark:',':octopus:',':shell:',':crab:',':shrimp:',':squid:',':butterfly:',':snail:',':bug:',':ant:',':bee:',':beetle:',':spider:',':spider_web:',':scorpion:',':bouquet:',':cherry_blossom:',':rosette:',':rose:',':wilted_rose:',':hibiscus:',':sunflower:',':blossom:',':tulip:',':seedling:',':evergreen_tree:',':deciduous_tree:',':palm_tree:',':cactus:',':ear_of_rice:',':herb:',':shamrock:',':four_leaf_clover:',':maple_leaf:',':fallen_leaf:',':leaves:',':mushroom:',':chestnut:',':earth_africa:',':earth_americas:',':earth_asia:',':new_moon:',':waxing_crescent_moon:',':first_quarter_moon:',':waxing_gibbous_moon:',':full_moon:',':waning_gibbous_moon:',':last_quarter_moon:',':waning_crescent_moon:',':crescent_moon:',':new_moon_with_face:',':first_quarter_moon_with_face:',':last_quarter_moon_with_face:',':sunny:',':full_moon_with_face:',':sun_with_face:',':star:',':star2:',':cloud:',':bamboo:',':tanabata_tree:',':christmas_tree:',':snowman2:',':umbrella:');


 foreach ($smileys as $smile) {
 	?>
<span class="Animal_insert" data-tab="<?php echo $smile; ?>"> <?php echo $client->shortnameToImage($smile),' '; ?></span>
 	

 	<?php
 }


//This script is Brought to you by Dorocode->dorocode@gmail.com/ you can Contact our chat support : support@dorochat.com/ please any issue  that you may encouter during installation or Running This script on your server  let us know right away we will be grateful to help please.!

?>

  <script src="js/index.js"></script><!--handles send/receive chat messages-->