<?php
namespace App\Suiteziel\Org;


class Diamonds
{
	
	public $sFilePath;
	public $sFilePathOutput;
		
	public function __construct() {
		$this->sFilePathOutput = "./src/diamonds/". date("Ymd") ."/";
	}
		
	public function compile_contract($sFilePath = null) :bool {
		if(empty($sFilePath)) return print '$sFilePath missing!';
		else $this->$sFilePath = $sFilePath;
		
		$sCommand = 'solc --bin-runtime --overwrite --asm --optimize -o '. $this->sFilePathOutput .' '.$sFilePath;
		
		$output=null;
		$retval=null;
		exec($sCommand, $output, $retval);
		print_r($output);
		return true;
	}
	
	public function read_from_file() {
		//if(empty($sFilePath)) return print '$sFilePath missing!';
		//else $this->$sFilePath = $sFilePath;

			
$aFilesOutput = scandir($this->sFilePathOutput);
		var_dump($aFilesOutput);
		
foreach ($aFilesOutput as $sFileOutput) {
	
preg_match("(/\w)*bin-runtime\b", $sFileOutput, $matches);
	var_dump($matches);
	
}
/*
preg_match('(\w)*bin-runtime\b', $sFileOutput, $matches);
$host = $matches[1];
*/

		
		
	}
	
	public function write_to_file($sFilePath) {
		return file_exists($sFilePath);
	}
}

/*
opcodes vm memory stack parameters test
*/
?>