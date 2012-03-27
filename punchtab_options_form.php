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
        <td width="144" height="26" align="right" style="padding:0 30px 0 0;vertical-align: top;"><label style="font-weight:600" for="<?php echo $this->plugin_id; ?>[key]">Key:</label> </td>
        <td width="366"><input name="<?php echo $this->plugin_id; ?>[key]" type="text" value="<?php echo $options['key']; ?>" size="40" /></td>
    </tr>
    <tr>
        <td width="144" height="16" align="right"></td>
        <td width="366" style="border-bottom: 1px solid #CCC;padding:0 0 10px 0;"><p style="margin-top:3px;font-size:10px;">Signup at <a href="http://www.punchtab.com/?src=wp" target="_blank">PunchTab</a>, if you don't already have a key.</p></td>
    </tr>
    <tr>
        <td width="144" height="26" align="right" style="margin-top:20px;padding:0 30px 0 0;vertical-align: top;"><label style="font-weight:600" for="<?php echo $this->plugin_id; ?>[name]">Name:</label> </td>
        <td width="366" style="border-bottom: 1px solid #CCC;padding:0 0 10px 0;"><input name="<?php echo $this->plugin_id; ?>[name]" type="text" value="<?php if (isset($options['name'])) echo $options['name']; ?>" size="40" /></td>
    </tr>
    <tr>
        <td width="144" height="26" align="right" style="margin-top:20px;padding:0 30px 0 0;vertical-align: top;"><label style="font-weight:600" for="<?php echo $this->plugin_id; ?>[enable_rewards]">Enable rewards:</label> </td>
        <td width="366"><input type="hidden" name="<?php echo $this->plugin_id; ?>[enable_rewards]" value="0" /><input name="<?php echo $this->plugin_id; ?>[enable_rewards]" type="checkbox" <?php echo ($options['enable_rewards'] || !isset($options['enable_rewards']))?'checked="checked"':''; ?> /></td>
    </tr>
    <tr id="<?php echo $this->plugin_id; ?>_display_tab">
        <td width="144" align="right" style="padding:0 30px 30px 0;vertical-align: top;"><label style="font-weight:600"><div>Display:</div></label></td>
        <td width="366">
            <div style="width:100%;float:left;margin-bottom:20px;">
                <input name="<?php echo $this->plugin_id; ?>[display]" type="radio" value="tab" <?php if (!isset($options['display']) || $options['display'] == 'tab') echo 'checked="checked"'; ?> />
                <label>Red Reward Tab</label>
            </div>
            <img style="float:left; padding: 0 0 30px 20px" width="200px" src="http://static.punchtab.com/img/position_bottom_left_visual_large.png"/>
        </td>
    </tr>
    <tr id="<?php echo $this->plugin_id; ?>[xpos]">
        <td width="144" height="26" align="right"><label for="<?php echo $this->plugin_id; ?>[xpos]">Rewards X Pos</label> </td>
        <td width="366"><select name="<?php echo $this->plugin_id; ?>[xpos]">
            <option value="left" <?php if ($options['xpos'] == 'left') echo 'selected="selected"'; ?>>Left</option>
            <option value="right" <?php if ($options['xpos'] == 'right') echo 'selected="selected"'; ?>>Right</option>
        </select></td>
    </tr>
    <tr id="<?php echo $this->plugin_id; ?>[ypos]">
        <td width="144" height="26" align="right"><label for="<?php echo $this->plugin_id; ?>[ypos]">Rewards Y Pos</label> </td>
        <td width="366" style="border-bottom: 1px solid #CCC;padding:0 0 10px 0;">
        <select name="<?php echo $this->plugin_id; ?>[ypos]">
            <option value="top" <?php if ($options['ypos'] == 'top') echo 'selected="selected"'; ?>>Top</option>
            <option value="bottom" <?php if ($options['ypos'] == 'bottom' || empty($options['ypos'])) echo 'selected="selected"'; ?>>Bottom</option>
        </select>
    </tr>
    <tr id="<?php echo $this->plugin_id; ?>_display_inline">
        <td width="144" height="26" align="right"></td>
        <td width="366" style="border-bottom: 1px solid #CCC;padding:0 0 10px 0;">
            <div style="width:100%;float:left;margin-bottom:20px;">
                <input name="<?php echo $this->plugin_id; ?>[display]" type="radio" value="inline" <?php if (isset($options['display']) && $options['display'] == 'inline') echo 'checked="checked"'; ?> />
                <label>Sidebar Widget</label>
            </div>
            <img style="float:left; margin: 0 0 0 20px" width="200px" src="http://static.punchtab.com/img/sidebar_widget_visual_large.png"/>
        </td>
    </tr>
    <tr id="<?php echo $this->plugin_id; ?>[earningmap]">
        <td width="144" height="26" align="right" style="padding:0 30px 30px 0;vertical-align:top;"><span style="font-weight:600">Earning map:</span></td>
        <td width="366" style="border-bottom: 1px solid #CCC;padding:0 0 10px 0;">
            <div style="width:100%;float:left;margin-bottom:20px;">
                <input type="hidden" name="<?php echo $this->plugin_id; ?>[earningmap]" value="0" /><input type="checkbox" name="<?php echo $this->plugin_id; ?>[earningmap]" value=1 <?php checked( 1 ==  $options['earningmap'] ); ?> />
            </div>
            <img style="float:left; margin: 0 0 0 20px" width="200px" src="http://static.punchtab.com/img/earning_map_visualization_graphic.png"/>
        </td>
    </tr>
    <tr>
        <td width="144" height="26" align="right" style="margin-top:20px;padding:0 30px 0 0;vertical-align: top;"><label style="font-weight:600" for="<?php echo $this->plugin_id; ?>[enable_badges]">Enable badges:</label> </td>
        <td width="366" style="border-bottom: 1px solid #CCC;padding:0 0 10px 0;">
            <div style="width:100%;float:left;margin-bottom:20px;">
                <input type="hidden" name="<?php echo $this->plugin_id; ?>[enable_badges]" value="0" />
                <input name="<?php echo $this->plugin_id; ?>[enable_badges]" type="checkbox" <?php echo (isset($options['enable_badges']) && $options['enable_badges'] == 'on' )?'checked="checked"':''; ?> />
            </div>
                <img style="float:left; margin: 0 0 0 20px" width="200px" src="http://static.punchtab.com/img/wordpress-badges.png"/>
        </td>
    </tr>
    <tr id="<?php echo $this->plugin_id; ?>[badge_xpos]">
        <td width="144" height="26" align="right"><label for="<?php echo $this->plugin_id; ?>[badge_xpos]">Badges X Pos</label> </td>
        <td width="366"><select name="<?php echo $this->plugin_id; ?>[badge_xpos]">
            <option value="left" <?php if ($options['badge_xpos'] == 'left') echo 'selected="selected"'; ?>>Left</option>
            <option value="right" <?php if ($options['badge_xpos'] == 'right') echo 'selected="selected"'; ?>>Right</option>
        </select></td>
    </tr>
    <tr id="<?php echo $this->plugin_id; ?>[badge_ypos]">
        <td width="144" height="26" align="right"><label for="<?php echo $this->plugin_id; ?>[badge_ypos]">Badges Y Pos</label> </td>
        <td width="366" style="border-bottom: 1px solid #CCC;padding:0 0 10px 0;">
        <select name="<?php echo $this->plugin_id; ?>[badge_ypos]">
            <option value="top" <?php if ($options['badge_ypos'] == 'top') echo 'selected="selected"'; ?>>Top</option>
            <option value="bottom" <?php if ($options['badge_ypos'] == 'bottom' || empty($options['badge_ypos'])) echo 'selected="selected"'; ?>>Bottom</option>
        </select>
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
function toggle_rewards(visible) {
    if (visible) {
        document.getElementById('<?php echo $this->plugin_id; ?>_display_tab').style.display = 'table-row';
        document.getElementById('<?php echo $this->plugin_id; ?>_display_inline').style.display = 'table-row';
        document.getElementById('<?php echo $this->plugin_id; ?>[xpos]').style.display = 'table-row';
        document.getElementById('<?php echo $this->plugin_id; ?>[ypos]').style.display = 'table-row';
        document.getElementById('<?php echo $this->plugin_id; ?>[earningmap]').style.display = 'table-row';
    } else {
        document.getElementById('<?php echo $this->plugin_id; ?>_display_tab').style.display = 'none';
        document.getElementById('<?php echo $this->plugin_id; ?>_display_inline').style.display = 'none';
        document.getElementById('<?php echo $this->plugin_id; ?>[xpos]').style.display = 'none';
        document.getElementById('<?php echo $this->plugin_id; ?>[ypos]').style.display = 'none';
        document.getElementById('<?php echo $this->plugin_id; ?>[earningmap]').style.display = 'none';
    }
}

