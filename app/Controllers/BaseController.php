<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];
	protected $session;

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);
        $this->session=session();
		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
	}
	/**
	 * render a view in a layout
	 * @param String $view
	 * @param Array $param
	 * @param String $layout
	 * @return string
	 */
	public function renderWithLayout($view,$param,$layout=null) {
	    //get config file
	    $config=config('Config\app');
	    //default layout
	    if (!$layout) $layout=$config->layout;
	    //add description of site
	    $dataLayout=array(
	        'title'=>'',
	        'description'=>lang('app.DESCRIPTION'),
	        'script'=>array(),
	        'style'=>array(),
	        'login'=>'false'
	    );
	    //get title param
	    if (array_key_exists('title',$param)) $dataLayout['title']=$param['title'];
	    else $dataLayout['title']=$config->title;
	    // get javascript
	    helper('html');
	    if (isset($config->script)) {
	        $script=array();
	        foreach ($config->script as $key=>$val) {
	            $script[$key]=array('src'=>$val);
	        }
	        $dataLayout['script']=array_merge($dataLayout['script'],$script);
	    }
	    if (array_key_exists('script', $param)) {
	        $script=array();
	        foreach ($param['script'] as $key=>$val) {
	            $script[$key]=array('src'=>$val);
	        }
	        $dataLayout['script']=array_merge($dataLayout['script'],$script);
	    }
	        
	        
	        
	    // get style
	    if (isset($config->style)) {
	        $style=array();
	        foreach ($config->style as $key=>$value) {
	            $style[$key]=array('src'=>$value);
	        }
	        $dataLayout['style']=array_merge($dataLayout['style'],$style);
	    }
	        
	    if (array_key_exists('style', $param)) {
	        $style=array();
	        foreach ($param['style'] as $key=>$value) {
	            $style[$key]=array('src'=>$value);
	        }
	        $dataLayout['style']=array_merge($dataLayout['style'],$style);
	    }
	        //d($dataLayout);
	    //@todo add other thing
	    
	    //get session
	    if ($this->session->get('id')) $dataLayout['login']='true';
	    $parser = \Config\Services::parser();
	    $dataLayout['baseURL']=base_url();
	    $dataLayout['content']= $parser->setData($param)->render($view,$param);
	    return $parser->setData($dataLayout)->render($layout,$dataLayout);
	}

}
