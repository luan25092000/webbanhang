<?php
namespace route;

class APIV1Router {
    private $__routes;
    public function __construct() {
        $this->__routes = [];

        // Handlers
        $this->add_route("/cart", "CartController");
        $this->add_route("/cart/{action}", "CartController");
        $this->add_route("/account/{id}", "AccountController");
    }

    public function add_route(string $url, $action) {
        // Kiem tra xem URL co chua param khong. VD: post/{id}
        if (preg_match_all('/({([a-zA-Z]+)})/', $url, $params)) {
            $url = preg_replace('/({([a-zA-Z]+)})/', '(.+)', $url);
        }

        // Thay the tat ca cac ki tu / bang ky tu \/ (regex) trong URL.
        $url = str_replace('/', '\/', $url);

        $route = [
            'url' => $url,
            'action' => $action,
            'params' => $params[2]
        ];

        array_push($this->__routes, $route);
    }

    public function map(string $url, string $method) {
        // Lặp qua các route, kiểm tra có chứa url được gọi không
        foreach ($this->__routes as $route) {
            // Kiểm tra route hiện tại có phải là url đang được gọi.
            $reg = '/^' . $route['url'] . '$/';

            if (preg_match($reg, $url, $params)) {
                // Nếu match thì sẽ chạy code bên dưới
                array_shift($params); // Loại bỏ rác trong params
                $this->__call_action_route($route['action'], $method, $params); // Call action
                return;
            }
        }

        // Nếu không khớp với bất kì route nào cả.
        $this->__call_action_route("NotFoundController", $method, []);
        return;
    }

    private function __call_action_route($action, $method, $params) {
        $handler_path = 'api\\v1\\controllers\\' . $action;
        $handler = new $handler_path();
        $handler->render($method, $params);
        $handler = null;
    }
}