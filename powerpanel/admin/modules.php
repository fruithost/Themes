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
	if(!Auth::hasPermission('MODULES::*')) {
		?>
            <div class="alert alert-danger mt-4" role="alert">
                <strong><?php I18N::__('Access denied!'); ?></strong>
                <p class="pb-0 mb-0"><?php I18N::__('You have no permissions for this page.'); ?></p>
            </div>
		<?php
		$template->footer();
		exit();
	}

	if(Auth::hasPermission('MODULES::HANDLE') && isset($_GET['settings'])) {
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
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php print $this->url('/admin/modules'); ?>"><?php I18N::__('Modules'); ?></a>
                                </li>
                                <li class="nav-item active" aria-current="page">
                                    <a class="nav-link" href="<?php print $this->url('/admin/modules'.(!empty($tab) ? '/'.$tab : '').'?settings='.$_GET['settings']); ?>">
                                        <?php print (empty($module) ? 'Module error' : sprintf('Settings for %s', $module->getInfo()->getName())); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col mt-5">
                        <form method="post" action="<?php print $this->url('/admin/modules'.(!empty($tab) ? '/'.$tab : '').'?settings='.$_GET['settings']); ?>">
                            <?php
                                if(!$modules->hasModule($_GET['settings'])) {
                                    ?>
                                    <div class="alert alert-danger mt-4" role="alert">
                                        <strong><?php I18N::__('Module not found!'); ?></strong>
                                        <p class="pb-0 mb-0"><?php I18N::__('Unknown module name. Please select an valid Module!'); ?></p>
                                    </div>
                                    <?php
                                } else {
                                    if(!$module->hasSettingsPath()) {
                                        ?>
                                        <div class="alert alert-danger mt-4" role="alert">
                                            <strong><?php I18N::__('No Settings available!'); ?></strong>
                                            <p class="pb-0 mb-0"><?php sprintf(I18N::get('The Module %s has no settings!'), $module->getInfo()->getName()); ?></p>
                                        </div>
                                        <?php
                                    } else {
                                        if(isset($error)) {
                                            ?>
                                            <div class="container">
                                                <div class="alert alert-danger mt-4" role="alert"><?php print $error; ?></div>
                                            </div>
                                            <?php
                                        } else if(isset($success)) {
                                            ?>
                                            <div class="container">
                                                <div class="alert alert-success mt-4" role="alert"><?php print $success; ?></div>
                                            </div>
                                            <?php
                                        }
                                        require_once($module->getSettingsPath());
                                    }
                                }
                            ?>
                        </form>
                    <?php
                } else {
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
                                    <?php
                                        if(Auth::hasPermission('MODULES::INSTALL') && $tab == 'install') {
                                            ?>
                                               <li class="nav-item modules-popular"><a class="nav-link active" id="popular-tab" role="tab" data-bs-toggle="tab" data-bs-target="#popular" role="tab"><?php I18N::__('Popular'); ?></a></li>
                                               <li class="nav-item modules-results"><a class="nav-link disabled" aria-disabled="true" role="tab" id="results-tab" role="tab" data-bs-toggle="tab" data-bs-target="#results" aria-disabled="true"><?php I18N::__('Results'); ?></a></li>
                                               <li class="nav-item ms-auto">
                                                   <div class="input-group" id="module-search">
                                                       <input name="query" type="text" class="form-control form-control-sm" placeholder="<?php I18N::__('Search terms...'); ?>" aria-label="<?php I18N::__('Search'); ?>" aria-describedby="basic-addon1">
                                                       <button class="btn btn-sm btn-outline-success" type="button" id="button-addon2"><?php I18N::__('Search'); ?></button>
                                                   </div>
                                               </li>
                                            <?php
                                        } else {
                                            ?>
                                                 <li class="nav-item">
                                                    <a class="nav-link<?php print (empty($tab) ? ' active' : ''); ?>" id="globals-tab" href="<?php print $this->url('/admin/modules'); ?>" role="tab">
                                                        <?php
                                                            I18N::__('Installed Modules');
                                                            $updates = count((array) $upgradeable);

                                                            if($updates > 0) {
                                                                printf('<span class="badge rounded-pill text-bg-warning">%d</span>', $updates);
                                                            }
                                                        ?>
                                                    </a>
                                                </li>
                                                <?php
                                                    if(Auth::hasPermission('MODULES::REPOSITORY')) {
                                                        ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link<?php print (!empty($tab) && $tab === 'repositorys' ? ' active' : ''); ?>" id="security-tab" href="<?php print $this->url('/admin/modules/repositorys'); ?>" role="tab"><?php I18N::__('Repositorys'); ?></a>
                                                        </li>
                                                        <?php
                                                    }

                                                    if(Auth::hasPermission('MODULES::ERRORS')) {
                                                        ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link<?php print (!empty($tab) && $tab === 'errors' ? ' active' : ''); ?>" id="errors-tab" href="<?php print $this->url('/admin/modules/errors'); ?>" role="tab">
                                                                <?php
                                                                    I18N::__('Errors');
                                                                    $error_count = count((array) $errors);

                                                                    if($error_count > 0) {
                                                                        printf('<span class="badge rounded-pill text-bg-warning">%d</span>', $error_count);
                                                                    }
                                                                ?>
                                                            </a>
                                                        </li>
                                                        <?php
                                                    }
                                                ?>
                                            <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="col btn-toolbar justify-content-end">
                                <?php
                                    switch($tab) {
                                        case 'install':
                                            if(!Auth::hasPermission('MODULES::INSTALL')) {
                                                ?>
                                                    <a href="<?php print $this->url('/admin/modules'); ?>" class="btn btn-sm btn-outline-secondary mx-2"><?php I18N::__('Back'); ?></a>
                                                    <a href="<?php print $this->url('/admin/modules/install'); ?>" class="btn btn-sm btn-outline-primary mx-2"><?php I18N::__('Refresh'); ?></a>
                                                <?php
                                            }
                                        break;
                                        case 'repositorys':
                                            if(Auth::hasPermission('MODULES::REPOSITORYS')) {
                                                ?>
                                                    <div class="btn-group mr-2">
                                                        <button type="button" name="add_repository" data-bs-toggle="modal" data-bs-target="#add_repository" class="btn btn-sm btn-outline-primary"><?php I18N::__('Add new'); ?></button>
                                                        <button type="submit" name="action" value="update" class="btn btn-sm btn-outline-success"><?php I18N::__('Update'); ?></button>
                                                        <button type="submit" name="action" value="delete" class="btn btn-sm btn-outline-danger"><?php I18N::__('Delete'); ?></button>
                                                    </div>
                                                <?php
                                            }
                                        break;
                                        default:
                                            if(Auth::hasPermission('MODULES::INSTALL')) {
                                                ?>
                                                    <a href="<?php print $this->url('/admin/modules/install'); ?>" class="btn btn-sm btn-outline-primary mx-2"><?php I18N::__('Install'); ?></a>
                                                    <div class="btn-group mr-2">
                                                        <button type="submit" name="action" value="upgrade" class="btn btn-sm btn-outline-success"><?php I18N::__('Upgrade'); ?></button>
                                                        <button type="submit" name="action" value="delete" class="btn btn-sm btn-outline-danger"><?php I18N::__('Delete'); ?></button>
                                                    </div>
                                                <?php
                                            }
                                        break;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="<?php print $this->url('/admin/modules'.(!empty($tab) ? '/'.$tab : '')); ?>">
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
                                                case 'install':
                                                    if(Auth::hasPermission('MODULES::INSTALL')) {
                                                        $template->display('admin/modules/install');
                                                    }
                                                break;
                                                case 'repositorys':
                                                    if(Auth::hasPermission('MODULES::REPOSITORY')) {
                                                        if(count($repositorys) === 0) {
                                                            $template->display('admin/modules/repository/empty');
                                                        } else {
                                                            $template->display('admin/modules/repository/list');
                                                        }
                                                    }
                                                break;
                                                case 'errors':
                                                    if(Auth::hasPermission('MODULES::ERRORS')) {
                                                        if(count($errors) === 0) {
                                                            $template->display('admin/modules/errors/empty');
                                                        } else {
                                                            $template->display('admin/modules/errors/list');
                                                        }
                                                    }
                                                break;
                                                default:
                                                    if(count($modules->getList()) === 0) {
                                                        $template->display('admin/modules/empty');
                                                    } else {
                                                        $template->display('admin/modules/list');
                                                    }
                                                break;
                                            }
                                        ?>
                                    </div>
                                </div>
                            </form>
<script type="text/javascript">
    (() => {
        window.addEventListener('DOMContentLoaded', () => {
            [].map.call(document.querySelectorAll('button[name="action"].delete'), function (element) {
                element.addEventListener('click', function (event) {
                    event.target.parentNode.parentNode.querySelector('input[type="checkbox"][name="repository[]"]').checked = true;
                });
            });

            [].map.call(document.querySelectorAll('button[name="action"].update'), function (element) {
                element.addEventListener('click', function (event) {
                    event.target.parentNode.parentNode.querySelector('input[type="checkbox"][name="repository[]"]').checked = true;
                });
            });
        });
    })();
</script>
<?php
	}
	$template->footer();
?>