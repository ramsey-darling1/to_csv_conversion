<?php 
/**
 * Convert from PostgreSQL database to CSV
 * format needed for Shopify
 * @rdarling42
 *
 * */


include_once 'Db.php';

$db = new Db();

$rows = $db->select_order_by('wonderbug','one','DESC','100');

if(!empty($rows)){
    $csv = "Handle,Title,Body (HTML),Vendor,Type,Tags,Published,Option1 Name,Option1 Value,Option2 Name,Option2 Value,Option3 Name,Option3 Value,Variant SKU,Variant Grams,Variant Inventory Tracker,Variant Inventory Qty,Variant Inventory Policy,Variant Fulfillment Service,Variant Price,Variant Compare At Price,Variant Requires Shipping,Variant Taxable,Variant Barcode,Image Src,Image Alt Text,Gift Card,Google Shopping / MPN,Google Shopping / Age Group,Google Shopping / Gender,Google Shopping / Google Product Category,SEO Title,SEO Description,Google Shopping / AdWords Grouping,Google Shopping / AdWords Labels,Google Shopping / Condition,Google Shopping / Custom Product,Google Shopping / Custom Label 0,Google Shopping / Custom Label 1,Google Shopping / Custom Label 2,Google Shopping / Custom Label 3,Google Shopping / Custom Label 4,Variant Image,Variant Weight Unit\n";
    foreach($rows as $row){
        //declairing variables to prevent array item not set errors at runtime
        $handle = !empty($row['handle']) ? $row['handle'] : null;
        $title = !empty($row['title']) ? $row['title'] : null;
        $body = !empty($row['body']) ? $row['body'] : null;
        $vendor = !empty($row['vendor']) ? $row['vendor'] : null;
        $type = !empty($row['type']) ? $row['type'] : null;
        $tags = !empty($row['tags']) ? $row['tags'] : null;
        $published = !empty($row['published']) ? $row['published'] : null;
        $option1_name = !empty($row['option1_name']) ? $row['option1_name'] : null;
        $option1_value = !empty($row['option1_value']) ? $row['option1_value'] : null;
        $option2_name = !empty($row['option2_name']) ? $row['option2_name'] : null;
        $option2_value = !empty($row['option2_value']) ? $row['option2_value'] : null;
        $option3_name = !empty($row['option3_name']) ? $row['option3_name'] : null;
        $option3_value = !empty($row['option3_value']) ? $row['option3_value'] : null;
        $variant_sku = !empty($row['variant_sku']) ? $row['variant_sku'] : null;
        $variant_grams = !empty($row['variant_grams']) ? $row['variant_grams'] : null;
        $variant_inventory_tracker = !empty($row['variant_inventory_tracker']) ? $row['variant_inventory_tracker'] : null;
        $varient_inventory_qty = !empty($row['varient_inventory_qty']) ? $row['varient_inventory_qty'] : null;
        $variant_inventory_policy = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $variant_fulfillment_service = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $variant_price = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $variant_compaire_at_price = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $variant_requires_shipping = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $variant_taxable = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $variant_barcode = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $image_src = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $image_alt_text = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $gift_card = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $mpn_google_shopping = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $age_group_google_shopping = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $gender_google_shopping = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $google_product_category = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $seo_title = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $seo_description = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $google_shopping_adwords_grouping = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $google_shopping_adwords_labels = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $google_shopping_condition = !empty($row['placeholder']) ? $row['placeholder'] : null;
        $csv .= "{$handle},{$title}";
    }

}else{
    //exit the script with warning message
    die("Sorry, there was an error grabbing the data from database");
}
