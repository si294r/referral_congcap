<?php

include("/var/www/maxscale-config.php");

$mydatabase = $IS_DEVELOPMENT ? "congcapdev" : "congcap";

define('CACHE_USER_DEV', "congcapdev_user_");
define('CACHE_USER', "congcap_user_");
define('CACHE_REFERRAL_DEV', "congcapdev_ref_");
define('CACHE_REFERRAL', "congcap_ref_");

$SOCIAL_GRAPH_URL = "http://www.alegrium.com/sgi/2/{shorten_id.target_no}";

// IN-GAME COPIES

define('STR_VERIFIED_INSTALL_CRYSTALS1', "FREE {value} CRYSTALS!");
define('STR_VERIFIED_INSTALL_CRYSTALS2', "Thanks to you, someone played Cash, Inc.!");
//define('STR_VERIFIED_INSTALL_CRYSTALS1', "FREE CRYSTALS!");
//define('STR_VERIFIED_INSTALL_CRYSTALS2', "Your friend has installed Billionaire 2.");
//define('STR_VERIFIED_INSTALL_CASH1', "CASH REWARD!");
//define('STR_VERIFIED_INSTALL_CASH2', "Your friend has installed Billionaire 2.");

define('STR_ALERT_INBOX_TITLE1', "FREE CRYSTALS!");
define('STR_ALERT_INBOX_CAPTION1', "Boost your business now!");
define('STR_ALERT_INBOX_TITLE2', "SUBSCRIPTION ALMOST ENDS!");
define('STR_ALERT_INBOX_CAPTION2', "Extend time to enjoy the benefits even longer!");
define('STR_ALERT_INBOX_TITLE3', "SUBSCRIPTION HAD ENDED!");
define('STR_ALERT_INBOX_CAPTION3', "Let's get another!");
define('STR_ALERT_INBOX_TITLE4', "FREE CASH!");
define('STR_ALERT_INBOX_CAPTION4', "Let's build the other business!");
define('STR_ALERT_INBOX_TITLE_WEST', "FREE CASH!");
define('STR_ALERT_INBOX_CAPTION_WEST', "Let's build a business!");
define('STR_ALERT_INBOX_TITLE_EAST', "CASH BONUS!");
define('STR_ALERT_INBOX_CAPTION_EAST', "Continue your business journey now!");

// REFERRAL REWARD

$referral_reward = array(
    "1" => "75,GEM,INVITE_REWARD_1", // reward = 75 GEM
    "2" => "75,GEM,INVITE_REWARD_2", // reward = 75 GEM
    "3" => "75,GEM,INVITE_REWARD_3", // reward = 75 GEM
    "4" => "75,GEM,INVITE_REWARD_4", // reward = 75 GEM
);