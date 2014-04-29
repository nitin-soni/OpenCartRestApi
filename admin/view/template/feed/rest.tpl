<?php echo $header; ?>
<div id="content">
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>
    <?php if (isset($error_warning)) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>
    <div class="box">
        <div class="heading">
            <h1>&nbsp;&nbsp;<?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
        <div class="content">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                <table class="form">
                    <tr>
                        <td><?php echo $entry_status; ?></td>
                        <td>
                            <select name="api_status">
                                <?php if ($api_status) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="api_user"><span class="required">*</span><?php echo $entry_user; ?></label>
                        </td>
                        <td>
                            <input type="text" name="api_user" value="<?php echo $api_user; ?>" maxlength="16"/>
                            <?php if (isset($error_api_user)) { ?>
                            <span class="error"><?php echo $error_api_user; ?></span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="api_key"><span class="required">*</span><?php echo $entry_key; ?></label>
                        </td>
                        <td>
                            <input type="text" name="api_key" value="<?php echo $api_key; ?>" maxlength="16"/>
                            <?php if (isset($error_api_key)) { ?>
                            <span class="error"><?php echo $error_api_key; ?></span>
                            <?php } ?>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php echo $footer; ?>