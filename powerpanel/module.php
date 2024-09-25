<?php
    /**
     * fruithost | OpenSource Hosting
     *
     * @author Adrian Preuß
     * @version 1.0.0
     * @license MIT
     */

    use fruithost\UI\Icon;
    use fruithost\UI\Button;
    use fruithost\Localization\I18N;

	$template->header();
    ?>
        </div>
    </div>
</div>
<!-- Subnavigation -->
<div class="submenu">
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="nav nav-tabs">
                   <li class="nav-item"><a class="nav-link active" href="<?php print $this->url('/module/' . $module->getDirectory()); ?>"><?php I18N::__('Module'); ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container h-100 mt-2">
    <div class="row h-100">
        <div class="col h-100">
    <?php
	if(method_exists($module->getInstance(), 'frame') && !empty($module->getInstance()->frame())) {
		?>
			<iframe src="<?php print $module->getInstance()->frame(); ?>"></iframe>
		<?php
	} else {
        ?>
	    <form method="post" action="<?php print $this->url(true); ?>">
            <?php
                if(isset($error)) {
                    ?>
                        <div class="alert alert-danger mt-4" role="alert"><?php (is_array($error) ? var_dump($error) : print $error) ?></div>
                    <?php
                } else if(isset($success)) {
                    ?>
                        <div class="alert alert-success mt-4" role="alert"><?php print $success; ?></div>
                    <?php
                }

                $module->getInstance()->content($submodule);
            ?>
		</form>
		<?php
	}
	
	$template->footer();
?>