# webbanhang
PORT: 8088  
## Pattern: MVVM (Model - View - ViewModel)

### 1. Hướng dẫn tạo page
#### 1.1. Tạo page theo mẫu nằm trong đường dẫn `vms/Example.php`  
```php
<?php
namespace vms;

class Example {
    public function __construct($param = null) {}
    public function render() {
?>

This is view-model

<?php }}
```

#### 1.2. Đăng ký route trong đường dẫn `route/Router.php` ở hàm `__construct()`  
```php
$this->get(
    '/', // Đường dẫn đến page
    "Home" // Tên class render page nằm trong thư mục vms
    // "\\components\\ClassName" // Nếu nằm trong thư mục vms/components
);
```

#### 1.3. Xử lí `params`  
Khởi tạo view-model class có tham số `params` được truyền vào mặc định (bắt buộc phải có) chứa một mảng các string gồm các tham số mà người dùng gửi đến khi đi vào url trang web.  
VD:
- Đăng ký route ở đường dẫn `/account/{id}`
- Người dùng vào đường dẫn `/account/2`
- `params` nhận được `["2"]`

#### 1.4. Import class, include php file trong view-model  
- Import class sử dụng `use namespace\ClassName`
- Include file sử dụng như bình thường

#### 1.5. Global variables  
Do mỗi lần request đều phải đi qua file `index.php` để xử lí nên chúng ta có thể define global variable ở đây để sử dụng cho tất cả các file khác.

#### 1.6. Sử dụng lại template từ page cha  
Chúng ta có thể tạo một view-model cha làm template và một view-model khác extends từ đó ra để đổ dữ liệu vào.  
VD:  
```php
<?php
// Template.php
namespace vms;

class Template {
    // Khai báo child và hàm render child view-model
    private $child;
    public function renderChild($child) {
        $this->child = $child;
        $this->render();
    }

    public function __construct($params = null) {}

    public function render() {
?>

Start template<br>

<?php $this->child->__render(); ?>

<br>End template

<?php }}
```
```php
<?php
// Child.php
namespace vms;
use vms\Template;

class Child {
    public function __construct($params = null) {}

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
        $template = new Template();
        $template->renderChild($this);
    }

    // Đổi lại tên __render nếu dùng template cha
    public function __render() {
?>

Child content

<?php }}
```
Kết quả
```
Start template
Child content
End template
```

#### 1.7. Tài nguyên static như favicon, images, js,... dùng cho front-end để trong thư mục `assets` nhằm quản lí tốt hơn  
#### 1.8. Thư mục gốc của project nằm ở root của host  
#### 1.9. Cách lấy query string  
Do thay đổi trong cấu trúc bắt request ở file .htaccess nên việc lấy query string sẽ dùng code bên dưới (Đã thêm vào thư viện `libs\Mysqllib`):
```php
// Map queries to object
$queries = array();
parse_str(parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY), $queries);
$queries = (object) $queries;

// Get query "q"
$q = "";
if(property_exists($queries, "q")) {
    $q = $queries->q;
}
```