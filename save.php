<?php

$json = json_decode($input);

$data['user_id'] = isset($json->user_id) ? $json->user_id : "";
$data['referrer'] = isset($json->referrer) ? $json->referrer : "";
$data['shorten_id'] = isset($json->shorten_id) ? $json->shorten_id : "";
$data['url_type'] = isset($json->url_type) ? $json->url_type : "1"; // 4 type shorten url

if (trim($data['referrer']) == "") {
    $data['referrer'] = $data['shorten_id'];
}

if (trim($data['user_id']) == "") {
    return array(
        "error" => 1,
        "message" => "Error: user_id is empty"
    );
}
if (trim($data['referrer']) == "") {
    return array(
        "error" => 1,
        "message" => "Error: referrer is empty"
    );
}

include("config.php");
$connection = get_readwrite_connection();

if (is_numeric($data['referrer']) && $data['referrer'] < 1223372036854775807) {
    /* 
     * referrer is filled with shorten_id, convert it to real user_id
     */
    $sql1 = "SELECT * FROM referral WHERE shorten_id = :shorten_id";
    $statement1 = $connection->prepare($sql1);
    $statement1->bindParam(":shorten_id", $data['referrer']);
    $statement1->execute();
    $row = $statement1->fetch(PDO::FETCH_ASSOC);
    $data['referrer'] = $row['user_id'];
}
    
$sql2 = "UPDATE referral "
        . "SET referrer = :referrer "
        . "WHERE user_id = :user_id "
        . "and (referrer is null or referrer <> :referrer1) ";
$statement2 = $connection->prepare($sql2);
$statement2->bindParam(":referrer", $data['referrer']);
$statement2->bindParam(":user_id", $data['user_id']);
$statement2->bindParam(":referrer1", $data['referrer']);
$statement2->execute();
$affected_row = $statement2->rowCount();

if ($affected_row > 0 && isset($referral_reward[ $data['url_type'] ])) {
    // TODO - integrate to inbox
    $sql = "SELECT * FROM referral WHERE user_id = :user_id ";
    $statement1 = $connection->prepare($sql);
    $statement1->execute(array(':user_id' => $data['referrer']));
    $row = $statement1->fetch(PDO::FETCH_ASSOC);

    $world = isset($row["world"]) ? $row["world"] : "1";

    if ($data['url_type'] == "1" || $data['url_type'] == "3") {
        $title = STR_VERIFIED_INSTALL_CASH1;
        $caption = STR_VERIFIED_INSTALL_CASH2;
        $reward = $referral_reward[ $data['url_type'] ] . "," . $world;
    } else {
        $title = STR_VERIFIED_INSTALL_CRYSTALS1;
        $caption = STR_VERIFIED_INSTALL_CRYSTALS2;
        $reward = $referral_reward[ $data['url_type'] ];
    }
    
    $device_id = $data['referrer'];
    $facebook_id = "";

    $sql = "INSERT INTO master_inbox (title, message, reward_1, target_device, target_fb, os, status, valid_from, valid_to)
            VALUES (:title, :caption, :data, :target_device, :target_fb, 'All', 1, null, null)";
    $statement1 = $connection->prepare($sql);
    $statement1->bindParam(":title", $title);
    $statement1->bindParam(":caption", $caption);
    $statement1->bindParam(":data", $reward);
    $statement1->bindParam(":target_device", $device_id);
    $statement1->bindParam(":target_fb", $facebook_id);
    $statement1->execute();
}

$data['affected_row'] = $affected_row;
$data['error'] = 0;
$data['message'] = 'Success';

return $data;
