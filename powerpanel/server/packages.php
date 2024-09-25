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
	if(!Auth::hasPermission('SERVER::PACKAGES')) {
		?>
            <div class="alert alert-danger mt-4" role="alert">
                <strong><?php I18N::__('Access denied!'); ?></strong>
                <p class="pb-0 mb-0"><?php I18N::__('You have no permissions for this page.'); ?></p>
            </div>
		<?php
		$template->footer();
		exit();
	}

	$result = shell_exec('dpkg-query -W -f=\'${binary:Package};${Version};${binary:Summary};${Maintainer}\n\'');
	$lines  = (empty($result) ? [] : explode(PHP_EOL, $result));
	// @ToDo group by names (for sample php-*)
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
                   <li class="nav-item active" aria-current="page"><a class="nav-link" href="<?php print $this->url('/server/packages'); ?>"><?php I18N::__('Packages'); ?></a></li>
                </ul>
            </div>
            <div class="col-2 btn-toolbar justify-content-end">
                <a href="<?php print $this->url('/server/packages'); ?>" class="btn btn-sm btn-outline-primary"><?php I18N::__('Refresh'); ?></a>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <form method="post" action="<?php print $this->url('/server/packages'.(!empty($tab) ? '/'.$tab : '')); ?>">
                <div class="border rounded overflow-hidden">
                    <table class="table table-borderless table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="bg-secondary-subtle" scope="col"><?php I18N::__('Package'); ?></th>
                                <th class="bg-secondary-subtle" scope="col"><?php I18N::__('Version'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(empty($lines)) {
                                    ?>
                                        <tr>
                                            <td scope="col" colspan="2"><?php I18N::__('No packages found.'); ?></td>
                                        </tr>
                                    <?php
                                }
                                foreach($lines as $line) {
                                    if(empty($line)) {
                                        continue;
                                    }

                                    $info = explode(';', $line);

                                    if(empty(trim($info[0]))) {
                                        continue;
                                    }
                                    ?>
                                    <tr>
                                        <td scope="col">
                                            <?php print $info[0]; ?>
                                            <p><small><?php print ($info[2] ?? ''); ?></small></p>
                                        </td>
                                        <td scope="col" class="text-right"><span class="badge badge-secondary"><?php print ($info[1] ?? ''); ?></span></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </form>
<?php
	$template->footer();
?>