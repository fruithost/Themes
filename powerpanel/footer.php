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
?>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="line">
            <div class="container">
                <div class="row">
                    <div class="col p-5 text-end">
                        <?php
                            // @ToDo Footer-Links in Theme-Settings?

                            printf('Copyright &copy; %1$s by %2$s', date('Y'), $project_name);

                            if($project_copyright) {
                                Icon::show('dot');

                                printf('Powered by <a href="%2$s" target="_blank" class="text-decoration-none" style="color: #c48dbc;">%1$s</a>', 'fruithost', 'https://fruithost.de/');

                                Icon::show('dot');

                                printf('<a href="%2$s" target="_blank" class="icon-link text-decoration-none text-dark-emphasis">%1$s GitHub</a>', Icon::render('github', [
                                    'classes' => [ 'mb-2' ]
                                ]), 'https://github.com/fruithost');

                                if(!Auth::isLoggedIn() && defined('DEMO') && DEMO) {
                                    Icon::show('dot');
                                    printf('<span class="badge text-bg-danger"><small>%s</small></span>', I18N::get('Demoversion'));
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </footer>
        <?php
            $template->foot();
        ?>
	</body>
</html>