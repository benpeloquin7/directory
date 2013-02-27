<?php
/**
 * Authorization controller.
 *
 * This file will render views from view/Auth/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

class PeopleController extends AppController {

    public $name = 'People';
        
    public $components = array('Cookie', 'Session');
    
    private $preset_user_information = array('first_name' => '', 'last_name' => '', 'email' => '');

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('Person');
        
    function beforeFilter() {
        parent::beforeFilter();
        
        // if we have a cookie but we don't have a session
        if($this->Cookie->check('GSPUser')) {
            
            $user_cookie = $this->Cookie->read('GSPUser');
            if(isset($user_cookie['email'])) {
                $this->preset_user_information['email'] = $user_cookie['email'];
                // TODO decide if I should get rid of the cookie here, might be nice to show up and have it load every time
//                $this->Cookie->destroy();
                $this->Session->destroy();
            }
            
        }
        
    }

    /**
     * Displays a view with an email challenge
     * @return void
     */
    public function challenge() {
        $this->set('preset_user_information', $this->preset_user_information);
    }
       
    /**
     * Checks the submitted email against all legit emails in the mgspsf db
     * @return boolean True for allowed, False for not allowed
     */
    public function verify() {
        
        $this->autoRender = false;
        $this->layout = 'ajax';
        
        $this->response->type('json');
        $url = Router::url(array('controller' => 'people', 'action' => 'challenge'));
        $response = array('response' => false, 'redirect' => $url, 'message' => 'Sorry but we couldn\'t find you in our records. Please check your email and try again. If the problem persists, please contact your network administrator.');
        
        // request must be post
        if($this->request->is('post')) {
            
            $email = $this->request->data('Person.email');
            
            // email must not be empty
            if(!empty($email)) {
                
                // email must be lowercase
                $email = strtolower($email);
                
                // email must validate as an email
                if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $options = array('conditions' => array('Person.email' => $email));
                    $allowed = $this->Person->find('first', $options);
                    
                    // we have email in the gsp system
                    if($allowed) {
                        $this->Session->write('User.email', $email);
                        $url = Router::url(array('controller' => 'users', 'action' => 'initiate'));
                        $response = array('response' => true, 'redirect' => $url, 'message' => 'User authenticated.');
                    }
                }
            }
        }
        
        $this->response->body(json_encode($response));
        $this->response->send();
        $this->_stop();
        
    }
    
    public function search() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->response->type('json');
        
        $url = Router::url(array('controller' => 'users', 'action' => 'main'));
        $response = array('response' => false, 'redirect' => $url, 'message' => 'Sorry, no results found.');
        
        // request must be post
        if($this->request->is('post')) {
            
            $phrase = $this->request->data('Person.phrase');
            
            if(!empty($phrase)) {
                
                // we know its not empty - now determine the type
                $type_arr = determine_type($phrase);
                
                // set the catchall for the results
//                $results;
//                
//                // we know the type, now sanitize according to type
//                switch($term) {
//                    case 'phone':
//                        // below is an example of a search for phone in two fields
//                        $cleaned_term = sanitize_phone($term);
//                        
//                        $fields = array('ext', 'mobile');
//                        
//                        $results = $this->search_fields($fields, $cleaned_term);
//                        
//                        break;
//                    case 'email':
//                        $cleaned_term = filter_var($term, FILTER_SANITIZE_EMAIL);
//                        
//                        $fields = array('email');
//                        
//                        $results = $this->search_fields($fields, $cleaned_term);
//                        
//                        break;
//                    case 'multi-term':
//                        $cleaned_term = filter_var($term, FILTER_SANITIZE_STRING);
//                        
//                        $fields = array();
//                        
//                        $results = $this->search_fields($fields, $cleaned_term);
//                        
//                        
//                        break;
//                    case 'single-term':
//                        $cleaned_term = filter_var($term, FILTER_SANITIZE_STRING);
//                        
//                        $fields = array();
//                        
//                        $results = $this->search_fields($fields, $cleaned_term);
//                        
//                        break;
//                    case 'username':
//                        $cleaned_term = filter_var($term, FILTER_SANITIZE_STRING);
//                        
//                        $fields = array('userName');
//                        
//                        $results = $this->search_fields($fields, $cleaned_term);
//                        
//                        break;
//                    case 'seat':
//                        $cleaned_term = filter_var($term, FILTER_SANITIZE_NUMBER_INT);
//                        
//                        $fields = array('seat');
//                        
//                        $results = $this->search_fields($fields, $cleaned_term);
//                        
//                        break;
//                }
                
                // pass the value to the search algo
                
                // TODO write the actual database search algo below
//                $options = array('conditions' => array('Person.email' => $email));
//                $allowed = $this->Person->find('first', $options);
                
            }
            
        }
        
        $this->response->body(json_encode($response));
        $this->response->send();
        $this->_stop();
    }
    
    /**
     *  Recognizes the search term pattern and returns the 'type'
     * 
     *  Acceptible return values are:
     *  'phone'
     *  'email'
     *  'multi-term'
     *  'single-term'
     *  'username'
     *  'seat'
     * 
     *  @param string $term The keyword search term a user entered
     *  @return string Type of search term the user entered
     */
    private function determine_type($phrase) {
        
        $term_arr = explode(' ', $phrase);
        $output = array();
        $types = array();

        foreach($term_arr as $term) {

            $phone_pattern = '#(([+]?[\(]?[0-9]{3}[\)]?)?.?([0-9]{3}.?[0-9]{4}))#';
            preg_match($phone_pattern, $term, $phone_matches);

            $seat_pattern = '#^[a-zA-Z0-9]?[-]?[0-9]{2,3}[a-zA-Z]?[^a-zA-Z0-9]?#';
            preg_match($seat_pattern, $term, $seat_matches);

            $username_pattern = '#^[a-zA-Z]+_[a-zA-Z]+$#';
            preg_match($username_pattern, $term, $username_matches);

            $word_patter = '#^[a-zA-Z]+$#';
            preg_match($word_patter, $term, $word_matches);

            if($phone_matches) {
                $no_symbols_phone = preg_replace('#[^0-9]#i', '', $phone_matches[0]);
                $no_symbols_phone = strval($no_symbols_phone);
                if(strlen($no_symbols_phone) > 7) {
                    $formatted_phone = ''.substr($no_symbols_phone, 0, 3) . '-' . substr($no_symbols_phone, 3, 3) . '-' . substr($no_symbols_phone, 6, 4);
                } else {
                    $formatted_phone = ''.substr($no_symbols_phone, 0, 3) . '-' . substr($no_symbols_phone, 3, 4);
                }
                $output['phone'][] = $formatted_phone;
                $types[] = 'phone';
            } else if($seat_matches) {
                $output['seat'] = $seat_matches;
                $types[] = 'seat';
            } else if($username_matches) {
                $output['username'] = $username_matches;
                $types[] = 'username';
            } else if (filter_var($term, FILTER_VALIDATE_EMAIL)) {
                $output['email'][] =  $term;
                $types[] = 'email';
            } else if($word_matches) {
                $output['word'][] = $term;
                $types[] = 'word';
            } else {
                $output[][] = $term;
                $types[] = 'mixed';
            }

        }

        $output['types'] = $types;

        return $output;
        
    }
    
    private function format_phone_query($formatted_phone_number) {
        return '(ext LIKE \'%'.$formatted_phone_number.'%\') OR (mobile LIKE \'%'.$formatted_phone_number.'%\')';
    }
    
    private function format_seat_query($seat) {
        return '(seat LIKE \'%'.$seat.'%\')';
    }
    
    private function format_username_query($username) {
        return '(userName LIKE \'%'.$username.'%\')';
    }
    
    private function format_email_query($email) {
        return '(email LIKE \'%'.$email.'%\')';
    }
    
    private function format_word_query($word) {
        $output = '(firstName LIKE \'%'.$word.'%\') OR';
        $output .= '(lastName LIKE \'%'.$word.'%\') OR';
        $output .= '(title LIKE \'%'.$word.'%\') OR';
        $output .= '(dept LIKE \'%'.$word.'%\') OR';
        $output .= '(email LIKE \'%'.$word.'%\') OR';
        $output .= '(seat LIKE \'%'.$word.'%\')';
        
        return $output;
    }
    
    /**
     *  Executes a search based on the fields passed to this function
     * 
     *  @param array $fields The fields to search
     *  @param string $term The search term
     *  @return array Resulting array of search results
     */
    private function search_fields($fields, $term) {
        $results = array();
        
        foreach($fields as $field) {
            // below is an example search (I would need to run this on all relevant fields)
            $results[] = $this->Person->query('SELECT * FROM people WHERE '.$field.' LIKE \'%'.$term.'%\' LIMIT 0, 1000');
            // SELECT * FROM people WHERE (firstName LIKE '%mike%') OR (lastName LIKE '%byrd%') LIMIT 0, 1000
        }
        
        return $results;
    }
    
}
