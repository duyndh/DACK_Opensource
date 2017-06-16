<?php 
class ControllerModuleWeatherWidget extends Controller  {
	// Module Unifier
	private $moduleName = 'WeatherWidget';
	private $moduleNameSmall = 'weatherwidget';
	private $moduleData_module = 'weatherwidget_module';
	private $moduleModel = 'model_module_weatherwidget';
	// Module Unifier

    public function index() {
        $this->load->model('module/'.$this->moduleNameSmall);
        $this->load->language('module/'.$this->moduleNameSmall);
		//$this->document->addStyle('catalog/view/theme/default/stylesheet/custom.css');
        $this->document->addStyle('catalog/view/theme/'.$this->config->get('config_template').'/stylesheet/'.$this->moduleNameSmall.'.css');
		
		
		//$this->document->addStyle('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css');
		//$this->document->addScript('//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js');



		$languageVariables= array(
			// Basic strings
			'heading_title',
		);
	
		foreach ($languageVariables as $variable) {
			$this->data[$variable] = $this->language->get($variable);
		}
		
		$setting = $this->{$this->moduleModel}->getSetting($this->moduleName, $this->config->get('config_store_id'));
        $this->data['data'] = $setting[$this->moduleName];
		
		if(!isset($this->data['data']['PanelName'][$this->config->get('config_language')])){
			$this->data['data']['PanelName'] = $this->data['heading_title'];
		} else {
			$this->data['data']['PanelName'] = $this->data['data']['PanelName'][$this->config->get('config_language')];
		}
		
		if(!isset($this->data['data']['PanelTitle'][$this->config->get('config_language')])){
			$this->data['data']['PanelTitle'] = $this->data['heading_title'];
		} else {
			$this->data['data']['PanelTitle'] = $this->data['data']['PanelTitle'][$this->config->get('config_language')];
		}
		
		
		
		$this->data['weatherwidget_placecode'] = $this->data['data']['DefaultLocation'];
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/weatherwidget.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/weatherwidget.tpl';
		} else {
			$this->template = 'default/template/module/weatherwidget.tpl';
		}
		
		$this->render();
	}
	
	public function getplace() {
		$city = $_GET['city'];
		
		$json = file_get_contents('https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20geo.places%20where%20text%3D%22'.urlencode($city).'%22&format=json&diagnostics=true&callback=');
			
				
		$this->response->setOutput($json);
	}
	
		public function getweather() {
		$code = $_GET['code'];
		
		$tempformat=$_GET['format'];

		$json = file_get_contents('https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%3D'.$code.'%20and%20u%3D%22'.$tempformat.'%22&format=json&diagnostics=true&callback=');
	
		$this->response->setOutput($json);
	}
	
	
		
		public function getwoeid() {
			$lat = $_GET['lat'];
			$long = $_GET['long'];

			
			$json = file_get_contents('https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20geo.placefinder%20where%20text%3D%22'.$lat.'%2C'.$long.'%22%20and%20gflags%3D%22R%22&format=json&diagnostics=true&callback=');
			
		
			$this->response->setOutput($json);
	
	
		}
	
	
}
?>