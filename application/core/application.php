<?php
class application
{
    private $url_controller = null;
    private $url_action = null;
    private $url_params = array();

    public function __construct()
    {
        if (isset($_REQUEST["url"]) && $_REQUEST["url"] == "login")
            $this->redirect();

        $this->splitUrl();

        if (!$this->url_controller) {

            $initial = !isset($_SESSION["USER"]) ? "login" : "home";
            require APP . 'controller/' . $initial . '.php';
            $page = new $initial();
            $page->index();

        } elseif (file_exists(APP . 'controller/' . $this->url_controller . '.php')) {

            require APP . 'controller/' . $this->url_controller . '.php';
            $this->url_controller = new $this->url_controller();

            if (method_exists($this->url_controller, $this->url_action)) {

                if (!empty($this->url_params)) {

                    call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
                } else {
                    $this->url_controller->{$this->url_action}();
                }

            } else {
                if (strlen($this->url_action) == 0) {

                    $this->url_controller->index();
                } else {
                    header('location: ' . URL . 'problem');
                }
            }
        } else {
            header('location: ' . URL . 'problem');
        }
    }

    private function splitUrl()
    {
        if (isset($_REQUEST['url'])) {

            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->url_controller = isset($url[0]) ? $url[0] : null;
            $this->url_action = isset($url[1]) ? $url[1] : null;
            $this->url_saction = isset($url[2]) ? $url[2] : null;

            unset($url[0], $url[1], $url[2]);
            $this->url_params = array_values($url);

        }
    }

    private function redirect()
    {
        if (!empty($_SESSION)) {
            header("location:".URL);
        }
    }

}
