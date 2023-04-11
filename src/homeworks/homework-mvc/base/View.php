<?php

namespace Base;

class View
{
    private $templatePath;
    private $data;
    private $twig;

    public function __construct()
    {
    }

    public function setTemplatePath(string $path)
    {
        $this->templatePath = $path;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function render(string $tpl, $data = []): string
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }
        ob_start();
        include $this->templatePath . '/' . $tpl;
        $data = ob_get_clean();
        return $data;
    }

    public function renderTwig(string $tpl, $data = [])
    {
        if (!$this->twig) {
            $loader = new \Twig\Loader\FilesystemLoader($this->templatePath);
            $this->twig = new \Twig\Environment($loader);
        }

        return $this->twig->render($tpl, $data);
    }

}

//class View
//{
//    private $templatePath = '';
//    private $data = [];
//
//    public function __construct()
//    {
//        $this->templatePath = PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . 'app/View';
//    }
//
//    public function assign(string $name, $value)
//    {
//        $this->data[$name] = $value;
//    }
//
//    public function render(string $tpl, $data = []): string
//    {
//        $this->data += $data;
//        ob_start();
//        include $this->templatePath . DIRECTORY_SEPARATOR . $tpl;
//        return ob_get_clean();
//    }
//
//    public function __get($varName)
//    {
//        return $this->data[$varName] ?? null;
//    }
//}