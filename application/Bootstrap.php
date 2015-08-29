<?php

class Bootstrap extends Yaf_Bootstrap_Abstract{

    // Init config
    public function _initConfig() {
        $config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set('config', $config);
    }

    // Load libaray, MySQL model, function
    public function _initCore() {
	define('APP_TITLE', '你好-未知！');
        define('TB_PREFIX',    'zt_');
        define('APP_NAME'   ,  'ASK');
        define('LIB_PATH',     APP_PATH.'/application/library');
        define('MODEL_PATH',   APP_PATH.'/application/model');
        define('FUNC_PATH',    APP_PATH.'/application/function');
        define('ADMIN_PATH',   APP_PATH.'/application/modules/Admin');
	define('VIEW_PATH',   APP_PATH.'/application/views');
        // CSS, JS, IMG PATH
        define('CSS_PATH', '/statics/css');
        define('JS_PATH',  '/statics/js');
        define('IMG_PATH',  '/statics/img');

        // Admin CSS, JS PATH
        define('ADMIN_CSS_PATH', '/admin/css');
        define('ADMIN_JS_PATH',  '/admin/js');

        Yaf_Loader::import('M_Model.pdo.php');
        Yaf_Loader::import('Helper.class.php');

        Helper::import('Basic');
        Helper::import('Network');
        
        Yaf_Loader::import('C_Basic.php');
        Yaf_Loader::import(LIB_PATH.'/yar/Yar_Basic.php');

        Yaf_Loader::import("L_Page.class.php");
        
        // header.html and left.html
        define('HEADER_HTML', VIEW_PATH.'/common/header.html');
        define('FOOTER_HTML',   VIEW_PATH.'/common/footer.html');

        // API KEY for api sign
        define('API_KEY', 'THIS_is_OUR_API_keY');
    }

    // 这里我们添加三种路由，分别为 rewrite, rewrite_category, regex
    // 用于 url rewrite 的讲解
    public function _initRoute() {
        $router = Yaf_Dispatcher::getInstance()->getRouter();

        // rewrite
        $route = new Yaf_Route_Rewrite(
            '/article/detail/:articleID',
            array(
                'controller' => 'article',
                'action'     => 'detail',
            )
        );

        $router->addRoute('rewrite', $route);

        // rewrite_category
        $route = new Yaf_Route_Rewrite(
            '/article/detail/:categoryID/:articleID',
            array(
                'controller' => 'article',
                'action'     => 'detail',
            )
        );

        $router->addRoute('rewrite_category', $route);

        // regex
        $route = new Yaf_Route_Regex(
            '#article/([0-9]+).html#',
            array('controller' => 'article', 'action' => 'detail'),
            array(1 => 'articleID')
        );

        $router->addRoute('regex', $route);
    }

    public function _initPlugin(Yaf_Dispatcher $dispatcher) {
        $router = new RouterPlugin();
        $dispatcher->registerPlugin($router);

        $admin = new AdminPlugin();
        $dispatcher->registerPlugin($admin);
        Yaf_Registry::set('adminPlugin', $admin);
    }

}
