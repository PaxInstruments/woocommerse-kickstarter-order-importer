<?php



/**
* 
*/
class process_kick_data
{
    
    function __construct()
    {
        
    }

    public function FunctionName($value='')
    {
        global $wpdb;
              ## add customer test
        // get_user_by('email', bobsmith); false if user is not found
        // $newcustomer = wc_create_new_customer('bob.smith1223@mailinator.com', 'bobsmith', wp_generate_password());
        // if(is_wp_error($newcustomer)){
        //     $error_string = $newcustomer->get_error_message();
        //     echo '<div id="message" class="error"><p>' . $error_string . '</p></div>';
        // } else {
        //     print "created new customer:<pre>";
        //     print_r( $newcustomer );
        // }

        ## 11, add shipping address test
        // $shipping = array ( "shipping_first_name",
        //     "shipping_last_name",
        //     "shipping_company",
        //     "shipping_address_1",
        //     "shipping_address_2",
        //     "shipping_city",
        //     "shipping_state",
        //     "shipping_postcode",
        //     "shipping_country");


        //     //update_user_meta( $user_id, $meta_key, $meta_value, $prev_value );
        // foreach ($shipping as $key) {
        //     if($key=='shipping_country') update_user_meta( 11, $key, 'US' );
        //     update_user_meta( 11, $key, $key );
        // }

        //add_user_meta( '11', '_imported_from_kickstarter', true);

        ## create order for user
       //  $order_args = array(
       //          'status'        => 'processing',
       //          'customer_id'   => 11,
       //          'created_via'   => 'kickstart_importer'
       //      );
       // $order = wc_create_order($order_args);
       // print '<pre>'; print_r($order);
       //1488
        
        # get existing kickstarter order
        // $query = new WP_Query( 'post_type=shop_order');
        // $order_id = $wpdb->get_var( $wpdb->prepare( "
        //     SELECT id FROM `{$wpdb->prefix}posts` WHERE post_type = 'shop_order' and `id` in (
        //     SELECT a.post_id from {$wpdb->prefix}postmeta as a INNER JOIN {$wpdb->prefix}postmeta as b on a.post_id = b.post_id  WHERE
        //     a.meta_key = '_created_via' and
        //     a.meta_value = 'kickstart_importer' and
        //     b.meta_key = '_customer_user' and
        //     b.meta_value = '%d'
        //     )" , '11') );
        // if($order_id){
        //     // has kick order already
        //     // if order is in processing state, set to hold
        //     // if item is not on order, add item(s)
        //     // set order back to processing
        //     print "have order $order_id";
        // } else {
        //     print "go ahead and create order<br>";

        // }
        

        // collect success and errors into result set and display
        // provide an export of remaining data?
        // 

    }

    // public function get_woocommerce_fields()
    // {
    //     return array ( "shipping_first_name",
    //         "shipping_last_name",
    //         "shipping_company",
    //         "shipping_address_1",
    //         "shipping_address_2",
    //         "shipping_city",
    //         "shipping_state",
    //         "shipping_postcode",
    //         "shipping_country");
    // }

    public function csv_header($csvfile) {
        if (!file_exists($csvfile)) {
            return array();
        }
        $f = fopen($csvfile, 'r');

        $line = fgetcsv($f);
        fclose($f);
        return $line;
    }

    public function csv_to_array($csvfile) {
        if (!file_exists($csvfile)) {
            return array();
        }
        $f = fopen($csvfile, 'r');

        $csv_data = array();

        $first_row_is_header = true;
        $header_keys = array();

        while ($line = fgetcsv($f)) {
            #array_push($csv_data, $line);
            if ($first_row_is_header) {
                $header_keys = $line;
                $first_row_is_header = false;
                continue;
            }
            $row = array();
            #print = '<>';
            #print_r($header_keys);
            #print_r($line);
            #exit;
            for ($i = 0; $i < count($line); $i++) {
                if (!isset($header_keys[$i]) or !isset($line[$i])) {
                    continue;
                }

                $row[$header_keys[$i]] = $line[$i];
            }
            array_push($csv_data, $row);

        }
        fclose($f);
        #print_r($csv_data);
        return $csv_data;
    }
    function html_show_array($table) {
        echo "<table border='1'>";
        
        echo "<tr>";
        foreach (array_keys($table[0]) as $key) {
            echo "<td>" . $key . "</td>";
        }
        echo "</tr>";
        
        foreach ($table as $rows => $row) {
            echo "<tr>";
            foreach ($row as $col => $cell) {
                echo "<td>" . $cell . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
}