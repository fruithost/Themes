<?php
    use fruithost\Accounting\Auth;
    use fruithost\Templating\TemplateFiles;

    $this->getFiles()->addStylesheet('global', $this->url('css/global.css'), '1.0.0', [ 'bootstrap' ]);
    $this->getFiles()->addJavascript('global', $this->url('js/global.js'), '1.0.0', [ 'bootstrap' ], TemplateFiles::FOOTER);
    $this->getFiles()->addJavascript('ajax', $this->url('js/ajax.js'), '1.0.0', [ 'bootstrap' ], TemplateFiles::FOOTER);
    $this->getFiles()->addStylesheet('style', $this->url('theme/powerpanel/css/style.css'), '1.0.0', [ 'bootstrap' ]);
    $this->getFiles()->addStylesheet('dark', $this->url('theme/powerpanel/css/dark.css'), '1.0.0', [ 'style' ]);
    $this->getFiles()->addStylesheet('modules', $this->url('theme/powerpanel/css/modules.css'), '1.0.0', [ 'style' ]);
    $this->getFiles()->addJavascript('ui', $this->url('theme/powerpanel/js/ui.js'), '2.0.0', [ 'bootstrap' ], TemplateFiles::FOOTER);
    $this->getFiles()->addJavascript('codemirror', $this->url('js/codemirror/build/bundle.min.js'), '6.0.0', [ 'ui' ], TemplateFiles::FOOTER);
?>