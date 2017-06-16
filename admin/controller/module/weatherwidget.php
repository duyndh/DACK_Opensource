<?php
class ControllerModuleWeatherWidget extends Controller {
	// Module Unifier
	private $moduleName = 'WeatherWidget';
	private $moduleNameSmall = 'weatherwidget';
	private $moduleData_module = 'weatherwidget_module';
	private $moduleModel = 'model_module_weatherwidget';
	// Module Unifier

    public function index() { 
		// Module Unifier
		$this->data['moduleName'] = $this->moduleName;
		$this->data['moduleNameSmall'] = $this->moduleNameSmall;
		$this->data['moduleData_module'] = $this->moduleData_module;
		$this->data['moduleModel'] = $this->moduleModel;
		// Module Unifier
	 
        $this->load->language('module/'.$this->data['moduleNameSmall']);
        $this->load->model('module/'.$this->data['moduleNameSmall']);
        $this->load->model('setting/store');
        $this->load->model('localisation/language');
        $this->load->model('design/layout');
		
        $catalogURL = $this->getCatalogURL();
 
        $this->document->addScript($catalogURL . 'admin/view/javascript/ckeditor/ckeditor.js');
        $this->document->addScript($catalogURL . 'admin/view/javascript/'.$this->data['moduleNameSmall'].'/bootstrap/js/bootstrap.min.js');
        $this->document->addStyle($catalogURL  . 'admin/view/javascript/'.$this->data['moduleNameSmall'].'/bootstrap/css/bootstrap.min.css');
        $this->document->addStyle($catalogURL  . 'admin/view/stylesheet/'.$this->data['moduleNameSmall'].'/font-awesome/css/font-awesome.min.css');
        $this->document->addStyle($catalogURL  . 'admin/view/stylesheet/'.$this->data['moduleNameSmall'].'/'.$this->data['moduleNameSmall'].'.css');
        $this->document->setTitle($this->language->get('heading_title'));

        if(!isset($this->request->get['store_id'])) {
           $this->request->get['store_id'] = 0; 
        }
	
        $store = $this->getCurrentStore($this->request->get['store_id']);
		
        if (($this->request->server['REQUEST_METHOD'] == 'POST')) { 	
            if (!$this->user->hasPermission('modify', 'module/'.$this->data['moduleNameSmall'])) {
                $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
            }

            if (!empty($_POST['OaXRyb1BhY2sgLSBDb21'])) {
                $this->request->post[$this->data['moduleName']]['LicensedOn'] = $_POST['OaXRyb1BhY2sgLSBDb21'];
            }

            if (!empty($_POST['cHRpbWl6YXRpb24ef4fe'])) {
                $this->request->post[$this->data['moduleName']]['License'] = json_decode(base64_decode($_POST['cHRpbWl6YXRpb24ef4fe']), true);
            }
			if(!isset($this->request->post[$this->data['moduleData_module']])) {
				$this->request->post[$this->data['moduleData_module']] = array();
			}

			
			$this->{$this->data['moduleModel']}->editSetting($this->data['moduleData_module'], $this->request->post[$this->data['moduleData_module']], $this->request->post['store_id']);
            $this->{$this->data['moduleModel']}->editSetting($this->data['moduleNameSmall'], $this->request->post, $this->request->post['store_id']);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->redirect($this->url->link('module/'.$this->data['moduleNameSmall'], 'store_id='.$this->request->post['store_id'] . '&token=' . $this->session->data['token'], 'SSL'));
        }

        if (isset($this->error['code'])) {
            $this->data['error_code'] = $this->error['code'];
        } else {
            $this->data['error_code'] = '';
        }

        $this->data['breadcrumbs']   = array();
        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
        );
        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
        );
        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('module/'.$this->data['moduleNameSmall'], 'token=' . $this->session->data['token'], 'SSL'),
        );

        $languageVariables = array(
		    // Main
			'heading_title',
			'error_permission',
			'text_success',
			'text_enabled',
			'text_disabled',
			'button_cancel',
			'save_changes',
			'text_default',
			'text_module',
			// Control panel
            'entry_code',
			'entry_code_help',
            'text_content_top', 
            'text_content_bottom',
            'text_column_left', 
            'text_column_right',
            'entry_layout',         
            'entry_position',       
            'entry_status',         
            'entry_sort_order',     
            'entry_layout_options',  
            'entry_position_options',
			'entry_action_options',
            'button_add_module',
            'button_remove',
			// Custom CSS
			'custom_css',
            'custom_css_help',
            'custom_css_placeholder',
			// Module depending
			'wrap_widget',
			'wrap_widget_help',			
			'text_panel_name',
			'text_panel_name_help',
			'text_products_small',
			'text_panel_title',
			'text_panel_title_help',
			'auto_location',
			'auto_location_help',
			'search_locations',
			'search_locations_help',
			'weather_type',
			'weather_type_help',
			// Default location
			'entry_default_location',
			'entry_default_location_help',
			//Weather Type
			'weather_current',                 
			'weather_forecast1',           
			'weather_forecast2',                
			'weather_forecast3',              
			'weather_forecast4',                             
        );
       
        foreach ($languageVariables as $languageVariable) {
            $this->data[$languageVariable] = $this->language->get($languageVariable);
        }
 
        $this->data['stores'] = array_merge(array(0 => array('store_id' => '0', 'name' => $this->config->get('config_name') . ' (' . $this->data['text_default'].')', 'url' => HTTP_SERVER, 'ssl' => HTTPS_SERVER)), $this->model_setting_store->getStores());
        $this->data['error_warning']          = '';  
        $this->data['languages']              = $this->model_localisation_language->getLanguages();
        $this->data['store']                  = $store;
        $this->data['token']                  = $this->session->data['token'];
        $this->data['action']                 = $this->url->link('module/'.$this->data['moduleNameSmall'], 'token=' . $this->session->data['token'], 'SSL');
        $this->data['cancel']                 = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['data']                   = $this->{$this->data['moduleModel']}->getSetting($this->data['moduleNameSmall'], $store['store_id']);
        $this->data['modules']				= $this->{$this->data['moduleModel']}->getSetting($this->data['moduleData_module'], $store['store_id']);
        $this->data['layouts']                = $this->model_design_layout->getLayouts();
        $this->data['catalog_url']			= $catalogURL;
		
		// Module Unifier
		$this->data['moduleData'] = (isset($this->data['data'][$this->data['moduleName']])) ? $this->data['data'][$this->data['moduleName']] : '';
		// Module Unifier
		
        $this->template = 'module/'.$this->data['moduleNameSmall'].'.tpl';
        $this->children = array('common/header', 'common/footer');
        $this->response->setOutput($this->render());
    }

    private function getCatalogURL() {
        if (isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) {
            $storeURL = HTTPS_CATALOG;
        } else {
            $storeURL = HTTP_CATALOG;
        } 
        return $storeURL;
    }

    private function getServerURL() {
        if (isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) {
            $storeURL = HTTPS_SERVER;
        } else {
            $storeURL = HTTP_SERVER;
        } 
        return $storeURL;
    }

    private function getCurrentStore($store_id) {    
        if($store_id && $store_id != 0) {
            $store = $this->model_setting_store->getStore($store_id);
        } else {
            $store['store_id'] = 0;
            $store['name'] = $this->config->get('config_name');
            $store['url'] = $this->getCatalogURL(); 
        }
        return $store;
    }
    
	
			public function getPlace() {
				$city = $_GET['city'];
				
				$json = file_get_contents('https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20geo.places%20where%20text%3D%22'.urlencode($city).'%22&format=json&diagnostics=true&callback=');
				
				//header('content-type: text/json');
				//echo $json;	
						
				$this->response->setOutput($json);
			}
	
    public function install() {
	    $this->load->model('module/'.$this->moduleNameSmall);
	    $this->{$this->moduleModel}->install();
    }
    
    public function uninstall() {
    	$this->load->model('setting/setting');
		
		$this->load->model('setting/store');
		$this->model_setting_setting->deleteSetting($this->moduleData_module,0);
		$stores=$this->model_setting_store->getStores();
		foreach ($stores as $store) {
			$this->model_setting_setting->deleteSetting($this->moduleData_module, $store['store_id']);
		}
		
        $this->load->model('module/'.$this->moduleNameSmall);
        $this->{$this->moduleModel}->uninstall();
    }
	
	
		
	
	
	
}

?>