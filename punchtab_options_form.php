<?php
// LAYOUT FOR THE SETTINGS/OPTIONS PAGE
?>

<style>
button {
 background: #8dc63f;
   background: -moz-linear-gradient(top,  #8dc63f 0%, #8dc63f 50%, #7fb239 51%, #7fb239 100%);
   background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#8dc63f), color-stop(50%,#8dc63f), color-stop(51%,#7fb239), color-stop(100%,#7fb239));
   background: -webkit-linear-gradient(top,  #8dc63f 0%,#8dc63f 50%,#7fb239 51%,#7fb239 100%);
   background: -o-linear-gradient(top,  #8dc63f 0%,#8dc63f 50%,#7fb239 51%,#7fb239 100%);
   background: -ms-linear-gradient(top,  #8dc63f 0%,#8dc63f 50%,#7fb239 51%,#7fb239 100%);
   background: linear-gradient(top,  #8dc63f 0%,#8dc63f 50%,#7fb239 51%,#7fb239 100%);
   margin: auto;
   cursor:pointer;
   color: #fff;
   text-shadow: 1px 0px 0 rgba(0,0,0,.4);
   border-radius: 5px;
   border: none;
   font-family: cabin,sans-serif;
   display: block;
   font-weight: bold;
   padding: 5px 15px;
}
</style>
<div id="dialog" title="Get a PunchTab-Powered Loyalty Program" style="display:none;">
	<p>Incentivize readers to visit your site and share it with their social networks by adding a PunchTab Loyalty Program to your Wordpress page.</p>
    <p>Sign up for free account by completing the form below or <a href="http://www.punchtab.com/?src=wp" target="_blank">login to PunchTab</a>.</p>
    <div>
    <form id="punchtab_signup_form" name="punchtab_signup_form">
        <div>
            <label for="domain">Your wordpress site:</label>
            <input type="text" name="domain" id="domain" value="<?php echo site_url(); ?>"/>
            <span id="domain_error" style="color:red;"></span>
        </div>
        <div style="bottom-padding:20px;">
            <label for="email">Your Email address:</label>
            <input type="text" name="email" id="email" />
            <span id="email_error" style="color:red;"></span>
        </div>
        <div style="margin-top:20px;">
            <button type="submit">Sign up</button>
        </div>
    </form>

    </div>
</div>

<div class="wrap">
    <?php screen_icon(); ?>
    <form action="options.php" method="post" id=<?php echo $this->plugin_id; ?>"_options_form" name=<?php echo $this->plugin_id; ?>"_options_form">
    <?php settings_fields($this->plugin_id.'_options'); ?>
    <h2>PunchTab &raquo; Options</h2>
    <table width="550" border="0" cellpadding="5" cellspacing="5">
    <tr>
        <td width="144" height="26" align="right" style="padding:0 30px 0 0;vertical-align: top;"><label style="font-weight:600" for="<?php echo $this->plugin_id; ?>[key]">Key:</label> </td>
        <td id="key-holder" width="366" style="padding:5px;"><input placeholder="Got a PunchTab key? Enter it here." id="punchtab_key" name="<?php echo $this->plugin_id; ?>[key]" type="text" value="<?php echo $options['key']; ?>" size="40" /></td>
    </tr>
    <tr>
        <td width="144" height="16" align="right"></td>
        <td width="366" style="border-bottom: 1px solid #CCC;padding:0 0 10px 0;"><p style="margin-top:3px;font-size:10px;">Need a key? Click <a id="signup">here</a> to sign up or retrieve your key.</p></td>
    </tr>
    <tr>
        <td width="144" height="26" align="right" style="margin-top:20px;padding:0 30px 0 0;vertical-align: top;"><label style="font-weight:600" for="<?php echo $this->plugin_id; ?>[language]">Language:</label> </td>
        <td width="366" style="border-bottom: 1px solid #CCC;padding:0 0 10px 0;">
            <input id="language" name="<?php echo $this->plugin_id; ?>[language]" type="hidden" value="<?php if (isset($options['language'])) echo $options['language']; ?>" size="5" />
            <select name="<?php echo $this->plugin_id; ?>[language]" id="language-list">
            </select>
        </td>
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
        <td width="144" height="26" align="right"><label for="<?php echo $this->plugin_id; ?>[xpos]">Rewards Ribbon Position</label> </td>
        <td width="366"><select name="<?php echo $this->plugin_id; ?>[xpos]">
            <option value="left" <?php if ($options['xpos'] == 'left') echo 'selected="selected"'; ?>>Left</option>
            <option value="right" <?php if ($options['xpos'] == 'right') echo 'selected="selected"'; ?>>Right</option>
        </select></td>
    </tr>
    <tr id="<?php echo $this->plugin_id; ?>[ypos]">
        <td width="144" height="26" align="right"><label for="<?php echo $this->plugin_id; ?>[ypos]"></label> </td>
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
        <td width="144" height="26" align="right"><label for="<?php echo $this->plugin_id; ?>[badge_xpos]">Badges Bar Position</label> </td>
        <td width="366"><select name="<?php echo $this->plugin_id; ?>[badge_xpos]">
            <option value="left" <?php if ($options['badge_xpos'] == 'left') echo 'selected="selected"'; ?>>Left</option>
            <option value="right" <?php if ($options['badge_xpos'] == 'right') echo 'selected="selected"'; ?>>Right</option>
        </select></td>
    </tr>
    <tr id="<?php echo $this->plugin_id; ?>[badge_ypos]">
        <td width="144" height="26" align="right"><label for="<?php echo $this->plugin_id; ?>[badge_ypos]"></label> </td>
        <td width="366" style="border-bottom: 1px solid #CCC;padding:0 0 10px 0;">
        <select name="<?php echo $this->plugin_id; ?>[badge_ypos]">
            <option value="top" <?php if ($options['badge_ypos'] == 'top') echo 'selected="selected"'; ?>>Top</option>
            <option value="bottom" <?php if ($options['badge_ypos'] == 'bottom' || empty($options['badge_ypos'])) echo 'selected="selected"'; ?>>Bottom</option>
        </select>
    </tr>
    <tr>
        <td width="144" height="26" align="right"> </td>
        <td width="366"><input type="submit" name="submit" value="Save Options" class="button-primary" /><div>By installing PunchTab you agree to the <a href="http://www.punchtab.com/customer-agreement">Customer Agreement</a></div></td>
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

function get_languages(){
    var scriptTag = document.createElement('SCRIPT');
    scriptTag.src = "http://www.punchtab.com/api/v1/languages?callback=populate_languages";
    document.getElementsByTagName('HEAD')[0].appendChild(scriptTag);
}

function populate_languages(response){
    var data, i, select, option, original, original_value;
    original = document.getElementById('language');
    original_value = original.value;
    if (!original_value){
        original_value = 'en';
    }
    data = response.data;
    select = document.getElementById('language-list');
    for(i=0; i<data.length;i+=1){
        option = document.createElement('option');
        option.setAttribute('value', data[i][0]);
        option.innerHTML = data[i][1];
        if (data[i][0] == original_value) {
            option.setAttribute('selected', 'selected');
        }
        select.appendChild(option);
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

    get_languages();
}

</script>



