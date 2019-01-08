<?php global $wp_query;
$arrgs = $wp_query->query_vars; ?>
<div class="searchField">
	<form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url('/'); ?>">
      <fieldset>
          <input value="<?php echo (isset($arrgs['s']) && $arrgs['s']) ? $arrgs['s'] : ''; ?>" name="s" id="s" type="text" class="span12" placeholder="<?php _e('SEARCH', 'ct_theme')?>">
          <span class="submitIcon"></span>
          <input type="submit" value="submit">
      </fieldset>
  </form>
</div>