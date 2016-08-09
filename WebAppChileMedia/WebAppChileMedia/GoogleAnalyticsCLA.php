<?php
	class GoogleAnalyticsCLA extends Loggin_Analytics
	{
		private $dateStart;
		private $dateEnd;

		public function __construct()
		{
			parent::__construct();
			$this->dateStart = '1daysAgo';
			$this->dateEnd = '1daysAgo';
		}

		public function getResults( $optGA )
		{
			// metricas
			$metrics = $optGA['metrics'];

			// remueve las metricas del array
			unset($optGA['metrics']);
			$params = $optGA;

			$totDimensions = 0;
			$arrayOut      = array();

			// si existen parametros adicionales
			if ( count($params) > 0 ) {
				if (isset($params['dimensions'])) {
					if ($params['dimensions'] !== '')
						$totDimensions = count(explode(',', $params['dimensions']));
				}
			}

			// obtiene los datos desde Google Analytics
			$response = $this->analytics->data_ga->get(
				$this->profile,
				$this->dateStart,
				$this->dateEnd,
				$metrics,
				$params);

			// valores consultados
			$data = $response->getRows();

			// número de elementos
			$idxMaxFields = count($data[0]);

			// array con las metricas
			$arrayMetAux = explode(',', $metrics);

			foreach ($data as $key => $value) {
				$idxDimension  = 0;
				$lblDimension  = '';
				$idxMetric     = 0;
				$arrayMetricas = array();
				$nameField     = $this->dateStart.'~'.$this->dateEnd;

				// si existen dimensiones
				if ($totDimensions > 0) {
					for ($idxDimension; $idxDimension < $totDimensions; $idxDimension++) { 
						$lblDimension .= $value[$idxDimension].'~';
					}

					$nameField = preg_replace('/~$/', '', $lblDimension);
				}

				// por cada una de las metricas le asigna su respectivo valor
				for ($i=$idxDimension; $i < $idxMaxFields; $i++) { 
					$arrayMetricas[$arrayMetAux[$idxMetric]] = $value[$i];
					$idxMetric++;
				}
				
				$arrayOut[$nameField] = $arrayMetricas;
			}

			// print_r($arrayOut);
			return $arrayOut;
		}

		public function setDateRange( $start='1daysAgo', $end='1daysAgo' )
		{
			$this->dateStart = $start;
			$this->dateEnd = $end;
		}
	}
	
	class Loggin_Analytics
	{
		public $analytics;
		public $profile;
		public $serviceAccountEmail;
		public $keyFile;
		public $scriptName;

		public function __construct()
		{
			$this->serviceAccountEmail = '526905039552-9kb0ghqi3ndgmkq5a27u7jc1q0ibo2jd@developer.gserviceaccount.com';
			$this->keyFile = 'P12/client_secrets.p12';
			$this->scriptName = 'ReportesAnalitycs';
			$this->analytics = $this->getService();
			$this->profile = $this->getFirstprofileId( $this->analytics );
		}

		private function getService()
	    {
	        require_once 'google-api-php-client/src/Google/autoload.php';
	        $service_account_email = $this->serviceAccountEmail;
	        $key_file_location     = $this->keyFile;
	        $client                = new Google_Client();

	        $client->setApplicationName($this->scriptName);
	        $analytics = new Google_Service_Analytics($client);
	        $key       = file_get_contents($key_file_location);
	        $cred      = new Google_Auth_AssertionCredentials($service_account_email,array(Google_Service_Analytics::ANALYTICS_READONLY),$key);

	        $client->setAssertionCredentials($cred);
	        if($client->getAuth()->isAccessTokenExpired()) 
	        {
	          $client->getAuth()->refreshTokenWithAssertion($cred);
	        }
	        return $analytics;
	    }

	    private function getFirstprofileId(&$analytics)
	    {
	        $accounts = $analytics->management_accounts->listManagementAccounts();
	        if (count($accounts->getItems()) > 0) 
	        {
	            $items          = $accounts->getItems();
	            $firstAccountId = $items[0]->getId();
	            $properties     = $analytics->management_webproperties->listManagementWebproperties($firstAccountId);

	            if (count($properties->getItems()) > 0) 
	            {
	                $items           = $properties->getItems();
	                $firstPropertyId = $items[0]->getId();
	                $profiles        = $analytics->management_profiles->listManagementProfiles($firstAccountId, $firstPropertyId);

	                if (count($profiles->getItems()) > 0) 
	                {
	                    $items = $profiles->getItems();
	                    return 'ga:' .$items[0]->getId();
	                } 
	                else
	                {
	                    throw new Exception('No views (profiles) found for this user.');
	                }
	            }
	            else 
	            {
	                throw new Exception('No properties found for this user.');
	            }
	        } 
	        else
	        {
	            throw new Exception('No accounts found for this user.');
	        }
	    }
	}
?>