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
	use fruithost\UI\Icon;

	$template->header();
	if(!Auth::hasPermission('SERVER::SERVICES')) {
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
                   <li class="nav-item active" aria-current="page"><a class="nav-link" href="<?php print $this->url('/server/services'); ?>"><?php I18N::__('Services'); ?></a></li>
                </ul>
            </div>
            <div class="col-2 btn-toolbar justify-content-end">
                <a href="<?php print $this->url('/server/services'.(!empty($tab) ? '/'.$tab : '')); ?>" class="btn btn-sm btn-outline-primary"><?php I18N::__('Refresh'); ?></a>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col">
    <?php
        if(isset($error)) {
            ?>
                <div class="alert alert-danger" role="alert"><?php print $error; ?></div>
            <?php
        } else if(isset($success)) {
            ?>
                <div class="alert alert-success" role="alert"><?php print $success; ?></div>
            <?php
        }
    ?>
    <div class="border rounded overflow-hidden">
        <table class="table table-borderless table-striped table-hover mb-0">
            <thead>
                <tr>
                    <th class="bg-secondary-subtle" scope="col" colspan="2"><?php I18N::__('Service'); ?></th>
                    <th class="bg-secondary-subtle" scope="col"><?php I18N::__('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(empty($services)) {
                        ?>
                        <tr>
                            <td scope="col" colspan="3"><?php I18N::__('No services found.'); ?></td>
                        </tr>
                        <?php
                    } else {
                        foreach($services as $service) {
                            if(empty($service) || empty(trim($service->unit))) {
                                continue;
                            }
                            ?>
                            <tr>
                                <td width="1px">
                                    <span class="d-block badge module-badge text-bg-<?php print ($service->sub === 'running' ? 'success' : 'danger'); ?>" data-bs-toggle="tooltip" title="<?php print ($service->sub == 'running' ? 'Service is running.' : 'Service is stopped.'); ?>"></span>
                                </td>
                                <td>
                                    <?php
                                        print $service->unit;
                                        if(!empty($service->description)) {
                                            printf('<p><small>%s</small></p>', $service->description);
                                        }
                                    ?>
                                </td>
                                <td class="text-end">
                                    <form method="post" action="<?php print $this->url('/server/services'.(!empty($tab) ? '/'.$tab : '')); ?>">
                                        <div class="btn-group mr-2">
                                            <?php
                                                if($service->sub === 'running') {
                                                    ?>
                                                        <button type="submit" name="action" value="restart" class="btn btn-sm btn-outline-warning m-0"><?php Icon::show('restart'); ?></button>
                                                        <button type="submit" name="action" value="stop" class="btn btn-sm btn-outline-danger m-0"><?php Icon::show('stop'); ?></button>
                                                    <?php
                                                } else {
                                                    ?>
                                                        <button type="submit" name="action" value="start" class="btn btn-sm btn-outline-success m-0"><?php Icon::show('start'); ?></button>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                        <button type="submit" name="action" value="status" class="btn btn-sm btn-outline-info"><?php I18N::__('Info'); ?></button>
                                        <input type="hidden" name="service" value="<?php print $service->unit; ?>"/>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                ?>
            </tbody>
		</table>
    </div>
<?php
	$template->footer();
?>