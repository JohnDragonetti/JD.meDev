<?php
namespace axion\gui;
/**
 * Basic page rendering system
 *
 * Class View
 * @package axion\gui
 */
class View {
    /**
     * @var string
     */
    public $title;
    /**
     * @var array
     */
    public $arr_css;
    /**
     * @var array
     */
    public $arr_js;
    /**
     * @var
     */
    public $arr_params;
    /**
     * @var
     */
    private $filename;
    /**
     * @var string
     */
    private $page;
    /**
     * @var string
     */
    public $sub_dir;
    public $settings;
    /**
     * Initializes the class and sets up various class variables
     *
     * @param $settings
     * @param $filename
     */
    function __construct($settings, $filename){
        $this->filename = $filename;
//        $this->base_url = $settings['baseurl'];
        $this->sub_dir  = SUB_DIR;
        $this->base_url = BASE_URL;
        $this->settings = $settings;
        foreach($settings['js'] as $js){
            $this->arr_js[] = $js;
        }
    }
    /**
     * Invokes build_body(), build_head() and returns a string containing the completed HTML of the requested page.
     *
     *
     * @param bool $show_control Determines if we show the top navigation element
     */
    public function render($show_control=true){
        // WH These appear to be backwards, but take a closer look at how build_head() works
        $this->build_body($show_control)->build_head();
        echo $this->page;
    }
    /**
     * Completes the string for the page we're displaying. This comes after build_body() so that we can easily set
     * $this->title from within the view. When the capability to dynamically add css is built, we'll also have the
     * capability of adding in css before the head tag ends.
     *
     * @return $this
     */
    private function build_head(){
        $this->page = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>'.$this->title.'</title>
    <!-- Bootstrap -->
    <!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300italic,300,700,600,800" rel="stylesheet" type="text/css">-->
    <link href="'.$this->sub_dir.'lib/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,800,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="'.$this->sub_dir.'/css/main.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>'.$this->page;
        return $this;
    }
    /**
     * Includes a php file to use as the body of the page we're viewing
     *
     * Creates an output buffer, includes a php file from the view folder, invokes $this->build_nav() and inserts the
     * resulting navigation element into the page. If the $show_control param is sent and is true, we also build the
     * control bar and add it into the page. Finally we build any js files and complete the string for the body of
     * the page.
     *
     *
     * @param $show_control
     * @return $this
     */
    private function build_body($show_control){
        ob_start();
        //include $this->base_url.'/view/'.$this->filename;
        //include '/view/'.$this->filename.'.php';
        include 'app/view/'.$this->filename.'.php';
        $string = ob_get_clean();
        $nav = $this->build_nav();
        $found = str_replace('[[NAV]]', $nav, $string);
        //var_dump($found);
        //$this->page .= $string;
        if($show_control){
            $this->page .= $this->build_navigation();
        }
        $this->page .= $found;
        $this->page .= $this->build_js();
        $this->page .= '</body></html>';
        return $this;
    }
    /**
     * Builds out javascript <script> tags based on the contents of the $this->arr_js variable.
     *
     * @return string
     */
    private function build_js(){
        $js = '';
        if(is_array($this->arr_js)){
            for($i=0;$i<count($this->arr_js); $i++){
                $js .= '<script type="text/javascript" src="'.$this->base_url.$this->arr_js[$i].'"></script>';
            }
        }
        return $js;
    }
    /**
     * Generates an unordered list that displays the top level pages for the site.
     *
     * TODO: Pull available pages from a configuration file or database.
     * @return string
     */
    private function build_nav(){
        //WH These links will come from the database depending on the services the client has with us
        //$links = array('Overview','Hosting','Reports', 'SimPro Connect', 'More');
        //$links = array('Overview', 'Web App Development', 'Website Design', 'Search Engine Optimization', 'Domain Name Services', 'Hosting', 'Dream Service');
        //$links = array('Overview','Account Settings', 'Payments and Orders', 'Invoices');

        $links = $this->settings['main_nav'];
//        $str .= '<div class="nav-title">Admin links</div>';
        $str = '';
        $str .= '<ul class="nav nav-sidebar">';
        for($i=0; $i<count($links); $i++) {
            $text = $links[$i];
            $link = str_replace(' ', '-', strtolower($links[$i]));
            $active = $this->filename === $link ? 'class="active"' : '';
            $str .= '<li '.$active.'><a href="'.$this->base_url.$link.'/">'.$text.'</a></li>';
        }
        $str .= '</ul>';
        return $str;
    }
    /**
     * Builds a bootstrap navbar.
     *
     * @return string
     */
    private function build_navigation(){
        return '';
    }
    /**
     * @param $settings
     * @param $nav_links        $nav_links = array('overview'=>'Overview', 'activation'=>'simPro Activation', 'processed'=>'Processed Leads');
     * @param $url_params
     * @return string
     */
    private function build_secondary_nav($settings, $nav_links, $url_params, $anchor_mode=false){
        $str_nav = '<ul class="nav" role="tablist">';
        if(is_array($nav_links) && !empty($nav_links)){
            if($anchor_mode){
                $count = 0;
                foreach($nav_links as $link=>$text){
                    $active_addin = ($count == 0) ? 'class="active"' : '';
                    $str_nav .= '<li '.$active_addin.'><a href="#'.$link.'">'.$text.'</a></li>';
//                    $str_nav .= '<li '.$active_addin.'><a href="'.$settings['baseurl'].$url_params[1].'#'.$link.'">'.$text.'</a></li>';
                    $count++;
                }
            } else {
                foreach($nav_links as $link=>$text){
                    $active_addin = ($url_params[2] == $link) ? 'class="active"' : '';
                    $str_nav .= '<li '.$active_addin.'><a href="'.$settings['baseurl'].$url_params[1].'/'.$link.'/">'.$text.'</a></li>';
                }
            }
        } else {
            $str_nav .= '<li style="display: block;padding: 10px 15px;">'.$nav_links.'</li>';
        }
        $str_nav .= '</ul>';
        return $str_nav;
    }
} 

?>