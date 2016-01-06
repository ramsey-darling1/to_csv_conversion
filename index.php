<?php 
/**
 * Convert from PostgreSQL database to CSV
 * format needed for Shopify
 * @rdarling42
 *
 * */

include_once 'Db.php';

function remove_quotes($str){
    $str = str_replace('"','',$str);
    return $str;
}

$db = new Db();

$rows = $db->select_order_by('item','id','DESC','100');


if(!empty($rows)){
    $csv = "Handle,Title,Body (HTML),Vendor,Type,Tags,Published,Option1 Name,Option1 Value,Option2 Name,Option2 Value,Option3 Name,Option3 Value,Variant SKU,Variant Grams,Variant Inventory Tracker,Variant Inventory Qty,Variant Inventory Policy,Variant Fulfillment Service,Variant Price,Variant Compare At Price,Variant Requires Shipping,Variant Taxable,Variant Barcode,Image Src,Image Alt Text,Gift Card,Google Shopping / MPN,Google Shopping / Age Group,Google Shopping / Gender,Google Shopping / Google Product Category,SEO Title,SEO Description,Google Shopping / AdWords Grouping,Google Shopping / AdWords Labels,Google Shopping / Condition,Google Shopping / Custom Product,Google Shopping / Custom Label 0,Google Shopping / Custom Label 1,Google Shopping / Custom Label 2,Google Shopping / Custom Label 3,Google Shopping / Custom Label 4,Variant Image,Variant Weight Unit\n";
    foreach($rows as $row){
        $row['copy'] = remove_quotes($row['copy']);
        //declairing variables to prevent array item not set errors at runtime
        $handle = !empty($row['id']) ? $row['id'] : null;
        $title = !empty($row['description']) ? $row['description'] : null;
        $body = !empty($row['copy']) ? $row['copy'] : null;
        $vendor = !empty($row['vendor_id']) ? $row['vendor_id'] : null;
        $type = !empty($row['dept_id']) ? $row['dept_id'] : null;
        $tags = !empty($row['tags']) ? $row['tags'] : null;
        $published = !empty($row['active']) ? $row['active'] : null;
        $option1_name = !empty($row['option1_name']) ? $row['option1_name'] : null;
        $option1_value = !empty($row['option1_value']) ? $row['option1_value'] : null;
        $option2_name = !empty($row['option2_name']) ? $row['option2_name'] : null;
        $option2_value = !empty($row['option2_value']) ? $row['option2_value'] : null;
        $option3_name = !empty($row['option3_name']) ? $row['option3_name'] : null;
        $option3_value = !empty($row['option3_value']) ? $row['option3_value'] : null;
        $variant_sku = !empty($row['variant_sku']) ? $row['variant_sku'] : null;
        $variant_grams = !empty($row['variant_grams']) ? $row['variant_grams'] : null;
        $variant_inventory_tracker = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $varient_inventory_qty = !empty($row['qty']) ? $row['qty'] : null;
        $variant_inventory_policy = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $variant_fulfillment_service = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $variant_price = !empty($row['cost']) ? $row['cost'] : null;
        $variant_compaire_at_price = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $variant_requires_shipping = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $variant_taxable = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $variant_barcode = !empty($row['upccode']) ? $row['upccode'] : null;
        $image_src = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $image_alt_text = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $gift_card = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $mpn_google_shopping = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $age_group_google_shopping = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $gender_google_shopping = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $google_product_category = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $seo_title = !empty($row['description']) ? $row['description'] : null;
        $seo_description = !empty($row['description']) ? $row['description'] : null;
        $google_shopping_adwords_grouping = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $google_shopping_adwords_labels = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $google_shopping_condition = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $google_shopping_custom_product = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $google_shopping_custom_label_0 = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $google_shopping_custom_label_1 = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $google_shopping_custom_label_2 = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $google_shopping_custom_label_3 = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $google_shopping_custom_label_4 = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $variant_image = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $variant_weight_unit = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $csv .= "{$handle},{$title},{$body},{$vendor},{$type},{$tags},{$published},{$option1_name},";
        $csv .= "{$option1_value},{$option2_name},{$option2_value},{$option3_name},{$option3_value},";
        $csv .= "{$option3_name},{$option3_value},{$variant_sku},{$variant_grams},{$variant_inventory_tracker},";
        $csv .= "{$varient_inventory_qty},{$variant_inventory_policy},{$variant_fulfillment_service},{$variant_price},";
        $csv .= "{$variant_compaire_at_price},{$variant_requires_shipping},{$variant_taxable},{$variant_barcode},";
        $csv .= "{$image_src},{$image_alt_text},{$gift_card},{$mpn_google_shopping},{$age_group_google_shopping},";
        $csv .= "{$gender_google_shopping},{$google_product_category},{$seo_title},{$seo_description},";
        $csv .= "{$google_shopping_adwords_grouping},{$google_shopping_adwords_labels},{$google_shopping_condition},";
        $csv .= "{$google_shopping_custom_product},{$google_shopping_custom_label_0},{$google_shopping_custom_label_1},";
        $csv .= "{$google_shopping_custom_label_2},{$google_shopping_custom_label_3},{$google_shopping_custom_label_4},";
        $csv .= "{$variant_image},{$variant_weight_unit}\n";
    }
    
    //create CSV file
    if(!empty($csv)){
        $filename = uniqid(time());
        $filename = "shopify_import_{$filename}.csv";
        $csv_file = fopen($filename,"w") or die("Error, not able to create file!!!\n"); 
        fwrite($csv_file,$csv);
        fclose($csv_file);
        echo "Successfully created CSV file\n";
        die;

    }else{
        //nothing to print. opps.  
        die("Error. Sorry, there was no data to print.\n");
    }

}else{
    //exit the script with warning message
    die("Sorry, there was an error grabbing the data from database\n");
}

