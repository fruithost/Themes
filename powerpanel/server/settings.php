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
	if(!Auth::hasPermission('SERVER::SETTINGS')) {
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
                           <li class="nav-item"><a class="nav-link active" href="<?php print $this->url('/server/settings'); ?>"><?php I18N::__('Settings'); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <form method="post" action="<?php print $this->url('/server/settings'.(!empty($tab) ? '/'.$tab : '')); ?>">
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
                        <div class="tab-content">
                            <div class="tab-pane<?php print (empty($tab) ? ' show active' : ''); ?>" id="globals" role="tabpanel" aria-labelledby="globals-tab">
                                <p class="text-secondary p-4"><?php I18N::__('Global settings for the Panel'); ?></p>

                                <div class="container">
                                    <div class="form-group row">
                                        <label for="project_name" class="col-3 col-lg-2 col-form-label"><?php I18N::__('Project name'); ?>:</label>
                                        <div class="col-9 col-lg-10">
                                            <input type="text" class="form-control" id="project_name" name="project_name" value="<?php print $template->getCore()->getSettings('PROJECT_NAME', 'fruithost'); ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="project_copyright" class="col-3 col-lg-2 col-form-label"><?php I18N::__('Show Copyright'); ?>:</label>
                                        <div class="col-9 col-lg-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="project_copyright" value="true" id="project_copyright"<?php print ($template->getCore()->getSettings('PROJECT_COPYRIGHT', true) ? ' CHECKED' : ''); ?>/>
                                                <label class="form-check-label" for="project_copyright">
                                                    <?php I18N::__('Shows the copyright in the footer'); ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mb-4"/>
                                    <div class="form-group row">
                                        <label for="language" class="col-3 col-lg-2 col-form-label"><?php I18N::__('Default Language'); ?>:</label>
                                        <div class="col-9 col-lg-10">
                                            <select name="language" class="form-select">
                                                <?php
                                                    foreach(I18N::getLanguages() as $code => $language) {
                                                        printf('<option value="%1$s"%2$s>%3$s</option>', $code, ($template->getCore()->getSettings('LANGUAGE', 'en_US') === $code ? ' SELECTED' : ''), $language);
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr class="mb-4"/>
                                    <div class="form-group row">
                                        <label for="time_format" class="col-3 col-lg-2 col-form-label"><?php I18N::__('Default Time Format'); ?>:</label>
                                        <div class="col-9 col-lg-10">
                                            <input type="text" class="form-control" id="time_format" name="time_format" value="<?php print $template->getCore()->getSettings('TIME_FORMAT', 'd.m.Y - H:i:s'); ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="time_zone" class="col-3 col-lg-2 col-form-label"><?php I18N::__('Default Timezone'); ?>:</label>
                                        <div class="col-9 col-lg-10">
                                            <select name="time_zone" id="time_zone" class="form-select">
                                                <?php
                                                    foreach(json_decode(file_get_contents(dirname(PATH).'/config/timezones.json'), false) as $category) {
                                                        printf('<optgroup label="%s">', $category->group);

                                                        foreach($category->zones as $zone) {
                                                            printf('<option value="%1$s"%2$s>%3$s</option>', $zone->value, ($template->getCore()->getSettings('TIME_ZONE', date_default_timezone_get()) === $zone->value ? ' SELECTED' : ''), $zone->name);
                                                        }

                                                        print('</optgroup>');
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                        $template->getCore()->getHooks()->runAction('SERVER_SETTINGS');
                                    ?>
                                    <div class="form-group text-end">
                                        <button type="submit" name="action" value="save" class="btn btn-outline-success"><?php I18N::__('Save'); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
<?php
	$template->footer();
?>