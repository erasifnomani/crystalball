<?php
error_reporting(0);
function my_fortunes_list() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/my-crystal/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Fortunes List</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=my_fortunes_create'); ?>">Add New </a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "crystal_ball";

        $rows = $wpdb->get_results("SELECT id,fortunes from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts' style="width:100%">
            <tr>
                <th class="manage-column ss-list-width">ID</th>
                <th class="manage-column ss-list-width">Fortunes</th>
                <th>Action</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->id; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->fortunes; ?></td>
                    <td>
						<a href="<?php echo admin_url('admin.php?page=my_fortunes_update&id=' . $row->id); ?>">Update</a>
						&nbsp;&nbsp; | &nbsp;&nbsp;
						<a href="<?php echo admin_url('admin.php?page=my_fortunes_list&id=' . $row->id); ?>" onclick="return confirm('Are You sure')">Delete</a>
					</td>
                </tr>
            <?php } ?>
        </table>
		<?php 
			if(isset($_REQUEST['id'])){
				$id = $_REQUEST['id'];
				$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = $id"));
				echo "<script>window.location='admin.php?page=my_fortunes_list'</script>";
			}
		?>
    </div>
    <?php
}