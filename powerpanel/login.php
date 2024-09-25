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
					<li class="nav-item"><a class="nav-link active" href="<?php print $this->url('/login'); ?>"><?php I18N::__('Login'); ?></a></li>
					<li class="nav-item"><a class="nav-link" href="<?php print $this->url('/lost-password'); ?>"><?php I18N::__('Lost Password'); ?></a></li>
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
				<h1 class="h3 mb-3 fw-normal"><?php I18N::__('Please sign in'); ?></h1>
				<?php
					if(isset($error)) {
						?>
							<div class="alert alert-danger" role="alert"><?php print $error; ?></div>
						<?php
					}
				?>
				<div class="card">
					<div class="card-header">
						<?php I18N::__('Login'); ?>
					</div>
					<div class="card-body">
						<?php
							if(isset($two_factor) && $two_factor) {
								?>
									<div class="mb-3 row">
										<p><?php I18N::__('Please enter your 2FA code:'); ?></p>
									</div>
									<div class="mb-3 row">
										<label for="code" class="col-sm-2 col-form-label"><?php I18N::__('Code'); ?></label>
										<div class="col-sm-10">
											<input type="code" class="form-control" id="code" name="code" placeholder="<?php I18N::__('Code'); ?>" autocomplete="off" required autofocus/>
										</div>
									</div>
								<?php
							} else if(isset($two_factor_unknown) && $two_factor_unknown) {

							} else {
								?>
									<div class="mb-3 row">
										<label for="username" class="col-sm-2 col-form-label"><?php I18N::__('Username'); ?></label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="username" name="username" placeholder="<?php I18N::__('Username'); ?>" value="<?php print (isset($username) ? $username : ''); ?>" required autofocus/>
										</div>
									</div>
									<div class="mb-3 row">
										<label for="password" class="col-sm-2 col-form-label"><?php I18N::__('Password'); ?></label>
										<div class="col-sm-10">
											<input type="password" class="form-control" id="password" name="password" placeholder="<?php I18N::__('Password'); ?>" required/>
										</div>
									</div>
								<?php
							}
						?>
						<div class="mb-3 row">
							<div class="col-sm-2"></div>
							<div class="col-sm-10 text-end">
								<?php
									if(isset($two_factor_unknown) && $two_factor_unknown) {
										?>
											<button class="btn btn-primary" name="action" value="back" type="submit"><?php I18N::__('Back'); ?></button>
										<?php
									} else {
										?>
											<button class="btn btn-primary" name="action" value="login" type="submit"><?php I18N::__('Sign in'); ?></button>
										<?php
									}
								?>
							</div>
						</div>
					</div>
				</form>
<?php
	$template->footer();
?>