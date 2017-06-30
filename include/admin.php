<div>
<h2>Edit add's Options</h2>

<form method="post">
<?php
            	    $widget_data = $_POST[RSSFEED];

		  if ($widget_data['count'] & $widget_data['url']) {
			$options['count'] = (int) $widget_data['count'];
			$options['url'] = esc_url_raw($widget_data['url'], 'http');
		 
			update_option(RSSFEED, $options);
		  }
?>

<table width="510">
<tr valign="top">
<th width="92" scope="row">Enter count</th>
<td width="406">
<input name="<?php echo RSSFEED; ?>[count]" type="number" id="count"
value="<?php echo get_option(RSSFEED)['count']; ?>" />
(ex. 5)</td>
</tr>

<tr valign="top">
<th width="92" scope="row">add url</th>
<td width="406">
<input name="<?php echo RSSFEED; ?>[url]" type="url" id="url"
value="<?php echo get_option(RSSFEED)['url']; ?>" />
(ex. http://darbo.lt/darbo)</td>
</tr>
</table>


<p>
<input type="submit" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>