<?php
require_once 'app/config/common.php';
/**
 * 
 */
use axion\data;
use axion\gui; 


$request = new data\Request();

/* $request is an object with the following structure:
 * 
 * $request = 
 * 	object(axion\data\Request)#1 (4) {
 *	  ["verb"] => string(3) "GET"
 *	  ["elements"] =>
 *	 	  array(2) {
 *	 	    [0]=> string(0) ""
 *	 	    [1]=> string(6) "signin"
 *	 	  }
 * 	  ["parameters"]=>
 *	    array(0) {
 *	   }
 * 	  ["format"]=> string(4) "html"
 * }
 *
 * 
 * 
 */

// WH Format will either be JSON or HTML
if($request->format == 'json'){
	// WH Right now we don't do anything with JSON requests, but eventually we 
	// will return data based on the request

} else {
	// WH Assume $request->format is HTML. We could alter this to display an error message if the 
	// format isn't HTML
    switch($request->elements[1]) {
        case 'signin':
        	// WH Test if the user is loggedin
            if (isset($_SESSION['user_id'])) {
        		// WH User is logged in, force redirect to the overview page.
                $view = new gui\View($settings, 'overview');
                $view->render();
            } else {
            	// WH User isn't logged in yet, allow access to signin page.
                $view = new gui\View($settings, 'signin');
                $view->arr_params = $request->elements;
                $view->render(false);
            }
            break;
        case 'createaccount':
            if (isset($_SESSION['user_id'])) {
                $view = new gui\View($settings, 'overview');
                $view->render();
            } else {
                $view = new gui\View($settings, 'createaccount');
                $view->arr_params = $request->elements;
                $view->render(false);
            }
            break;
        case 'accountrecovery':
            if (isset($_SESSION['user_id'])) {
                $view = new gui\View($settings, 'overview');
                $view->render();
            } else {
                $view = new gui\View($settings, 'accountrecovery');
                $view->arr_params = $request->elements;
                $view->render(false);
            }
            break;
        case 'verify':
            if (isset($_SESSION['user_id'])) {
                $view = new gui\View($settings, 'overview');
                $view->render();
            } else {
                $view = new gui\View($settings, 'verify');
                $view->arr_params = $request->elements;
                $view->render(false);
            }
            break;
        default:
    		// WH We can administratively reset passwords. If we have done that, the we want to 
    		// force the user to access the resetpass page until they've reset their password.
            if (isset($_SESSION['flg_temp_pass']) && $_SESSION['flg_temp_pass'] == 1) {
                $view = new gui\View($settings, 'resetpass');
                $view->render(false);
            } else {
            	// WH General test to make sure that the page the user is trying to access exists 
                if (file_exists('app/view/' . $request->elements[2] . '.php')) {
                	// WH page existed, load page.
                    $view = new gui\View($settings, $request->elements[2]);
                    $view->arr_params = $request->elements;
                    $view->render();
                } else {
            		// WH Page does not exist. 
            		// WH Load home page for now. 
                    $view = new gui\View($settings, 'home');
                    $view->arr_params = $request->elements;
                    $view->render();
                }
            }
            break;
    }
}

?>