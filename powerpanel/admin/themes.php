<?php
    /**
     * fruithost | OpenSource Hosting
     *
     * @author Adrian Preuß
     * @version 1.0.0
     * @license MIT
     */

    use fruithost\Accounting\Auth;
    use fruithost\Localization\I18N;

    $template->header();

	if(!Auth::hasPermission('THEMES::VIEW')) {
		?>
			<div class="alert alert-danger mt-4" role="alert">
				<strong><?php I18N::__('Access denied!'); ?></strong>
				<p class="pb-0 mb-0"><?php I18N::__('You have no permissions for this page.'); ?></p>
			</div>
		<?php
		$template->footer();
		exit();
	}
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
                        <a class="nav-link<?php print (empty($tab) ? ' active' : ''); ?>" id="globals-tab" href="<?php print $this->url('/admin/themes'); ?>" role="tab">
                            <?php
                                I18N::__('Installed Themes');
                            ?>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <form method="post" action="<?php print $this->url('/admin/themes' . (!empty($tab) ? '/' . $tab : '')); ?>">
                    <?php
                        if(isset($error)) {
                            ?>
                                <div class="alert alert-danger mt-4" role="alert"><?php print $error; ?></div>
                            <?php
                        } else if(isset($success)) {
                            ?>
                                <div class="alert alert-success mt-4" role="alert"><?php print $success; ?></div>
                            <?php
                        }
                    ?>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane show active" id="globals" role="tabpanel" aria-labelledby="globals-tab">
                            <?php
                                switch($tab) {
                                    default:
                                        $template->display('admin/themes/empty');
                                    break;
                                }
                            ?>
                        </div>
                    </div>
                </form>
<?php
	$template->footer();
?>