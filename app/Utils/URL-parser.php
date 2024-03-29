<?php
/**
 * parseURL class
 *
 * Very simple and basic class for parsing a url. outputs url protocol, host, path and the query string.
 *
 * @version 	0.2
 * @author 		Christian Weber <christian@cw-internetdienste.de>
 * @link		http://www.cw-internetdienste.de
 * 
 *  freely distributable under the MIT Licence
 *
 */
 
class URLParser {
	private		$regex	=	'@\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))@';
	
	protected 	$url;
	//we use get method to get the values of properties
	private 	$protocol;
	private 	$host;
	private 	$path;
	private		$query;
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @param mixed $url
	 * @return int
	 */
	public function __construct($url) {
		if(!isset($url)	||	empty($url)	||	trim($url) == ''	||	!is_string($url)	||	!$this->check($url)) {	return false; }
		$this->url	=	$url;
		$this->parseURL();
	}
	
	/**
	 * check function.
	 * 
	 * @access private
	 * @param mixed $url
	 * @return int
	 */
	private function check($url) {
		if(function_exists('filter_var')) {
			return filter_var($url, FILTER_VALIDATE_URL);
		} else {
			return 	preg_match($this->regex,$url);
		}
	}
	
	/**
	 * parseURL function.
	 * 
	 * @access private
	 * @return int
	 */
	private function parseURL() {
		$data	=	parse_url($this->url);
				
		$this->protocol	=	$data['scheme'];
		$this->host		=	$data['host'];
		
		$path			=	(isset($data['path']))	?	$data['path']:'';
		$this->path		=	$this->parsePath($path);
		
		$query			=	(isset($data['query'])) ? $data['query']:'';
		$this->query	=	$this->parseQuery($query);
	}
	
	/**
	 * parsePath function.
	 * 
	 * @access private
	 * @param mixed $path
	 * @return int
	 */
	private function parsePath($path) {
		$_path	=	array();
		
		if(!empty($path)) {
			if(substr($path,0,1) 	=== 	'/') 	{	$path	=	substr($path,1);	}
			if(substr($path,-1)		===		'/')	{	$path	=	substr($path,0,-1);	}
			
			$_path	=	explode('/',$path);
		}
		
		return $_path;
	}
	
	/**
	 * parseQuery function.
	 * 
	 * @access private
	 * @param mixed $query
	 * @return int
	 */
	private function parseQuery($query) {
		$_query			=	array();
		
		if(!empty($query)) {
			$_q	=	explode('&',$query);

			foreach($_q as $item) {
				$_item	=	explode('=',$item);
				$_query[$_item[0]]	=	(isset($_item[1])) ? $_item[1]:true;
			}
			
		}
		
		return $_query;
	}
	
	/**
	 * get function.
	 * 
	 * @access public
	 * @param mixed $type
	 * @return int
	 */
	public function get($type) {
		switch(strtolower($type)) {
			case 'url':			return $this->get_url();
								break;
			case 'protocol':	return $this->get_protocol();
								break;
			case 'host':		return $this->get_host();
								break;
			case 'path':		return $this->get_path();
								break;
			case 'query':		return $this->get_query();
								break;
			default:			return false;
								break;
		}
	}
	
	/**
	 * get_url function.
	 * 
	 * @access public
	 * @return int
	 */
	public function get_url(){
    	return $this->url;
	}
	
	/**
	 * get_protocol function.
	 * 
	 * @access public
	 * @return int
	 */
	public function get_protocol(){
	    return $this->protocol;
	}
	
	/**
	 * get_host function.
	 * 
	 * @access public
	 * @return int
	 */
	public function get_host(){
	    return $this->host;
	}
	
	/**
	 * get_path function.
	 * 
	 * @access public
	 * @return int
	 */
	public function get_path(){
	    return $this->path;
	}
	
	/**
	 * get_query function.
	 * 
	 * @access public
	 * @return int
	 */
	public function get_query(){
	    return $this->query;
	}
	
}