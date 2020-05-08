# AzureTilt
Code for communicating with Azure using a RaspberryPi and Tilt Hydrometer

You'll need to create a const.php file in the same folder as the other php files with the following contents:


	class AzureConfig {
		public $LA_WORKSPACE_KEY = '';
		public $LA_WORKSPACE_ID = '';
		public $LA_LOG_TYPE = '';
		
		public function __Construct() {}
	}


The $LA_WORKSPACE_KEY can be either the primary or secondary key for you Log Analytics Workspace.  
The $LA_LOG_TYPE variable is the name of the log you want to write data to in Log Analytics.  Log Analytics will automatially append the '_CL' to the end, so do not add this or you will end up with two '_CL' at the end of the log name.