function toggle_badges(visible) {
    if (visible) {
        document.getElementById('<?php echo $this->plugin_id; ?>[badge_xpos]').style.display = 'table-row';
        document.getElementById('<?php echo $this->plugin_id; ?>[badge_ypos]').style.display = 'table-row';
    } else {
        document.getElementById('<?php echo $this->plugin_id; ?>[badge_xpos]').style.display = 'none';
        document.getElementById('<?php echo $this->plugin_id; ?>[badge_ypos]').style.display = 'none';
    }
}

document.ready = function() {
    <?php
    if (isset($_GET['settings-updated']) && $options['display'] == 'inline') {
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

    var reward_program = document.getElementsByName('<?php echo $this->plugin_id; ?>[enable_rewards]');
    if (reward_program[1].checked == true) {
        toggle_rewards(true);
    } else {
        toggle_rewards(false);
    }
    reward_program[1].onclick = function(e){
        if (e.target.checked) {
            toggle_rewards(true);
        } else {
            toggle_rewards(false);
        }
    }

    var badge_program = document.getElementsByName('<?php echo $this->plugin_id; ?>[enable_badges]');
    if (badge_program[1].checked == true) {
        toggle_badges(true);
    } else {
        toggle_badges(false);
    }
    badge_program[1].onclick = function(e){
        if (e.target.checked) {
            toggle_badges(true);
        } else {
            toggle_badges(false);
        }
    }
}
</script>



