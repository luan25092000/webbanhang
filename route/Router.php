<?php
namespace route;

use auth\Middleware;

class Router {
    private $__routes;

    public function __construct() {
        $this->__routes = [];

        // Routes
        $this->get('/', "HomePage");
        $this->get('/search', "SearchPage");
        $this->get('/product-detail/{id}',"ProductDetailPage");
        $this->get('/introduce',"IntroducePage");
        $this->get('/field',"FieldPage");
        $this->get('/check-order',"CheckOrderPage");
        $this->get('/contact',"ContactPage");
        $this->get('/new',"NewPage");
        $this->get('/new-detail',"NewDetailPage");
        $this->get('/new-market',"NewMarketPage");
        $this->get('/new-promotion',"NewPromotionPage");
        $this->get('/female-product',"FemaleProductPage");
        $this->get('/male-product',"MaleProductPage");
        $this->get('/product',"ProductPage");
        $this->get('/register',"RegisterPage");
        $this->post('/register',"RegisterPage");
        $this->get('/login',"LoginPage");
        $this->post('/login',"LoginPage");
        $this->get('/test',"TestPage");
        $this->get('/verify/{token}',"VerifyEmailPage");
        $this->get('/account',"TestPage");

        // change admin router
        $this->get('/admin/home',"HomePage");
        $this->get('/admin/products',"ProductPage");
        $this->post('/admin/products',"ProductPage");
        $this->get('/admin/products/{id}',"ProductDetailPage");

        $this->get('/admin/categories',"CategoryPage");
        $this->post('/admin/categories',"CategoryPage");
        $this->get('/admin/categories/{id}',"CategoryDetailPage");

        $this->get('/admin/promotions',"PromotionPage");
        $this->post('/admin/promotions',"PromotionPage");
        $this->get('/admin/promotions/{id}',"PromotionDetailPage");


        $this->get('/admin/orders',"OrderPage");
        $this->get('/admin/customers',"CustomerPage");

    }
    
    public function get(string $url, $action) {
        // Xử lý phương thức GET
        $this->__request($url, 'GET', $action);
    }

    public function post(string $url, $action) {
         // Xử lý phương thức POST
         $this->__request($url, 'POST', $action);
    }

    /**
     * 
     * Xử lý phương thức
     * 
     * @param string $url URL cần so khớp
     * @param string $method method của route. GET hoặc POST
     * @param string|callable $action Hành động khi URL được gọi. Có thể là một callback hoặc một method trong controller
     * 
     * @return void
     * 
     */
    private function __request(string $url, string $method, $action) {

        // Kiem tra xem URL co chua param khong. VD: post/{id}
        if (preg_match_all('/({([a-zA-Z]+)})/', $url, $params)) {
            $url = preg_replace('/({([a-zA-Z]+)})/', '(.+)', $url);
        }

        // Thay the tat ca cac ki tu / bang ky tu \/ (regex) trong URL.
        $url = str_replace('/', '\/', $url);

        $route = [
            'url' => $url,
            'method' => $method,
            'action' => $action,
            'params' => $params[2]
        ];

        array_push($this->__routes, $route);
    }

    /**
     * 
     * Hàm xử lý khi một URL được gọi
     * 
     * @param string $url URL được gọi đến server
     * @param string $method Phương thức url được gọi. GET | POST
     * 
     * @return void
     * 
     */
    public function map(string $url, string $method) {

        // Lặp qua các route, kiểm tra có chứa url được gọi không
        foreach ($this->__routes as $route) {
            
            // Nếu route có $method
            if ($route['method'] == $method) {
                
                // Kiểm tra route hiện tại có phải là url đang được gọi.
                $reg = '/^'.$route['url'].'$/';
                
                if (preg_match($reg, $url, $params)) {

                    if ($url === "/admin" || $url === "/account" || explode("/",$url)[1] === "admin" ) {

                        $router = Middleware::check_router($url);
                        
                        if ($router->status && $router->message[0]["username"] === "p") {
                            
                            array_shift($params); // Loại bỏ rác trong params
                            $this->__call_admin_route($route['action'], $params); // Call action
                            return;
                            
                        }elseif ($router->status && $url === "/account") {

                            echo $router->message[0]["username"];
                            return true;

                        }
                        else{

                            $this->__call_action_route("NotFoundPage", []);
                            return;

                        }
                    }

                    // Nếu match thì sẽ chạy code bên dưới
                    array_shift($params); // Loại bỏ rác trong params
                    $this->__call_action_route($route['action'], $params); // Call action
                    return;
                }
            }
        }

        // Nếu không khớp với bất kì route nào cả.
        $this->__call_action_route("NotFoundPage", []);
        return;
    }

    /**
     * 
     * Hàm gọi action route
     * 
     * @param string|callable $action action của route
     * @param array $params Các tham số trên url
     * 
     * @return void
     * 
     */
    private function __call_action_route($action, $params) {

        // Nếu action là một view-model
        if(is_string($action)) {
            $vm_name = 'vms\\'.$action;
            $vm = new $vm_name($params);
            $vm->render();
            // Free variable after using
            $vm = null;
        }
    }

    private function __call_admin_route($action, $params) {

        // Nếu action là một view-model
        if(is_string($action)) {
            $vm_name = 'vms\\admin\\'.$action;
            $vm = new $vm_name($params);
            $vm->render();
            // Free variable after using
            $vm = null;
        }
    }
}
?>