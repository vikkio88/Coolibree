<?php
/**# CoolibreeCMS
	#
	# copyleft by vikkio88 <vikkio88@yahoo.it>
	#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	# visit: http://vikkio88.altervista.org
	#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 *  # This file is part of CoolibreeCMS
 *  #
	#   This program is free software: you can redistribute it and/or modify
	#   it under the terms of the GNU General Public License as published by
	#   the Free Software Foundation, either version 3 of the License, or
	#   (at your option) any later version.
	#   This program is distributed in the hope that it will be useful,
	#   but WITHOUT ANY WARRANTY; without even the implied warranty of
	#   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	#   GNU General Public License for more details.
	#
	#   You should have received a copy of the GNU General Public License
	#   along with this program.  If not, see <http://www.gnu.org/licenses/>.
* 
* */
//this is a powefull class that can log an error to a password protected script in ../db dir
//very usefull :D and powefull!
class ErrorLogger{
	var $type; //the error type contains the string you wnat log as error type
	var $pathdb; //the usually path where db is in function of where comment object is called
	var $news; // a var that explain the new value of an error useless at the extern of this class
	
	function __construct($type,$pathdb='./db/logs'){
		$this->type=$type;
		$this->pathdb=$pathdb;
		
		//Log information
		$dataora=time();
		$datareale=date('d/m/Y',$dataora);
		$datareale="$datareale ".(date("G:i",$dataora));
		$ip=$_SERVER['REMOTE_ADDR'];
		$uagent=htmlspecialchars($_SERVER['HTTP_USER_AGENT']);
		//creating news entry for log
		$this->news="|*|logEntry:> $ip on date: $datareale useragent: $uagent --Errortype->".$this->type;
	}
	
	function writeToLog(){
		//this method recreate logs.php script down in db directory
		// adding some logentry separated by a \n and a usefull delimiters-> |*|
		//you can delete him and parse hime every |*| indicate a log entry
		//in adminpanel i replace |*| with <br /> for view correctly logs in html
		$f1=fopen($this->pathdb.'/logs.php','r');
		$alltext='';
		while (! feof ($f1)) {
			$alltext.= fgets ($f1);
		}
		fclose ($f1);
		$oldlog='';
			if (preg_match('/\/\/LOG\n([^`]*?)\/\/EOL/', $alltext, $out)){
				$oldlog = $out[1];
			}
		$f1=fopen($this->pathdb.'/logs.php','w');
		//fwrite($f1,"php\n include(\"../../include/config.php\");\ninclude_once(\"../../include/class.ErrorLogger.php\");\nif(".'$control'."){\necho \"//LOG\n".$oldlog."\n".$this->news."\n//EOL\";\n}else{\n".'$error'."=new ErrorLogger(\"Try to access log\",\".\");\n".'$error->writeToLog()'.";\n\necho \"Logs view is for admin only!Incident reported\";\n}\n");
		$newlog="<?php die('No');\n//LOG\n$oldlog\n".$this->news."\n//EOL\n?>";
		fwrite($f1,$newlog);
		fclose($f1);
	}
}
?>
