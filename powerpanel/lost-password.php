<?php
    /**
     * fruithost | OpenSource Hosting
     *
     * @author Adrian Preuß
     * @version 1.0.0
     * @license MIT
     */

    use fruithost\Localization\I18N;
    use fruithost\UI\Icon;

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
					<li class="nav-item"><a class="nav-link" href="<?php print $this->url('/login'); ?>"><?php I18N::__('Login'); ?></a></li>
					<li class="nav-item"><a class="nav-link active" href="<?php print $this->url('/lost-password'); ?>"><?php I18N::__('Lost Password'); ?></a></li>
				</ul>
			</div>
			<div class="col-2 btn-toolbar justify-content-end">
				<button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
					<?php Icon::show('language'); ?>
					<?php I18N::__('Language'); ?>
					<span class="visually-hidden">Toggle Dropdown</span>
				</button>
				<ul class="dropdown-menu dropdown-scroll">
					<?php
						foreach(I18N::getLanguages() as $code => $language) {
							printf('<li><a class="dropdown-item" href="%s">%s</a></li>', $template->url('/login', [
								'lang'	=> $code
							]), $language);
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col form-signin">
			<form method="post" action="<?php print $template->url(true); ?>">
				<h1 class="h3 mb-3 fw-normal"><?php I18N::__('Reset your Password'); ?></h1>
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
					
				if(!isset($success)) {
					?>
						<div class="card">
							<div class="card-header">
								<?php I18N::__('Reset Password'); ?>
							</div>
							<div class="card-body">
								<?php
									if(isset($changeable) && $changeable) {
										?>
											<div class="mb-3 row">
												<label for="password_new" class="col-sm-2 col-form-label"><?php I18N::__('New Password'); ?></label>
												<div class="col-sm-10">
													<input type="password" class="form-control" id="password_new" name="password_new" placeholder="<?php I18N::__('New Password'); ?>" required autofocus />
												</div>
											</div>
											<div class="mb-3 row">
												<label for="password_repeated" class="col-sm-2 col-form-label"><?php I18N::__('Password Confirmation'); ?></label>
												<div class="col-sm-10">
													<input type="password" class="form-control" id="password_repeated" name="password_repeated" placeholder="<?php I18N::__('Password Confirmation'); ?>" required />
												</div>
											</div>
										<?php
									} else {
										?>
											<div class="mb-3 row">
												<label for="email" class="col-sm-2 col-form-label"><?php I18N::__('E-Mail Address'); ?></label>
												<div class="col-sm-10">
													<input type="email" class="form-control" id="email" name="email" placeholder="<?php I18N::__('E-Mail Address'); ?>" required autofocus />
												</div>
											</div>
										<?php
									}
								?>
								<div class="mb-3 row">
									<div class="col-sm-2"></div>
									<div class="col-sm-10 text-end">
										<button class="btn btn-primary" name="action" value="lost-password" type="submit">
											<?php I18N::__('Reset Password'); ?>
										</button>
									</div>
								</div>
							</div>
						</div>
					<?php
				}
			?>
		</form>
	<?php
	$template->footer();
?>