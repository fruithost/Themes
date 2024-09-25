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
	if(!Auth::hasPermission('SERVER::CONSOLE')) {
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
                           <li class="nav-item"><a class="nav-link active" href="<?php print $this->url('/server/console'); ?>"><?php I18N::__('Console'); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container h-100 mt-2">
            <div class="row h-100">
                <div class="col h-100">
                    <div class="terminal p-0 m-0 h-100">
                        <div class="output"></div>
                        <input name="command" placeholder="<?php I18N::__('Command...'); ?>"/>
                    </div>
                    <input type="hidden" name="destination" value="<?php print $this->url('/server/console'); ?>"/>
<?php
	$template->footer();
?>