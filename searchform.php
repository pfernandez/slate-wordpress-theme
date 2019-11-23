<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div class="searchform">
        <input type="text" onfocus="if (this.value == '<?php _e('Search this site...','okay'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search this site...','okay'); ?>';}" value="<?php _e('Search this site...','okay'); ?>" name="s" id="s" />
        <input type="submit" id="searchsubmit" value="Search" />
    </div>
</form>