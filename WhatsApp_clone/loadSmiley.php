<?php
require_once("emojione.php");
// include Emojione Php Library from Emoji one

 $smileys = array(':smile:',':laughing:',':relaxed:',':kissing_heart:',':relieved:',':wink:',':grinning:',':stuck_out_tongue:',
 	':frowning:',':expressionless:',':grimacing:',':sweat:',':pensive:',':fearful:',':cry:',':astonished:',':tired_face:',':triumph:',
 	':mask:',':imp:',':no_mouth:',':yellow_heart:',':heart:',':heartbeat:',':revolving_hearts:',':sparkles:',':dizzy:',':anger:',':grey_exclamation:',':dash:',':musical_note:',':poop:',':thumbsup:',':ok_hand:',':fist:',':blush:',':point_up:',':point_right:',':point_up_2:',':metal:',':smirk:',':two_men_holding_hands:',':dancers:',':information_desk_person:',':person_with_pouting_face:',':couplekiss:',':haircut:',':girl:',':baby:',':person_with_blond_hair:',':construction_worker:',':princess:',':heart_eyes_cat:',':scream_cat:',':pouting_cat:',':see_no_evil:',':guardsman:',':lips:',':ear:',':tongue:',':busts_in_silhouette:',':kissing_closed_eyes:',':satisfied:',':stuck_out_tongue_winking_eye:',':kissing:',':sleeping:',':anguished:',':confused:',':unamused:',':disappointed_relieved:',':disappointed:',':cold_sweat:',':sob:',':scream:',':angry:',':sleepy:',':sunglasses:',':smiling_imp:',':innocent:',':blue_heart:',':green_heart:',':heartpulse:',':cupid:',':star:',':boom:',':exclamation:',':grey_question:',':sweat_drops:',':fire:',':shit:',':-1:',':punch:',':v:',':raised_hand:',':point_down:',':raised_hands:',':clap:',':bow:',':couple:',':two_women_holding_hands:',':ok_woman:',':raising_hand:',':couple_with_heart:',':nail_care:',':woman:',':older_woman:',':man_with_gua_pi_mao:',':cop:',':smiley_cat:',':kissing_cat:',':crying_cat_face:',':japanese_ogre:',':hear_no_evil:',':skull:',':kiss:',':eyes:',':love_letter:',':speech_balloon:',':grin:',':smiley:',':heart_eyes:',':flushed:',':grin:',':stuck_out_tongue_closed_eyes:',':worried:',':kissing_smiling_eyes:',':open_mouth:',':speak_no_evil:',':feet:',':joy_cat:');


 foreach ($smileys as $smile) {
 	?>
<span class="smile_insert" data-tab="<?php echo $smile; ?>"> <?php echo $client->shortnameToImage($smile),' '; ?></span>
 	

 	<?php
 }

 //This script is Brought to you by Dorocode->dorocode@gmail.com/ you can Contact our chat support : support@dorochat.com/ please any issue  that you may encouter during installation or Running This script on your server  let us know right away we will be grateful to help please.!

?>

  <script src="js/index.js"></script><!--handles send/receive chat messages-->