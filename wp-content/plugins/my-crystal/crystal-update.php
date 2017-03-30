<?php

function my_fortunes_update() {
    global $wpdb;
    $table_name = $wpdb->prefix . "crystal_ball";
    $id = $_GET["id"];
    $fortunes = $_POST["fortunes"];
//update
    if (isset($_POST['update'])) {
        $wpdb->update(
                $table_name, //table
                array('fortunes' => $fortunes), //data
                array('ID' => $id), //where
                array('%s'), //data format
                array('%s') //where format
        );
    }
//delete
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));
    } else {//selecting value to update	
        $fortunes = $wpdb->get_results($wpdb->prepare("SELECT id,fortunes from $table_name where id=%s", $id));
        foreach ($fortunes as $s) {
            $fortunes = $s->fortunes;
        }
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/my-crystal/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Fortunes</h2>

        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>Fortunes deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=my_fortunes_list') ?>">&laquo; Back to fortunes list</a>

        <?php } else if ($_POST['update']) { ?>
            <div class="updated"><p>Fortunes updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=my_fortunes_list') ?>">&laquo; Back to fortunes list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class='wp-list-table widefat fixed' style="width:100%">
                    <tr><th><textarea name="fortunes" style="width:100%" required><?php echo $fortunes; ?></textarea></th></tr>
                </table>
                <input type='submit' name="update" value='Save' class='button' style="float: right;margin-top: 5px;"> &nbsp;&nbsp;
                <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('Are You sure')" style="margin-top: 5px;">
            </form>
        <?php } ?>

    </div>
    <?php
}