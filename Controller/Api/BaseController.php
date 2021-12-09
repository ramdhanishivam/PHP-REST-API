<<?php 

/**
 * 
 */
class BaseController
{
	
	public function __call($name, $argument)
	{
		$this->sendOutput('', array('HTTP/1.1 404 Not Found'));
	}

	// validate the REST endpoint called by the user.
	protected function getUrlSegments()
	{
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$uri = explode('/', $uri);

		return $uri;
	}

	// returns an array of query string variables that are passed along with the incoming request.
	protected function getQueryStringParams()
	{
		return parse_str($_SERVER['QUERY_STRING'], $query);
	}

	// Used to send the API response.
	// We’ll call this method when we want to send the API response to the user.
	protected function sendOutput($data, $httpHeaders = array())
	{
		header_remove('Set-Cookie');

		if (is_array($httpHeaders) && count($httpHeaders)) {
			foreach ($httpHeaders as $httpHeader) {
				header($httpHeader);
			}
		}

		echo $data;
		exit();
	}
}

?>