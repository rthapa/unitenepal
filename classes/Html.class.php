<?php
/**
 * Author: rabi thapa
 * Version: 1.0
 */
class Html{

	public $faviconUrl = '';
	public $meta = array(); 
	public $js = array();
	public $css = array();
	public $title = "";

	function __construct(){
		// $this->js[] = '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>';
		$this->css[] = '<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">';
	}

	public function injectHeader(){
		$output = '<!DOCTYPE html>
				<html>
				<head>
					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width , initial-scale=1">
					<title>'.$this->getTitle().'</title>
					<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
					<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
					<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
					<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic" rel="stylesheet" type="text/css">
					';

		//meta tag
		foreach($this->meta as $m){
			$output .= $m;
		}

		//favicon
		if(trim($this->faviconUrl) != ''){
			$output .= '<link rel="shortcut icon" href="'.$this->faviconUrl.'">';
		}

		//js
		foreach($this->js as $j){
			$output .= $j;
		}

		//css
		foreach($this->css as $c){
			$output .= $c;
		}

					
		$output .= '</head>
					<body>';

		return $output;
	}

	public function injectFooter(){
		$output = '</body>
					</html>';
		return $output;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function getTitle(){
		return $this->title;
	}
}
