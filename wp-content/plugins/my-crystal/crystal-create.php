<?php

function my_fortunes_create() {
    $id = $_POST["id"];
    $fortunes = $_POST["fortunes"];
    //insert
    if (isset($_POST['insert'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . "crystal_ball";

        $wpdb->insert(
                $table_name, //table
                array('fortunes' => $fortunes), //data
                array('%s') //data format			
        );
        $message.="Inserted Successfully";
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/my-crystal/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add Fortunes</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            
            <table class='wp-list-table widefat fixed' style="width:100%">
               
                <tr>
                    <td><textarea name="fortunes" style="width:100%" required></textarea></td>
                </tr>
            </table>
            <input type='submit' name="insert" value='Save' class='button' style="float:right;margin-top:5px">
        </form>
    </div>
    <?php
}