<?php
require_once("emojione.php");// include Emojione Php Library from Emoji one

 $smileys = array(':space_invader:',':levitate:',':fencer:',':horse_racing:',':skier:',':snowboarder:',':golfer:',':surfer:',':rowboat:',':swimmer:',':basketball_player:',':lifter:',':bicyclist:',':mountain_bicyclist:',':cartwheel:',':wrestlers:',':water_polo:',':handball:',':juggling:',':circus_tent:',':performing_arts:',':art:',':slot_machine:',':bath:',':reminder_ribbon:',':tickets:',':ticket:',':military_medal:',':trophy:',':medal:',':first_place:',':second_place:',':third_place:',':soccer:',':baseball:',':basketball:',':volleyball:',':football:',':rugby_football:',':tennis:',':8ball:',':bowling:',':cricket:',':field_hockey:',':hockey:',':ping_pong:',':badminton:',':boxing_glove:',':martial_arts_uniform:',':goal:',':dart:',':golf:',':ice_skate:',':fishing_pole_and_fish:',':running_shirt_with_sash:',':ski:',':video_game:',':game_die:',':musical_score:',':microphone:',':headphones:',':saxophone:',':guitar:',':musical_keyboard:',':trumpet:',':violin:',':drum:',':clapper:',':bow_and_arrow:');


 foreach ($smileys as $smile) {
 	?>
<span class="Activity_insert" data-tab="<?php echo $smile; ?>"> <?php echo $client->shortnameToImage($smile),' '; ?></span>
 	

 	<?php
 }

 //This script is Brought to you by Dorocode->dorocode@gmail.com/ you can Contact our chat support : support@dorochat.com/ please any issue  that you may encouter during installation or Running This script on your server  let us know right away we will be grateful to help please.!

?>

  <script src="js/index.js"></script><!--handles send/receive chat messages-->


