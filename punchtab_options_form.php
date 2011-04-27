<?php
// LAYOUT FOR THE SETTINGS/OPTIONS PAGE
?>

<div class="wrap">
    <?php screen_icon(); ?>
	<form action="options.php" method="post" id=<?php echo $this->plugin_id; ?>"_options_form" name=<?php echo $this->plugin_id; ?>"_options_form">
	<?php settings_fields($this->plugin_id.'_options'); ?>
    <h2>PunchTab &raquo; Options</h2>
    <table width="550" border="0" cellpadding="5" cellspacing="5">
    <tr>
        <td width="144" height="26" align="right"><label for="<?php echo $this->plugin_id; ?>[key]">Key</label> </td>
        <td width="366"><input name="<?php echo $this->plugin_id; ?>[key]" type="text" value="<?php echo $options['key']; ?>" size="40" /></td>
    </tr>
    <tr>
        <td width="144" height="26" align="right"><label for="<?php echo $this->plugin_id; ?>[xpos]">X Pos (left | right)</label> </td>
        <td width="366"><input name="<?php echo $this->plugin_id; ?>[xpos]" type="text" value="<?php echo $options['xpos']; ?>" size="40" /></td>
    </tr>
    <tr>
        <td width="144" height="26" align="right"><label for="<?php echo $this->plugin_id; ?>[ypos]">Y Pos (top | bottom)</label> </td>
        <td width="366"><input name="<?php echo $this->plugin_id; ?>[ypos]" type="text" value="<?php echo $options['ypos']; ?>" size="40" /></td>
    </tr>
    <tr>
        <td width="144" height="26" align="right"> </td>
        <td width="366"><input type="submit" name="submit" value="Save Options" class="button-primary" /></td>
    </tr>
    </table>
    </form>
</div>
