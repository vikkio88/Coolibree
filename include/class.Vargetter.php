<?php
/**
 * This awesome class is usefull for getting vars by POST or GET method simply
 * by calling it value
 * example
 * 
 * <?php
 * 	if (isset($_GET['ciao']))
 * 	{
	 $ciao=$_GET['ciao'];
	}else if(isset($_POST['ciao'])){
		$ciao=$_POSt['ciao'];
	}
 * 	echo $ciao;
 * ?>
 * 
 * become
 * <?php
 * 	include_once('class.Vargetter.php');
 * 	$var=new Vargetter['ciao'];
 * 	echo $var->val();
 * ?>
 * */
class Vargetter {
//the following rows control user arguments and set vars
	// The priority os assigned to var recieved by POST method
	var $varname;
	var $value;
	
	function __construct($varname=NULL){
	//varname is the setting name in the method
		$this->varname=$varname;
		
		if($varname!=NULL){
			$this->value = $this->getvar();
		}else{
			$this->value = NULL;
		}
		
	}
	
	function getvar(){
		if(isset($_GET[$this->varname])){
			//echo "gained with get";
			$vartoset=$_GET[$this->varname];
		}else if(isset($_POST[$this->varname])){
			//echo "gained with post";
			$vartoset=$_POST[$this->varname];
		}else{
			//echo "null";
			$vartoset=NULL;
		}
		
		return $vartoset;
	}
	
	function val(){
		return $this->value;
	}
	
}
?>
