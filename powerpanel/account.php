<?php
    /**
     * fruithost | OpenSource Hosting
     *
     * @author Adrian Preuß
     * @version 1.0.0
     * @license MIT
     */

    use fruithost\Localization\I18N;
    use fruithost\Accounting\Auth;

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
                       <li class="nav-item"><a class="nav-link<?php print (empty($tab) ? ' active' : ''); ?>" id="details-tab" href="<?php print $this->url('/account'); ?>" role="tab"><?php I18N::__('Account Details'); ?></a></li>
                       <li class="nav-item"><a class="nav-link<?php print (!empty($tab) && $tab === 'password' ? ' active' : ''); ?>" id="password-tab" href="<?php print $this->url('/account/password'); ?>" role="tab"><?php I18N::__('Change Password'); ?></a></li>
                    </ul>
                </div>
                <div class="col-2 btn-toolbar justify-content-end">
                    <!-- @ToDo <JS> find form & submit
                        <button type="submit" name="action" value="save" class="btn btn-sm btn-outline-primary"><?php I18N::__('Save'); ?></button> -->
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
	            <form method="post" action="<?php print $this->url('/account' . (!empty($tab) ? '/' . $tab : '')); ?>">
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
                        <div class="tab-pane<?php print (empty($tab) ? ' show active' : ''); ?>" id="details" role="tabpanel" aria-labelledby="details-tab">
                            <p class="text-secondary p-4"><?php I18N::__('Current personal details that you have provided us with, We ask that you keep these upto date in case we require to contact you regarding your hosting package.'); ?></p>

                            <div class="container">
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label"><?php I18N::__('E-Mail Address'); ?>:</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" value="<?php print Auth::getMail(); ?>" placeholder="your.email@example.com" />
                                    </div>
                                </div>
                                <hr class="mb-4" />
                                <div class="form-group row">
                                    <label for="name_first" class="col-sm-2 col-form-label"><?php I18N::__('Full Name'); ?>:</label>
                                    <div class="col-sm-10 container">
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" class="form-control" id="name_first" name="name_first" value="<?php print (!empty($data) && !empty($data->name_first) ? $data->name_first : ''); ?>" />
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control" id="name_last" name="name_last" value="<?php print (!empty($data) && !empty($data->name_last) ? $data->name_last : ''); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-2 col-form-label"><?php I18N::__('Phone Number'); ?>:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php print (!empty($data) && !empty($data->phone_number) ? $data->phone_number : ''); ?>" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 col-form-label"><?php I18N::__('Postal Address'); ?>:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="address" name="address"><?php print (!empty($data) && !empty($data->address) ? $data->address : ''); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group text-end">
                                    <button type="submit" name="action" value="save" class="btn btn-outline-success"><?php I18N::__('Save'); ?></button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane<?php print (!empty($tab) && $tab === 'password' ? ' show active' : ''); ?>" id="password" role="tabpanel" aria-labelledby="password-tab">
                            <p class="text-secondary p-4"><?php I18N::__('Change your current control panel password.'); ?></p>

                            <div class="container">
                                <div class="form-group row">
                                    <label for="password_current" class="col-sm-2 col-form-label"><?php I18N::__('Current Password'); ?>:</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password_current" name="password_current" value="" />
                                    </div>
                                </div>
                                <hr class="mb-4" />
                                <div class="form-group row">
                                    <label for="password_new" class="col-sm-2 col-form-label"><?php I18N::__('New Password'); ?>:</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password_new" name="password_new" value="" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password_repeated" class="col-sm-2 col-form-label"><?php I18N::__('Password Confirmation'); ?>:</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password_repeated" name="password_repeated" value="" />
                                    </div>
                                </div>
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