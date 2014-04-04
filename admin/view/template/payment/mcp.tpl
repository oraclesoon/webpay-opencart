<?php
echo $header;
require_once ('config.php');
?>
<div id="content">
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="https://webpaytest.mcpayment.net/WebPay/post/img/6.jpg" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><span class="required">*</span> <?php echo $entry_profile_id; ?></td>
            <?php if (empty ($mcp_profile_id)) {
            ?>
            <td><input type="text" name="mcp_profile_id" value="" />
              <span class="error"><?php echo $error_merchantid; ?></span>
            <?php
            } else {
            ?>
            <td><input type="text" name="mcp_profile_id" value="<?php echo $mcp_profile_id; ?>" />
            <?php
            }
            ?>
            </td>
          </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $entry_profile_key; ?></td>
            <?php if (empty ($mcp_profile_key)) {
            ?>
            <td><input type="text" name="mcp_profile_key" value="" />
              <span class="error"><?php echo $error_merchantkey; ?></span>
            <?php
            } else {
            ?>
            <td><input type="text" name="mcp_profile_key" value="<?php echo $mcp_profile_key ;?>" />
              <?php
            }
            ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_geo_zone; ?></td>
            <td><select name="mcp_geo_zone_id">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $mcp_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="mcp_status">
                <?php if ($mcp_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="mcp_sort_order" value="<?php echo $mcp_sort_order; ?>" size="1" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<? if (isset($mcp_profile_id) && isset($mcp_profile_key)) {
  mysql_query("DELETE FROM mcp_data");
  mysql_query("INSERT INTO mcp_data (merchant_id, merchant_key) VALUES ('$mcp_profile_id', '$mcp_profile_key')");
}

?>


<?php echo $footer; ?>