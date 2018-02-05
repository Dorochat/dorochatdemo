<?php
require_once("emojione.php");// include Emojione Php Library from Emoji one

 $smileys = array(':grapes:',':melon:',':watermelon:',':tangerine:',':lemon:',':banana:',':pineapple:',':apple:',':green_apple:',':pear:',':peach:',':cherries:',':strawberry:',':kiwi:',':tomato:',':avocado:',':eggplant:',':potato:',':carrot:',':corn:',':hot_pepper:',':cucumber:',':peanuts:',':bread:',':bread:',':french_bread:',':pancakes:',':cheese:',':meat_on_bone:',':poultry_leg:',':bacon:',':hamburger:',':fries:',':pizza:',':hotdog:',':taco:',':burrito:',':stuffed_flatbread:',':egg:',':cooking:',':shallow_pan_of_food:',':stew:',':salad:',':popcorn:',':bento:',':rice_cracker:',':rice_ball:',':rice:',':curry:',':ramen:',':spaghetti:',':sweet_potato:',':oden:',':sushi:',':fried_shrimp:',':fish_cake:',':dango:',':icecream:',':shaved_ice:',':ice_cream:',':doughnut:',':cookie:',':birthday:',':cake:',':chocolate_bar:',':candy:',':lollipop:',':custard:',':honey_pot:',':baby_bottle:',':milk:',':coffee:',':tea:',':sake:',':champagne:',':wine_glass:',':cocktail:',':cocktail:',':beer:',':beers:',':champagne_glass:',':tumbler_glass:',':fork_knife_plate:',':fork_and_knife:',':spoon:');


 foreach ($smileys as $smile) {
 	?>
<span class="Food_insert" data-tab="<?php echo $smile; ?>"> <?php echo $client->shortnameToImage($smile),' '; ?></span>
 	

 	<?php
 }

//This script is Brought to you by Dorocode->dorocode@gmail.com/ you can Contact our chat support : support@dorochat.com/ please any issue  that you may encouter during installation or Running This script on your server  let us know right away we will be grateful to help please.!

?>

  <script src="js/index.js"></script><!--handles send/receive chat messages-->