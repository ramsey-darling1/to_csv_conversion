<?php 
/**
 * Pull images out of database 
 * needed for Shopify
 * @rdarling42
 *
 * */

include_once 'Db.php';

$db = new Db();

$rows = $db->select_order_by('images','id','DESC',500);

$count = 0;

if(!empty($rows)){
    echo "Pulling images out of database...\n";
    foreach($rows as $row){
        if(!empty($row['image']) && !empty($row['item_id'])){
            $image = imagecreatefromstring(stream_get_contents($row['image']));
            imagejpeg($image, "images/{$row['item_id']}.jpg");
            echo "Created image {$count}\n";
            $last_image_id = $row['id'];
        }
        $count += 1;
    }
    echo "Last image ID created {$last_image_id}\n";
}else{
    echo "No images found in database\n";
}


