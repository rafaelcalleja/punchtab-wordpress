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
        <td width="144" height="16" align="right"></td>
        <td width="366"><p style="margin-top:3px;font-size:10px;">Signup at <a href="http://www.punchtab.com" target="_blank">PunchTab</a>, if you don't already have a key.</p></td>
    </tr>
    <tr>
        <td width="144" height="26" align="right">Display:</td>
        <td width="366">
            <label>Tab<input name="<?php echo $this->plugin_id; ?>[display]" type="radio" value="tab" <?php if ($options['display'] == 'tab') echo 'checked="checked"'; ?> /></label>
            <label>Sidebar Widget<input name="<?php echo $this->plugin_id; ?>[display]" type="radio" value="inline" <?php if ($options['display'] == 'inline') echo 'checked="checked"'; ?> /></label>
        </td>
    </tr>
    <tr id="<?php echo $this->plugin_id; ?>[xpos]">
        <td width="144" height="26" align="right"><label for="<?php echo $this->plugin_id; ?>[xpos]">X Pos (left | right)</label> </td>
        <td width="366"><input name="<?php echo $this->plugin_id; ?>[xpos]" type="text" value="<?php echo $options['xpos']; ?>" size="40" /></td>
    </tr>
    <tr id="<?php echo $this->plugin_id; ?>[ypos]">
        <td width="144" height="26" align="right"><label for="<?php echo $this->plugin_id; ?>[ypos]">Y Pos (top | bottom)</label> </td>
        <td width="366"><input name="<?php echo $this->plugin_id; ?>[ypos]" type="text" value="<?php echo $options['ypos']; ?>" size="40" /></td>
    </tr>
    <tr>
        <td width="144" height="26" align="right">Earning map</td>
        <td width="366"><input type="checkbox" name="<?php echo $this->plugin_id; ?>[earningmap]" <?php if ($options['earningmap'] == 'on') echo 'checked="checked"'; ?> /></td>
    </tr>
    <tr>
        <td width="144" height="26" align="right"> </td>
        <td width="366"><input type="submit" name="submit" value="Save Options" class="button-primary" /></td>
    </tr>
    </table>
    </form>
</div>

<script type="text/javascript">
function show_sidebar() {
    document.getElementById('<?php echo $this->plugin_id; ?>[ypos]').style.display = 'none';
    document.getElementById('<?php echo $this->plugin_id; ?>[xpos]').style.display = 'none';
}
function show_tab() {
    document.getElementById('<?php echo $this->plugin_id; ?>[ypos]').style.display = 'table-row';
    document.getElementById('<?php echo $this->plugin_id; ?>[xpos]').style.display = 'table-row';
}

document.ready = function() {
    <?php
    if ($_GET['settings-updated'] && $options['display'] == 'inline') {
    ?>
    if (document.getElementById('setting-error-settings_updated')) {
        document.getElementById('setting-error-settings_updated').innerHTML = '<p><strong>Settings saved</strong>. Drag the PunchTab Widget from the <em>Available Widgets</em> section to a <em>Widget Area</em> on the <a href="widgets.php">Widgets</a> settings page.';
    }
    <?php } ?>
            
        
    var radios = document.getElementsByName('<?php echo $this->plugin_id; ?>[display]');
    if (radios[0].checked == true) show_tab();
    else show_sidebar();

    radios[0].onclick = function() {
        show_tab();
    };
    radios[1].onclick = function() {
        show_sidebar();
    };
}
</script>



