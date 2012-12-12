<?php
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class LoginController extends AppController {
    
    /**
    * Displays the default view for the login page
    *
    * @param void
    * @return void
    */
    public function index() {
        $this->layout = 'login';
        $this->set('title', 'GSP Partner App || Person');
    }
    
}
?>
