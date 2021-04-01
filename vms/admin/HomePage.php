<?php
namespace vms\admin;
use vms\templates\ContainerAdminTemplate;

class HomePage {

    public function __construct($param = null) {
    }

    // Khai báo template và truyền bản thân vào template cha
    public function render() {
        $template = new ContainerAdminTemplate();
        $template->renderChild($this);
    }

    public function __render() {
        
    ?>
        <h2>Other Admins</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody id="admin_list">
                <tr>
                <td>1,001</td>
                <td>Lorem</td>
                <td>ipsum</td>
                <td>dolor</td>
                <td>sit</td>
                </tr>
            </tbody>
            </table>
        </div>
        </main>
    </div>

    <!-- <script type="text/javascript" src="/assets/js/admin/admin.js"></script> -->

<?php }}