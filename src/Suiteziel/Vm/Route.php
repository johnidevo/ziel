<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Org\Diamonds;
use App\Suiteziel\Vm;
use App\Suiteziel\Vm\Opcodes;
use App\Suiteziel\Vm\Memory;
use App\Suiteziel\Vm\Stack;
use App\Suiteziel\Vm\State;

class Route extends Vm
{
	public $i_pc;
	public $aHex;
	public $oOpcodes;
	public $oMemory;
	public $oStack;
	public $oState;

	function __construct() {
		$this->i_pc = 0;
		$this->oOpcodes = new Opcodes();
		$this->oMemory = new Memory();
		$this->oStack = new Stack();
		$this->oState = new State();
	}

	public function set_hex() :bool {
		$this->aHex = Diamonds::$_aHex;
		return true;
	}
/*
		$this->i_pc = 0;
		$this->i_pc = 0;
		$this->i_pc = 0;
		$this->i_pc = 0;
		$this->i_pc = 0;
		$this->i_pc = 0;
		$this->i_sp = 0;
		$this->i_sp = 0;
		$this->i_sp = 0;
		$this->i_sp = 0;
*/
	public function implement () :bool {
		//if (!$this->set_hex() && empty($this->aHex)) die('Route->implement');

		$this->aHex = array(
			//0x60, 32, 0x60, 33, 0x00, //STOP

			0x60, 32, //PUSH1
			0x60, 33, //PUSH1
			0x01, //ADD
			0x60, 313030, //PUSH1
			0x02, //MUL
/*
			0x60, 363030, 0x03, //SUB

			0x60, 36303030, 0x04, //DIV
			0x60, 36303030, 0x05, //SDIV
			0x60, 3130, 0x06, //MOD
			0x60, 32, 0x07, //SMOD
			0x60, 313030, 0x60, 313030, 0x08, //ADDMOD
			0x60, 32, 0x60, 32, 0x09, //MULMOD
			0x60, 32, 0x0a, //EXP
			//0x60, 313030, 0x0b, //SIGNEXTEND
			0x60, 313030, 0x10, //LT
			0x60, 31, 0x60, 32, 0x11, //GT
			0x60, 313030, 0x12, //SLT
			0x60, 313030, 0x13, //SGT
			0x60, 313030, 0x14, //EQ
			0x60, 313030, 0x15, //ISZERO
			0x60, 313030, 0x16, //AND
			0x60, 313030, 0x17, //OR
			0x60, 313030, 0x18, //XOR
			0x60, 313030, 0x19, //NOT
			0x60, 313030, 0x1a, //BYTE
			
			0x60, 313030, 0x1b, //SHL 
			0x60, 313030, 0x1c, //SHR 
			0x60, 313030, 0x1d, //SAR 
			
			0x60, 313030, 0x20, //SHA3

			0x60, 54, //PUSH1
			0x61, 54, 68, //PUSH2
			0x62, 54, 68, 65, //PUSH3
			0x63, 54, 68, 65, 20, //PUSH4
			0x63, 01, 02, 03, 04,
			0x64, 54, 68, 65, 20, 71, //PUSH5
			0x65, 54, 68, 65, 20, 71, 75, //PUSH6
			0x66, 54, 68, 65, 20, 71, 75, 69, //PUSH7
			0x67, 54, 68, 65, 20, 71, 75, 69, 63, //PUSH8
			0x68, 54, 68, 65, 20, 71, 75, 69, 63, '6B', //PUSH9
			0x69, 54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, //PUSH10
			
			0x6a,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62,  //PUSH11
			0x6b,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, //PUSH12
			0x6c,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', //PUSH13
			0x6d,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, //PUSH14
			0x6e,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', //PUSH15
			0x6f,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', 20, //PUSH16
			0x70,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', 20, 66, //PUSH17
			0x71,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', 20, 66, '6F', //PUSH18
			0x72,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', 20, 66, '6F', 78, //PUSH19
			0x73,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', 20, 66, '6F', 78, 20, //PUSH20
			0x74,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', 20, 66, '6F', 78, 20, '6A', //PUSH21
			0x75,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', 20, 66, '6F', 78, 20, '6A', 75, //PUSH22
			0x76,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', 20, 66, '6F', 78, 20, '6A', 75, '6D', //PUSH23
			0x77,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', 20, 66, '6F', 78, 20, '6A', 75, '6D', 70, //PUSH24
			0x78,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', 20, 66, '6F', 78, 20, '6A', 75, '6D', 70, 73, //PUSH25
			0x79,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', 20, 66, '6F', 78, 20, '6A', 75, '6D', 70, 73, 20, //PUSH26
			0x7a,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', 20, 66, '6F', 78, 20, '6A', 75, '6D', 70, 73, 20, '6F', //PUSH27
			0x7b,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', 20, 66, '6F', 78, 20, '6A', 75, '6D', 70, 73, 20, '6F', 76, //PUSH28
			0x7c,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', 20, 66, '6F', 78, 20, '6A', 75, '6D', 70, 73, 20, '6F', 76, 65, //PUSH29
			0x7d,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', 20, 66, '6F', 78, 20, '6A', 75, '6D', 70, 73, 20, '6F', 76, 65, 72, //PUSH30
			0x7e,  54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', 20, 66, '6F', 78, 20, '6A', 75, '6D', 70, 73, 20, '6F', 76, 65, 72, 20, //PUSH31
			
			0x7f, 54, 68, 65, 20, 71, 75, 69, 63, '6B', 20, 62, 72, '6F', 77, '6E', 20, 66, '6F', 78, 20, '6A', 75, '6D', 70, 73, 20, '6F', 76, 65, 72, 20, 74, //PUSH32
			
			0x60, 313030, 0x80, //DUP1
			0x60, 313130, 0x81, //DUP2
			0x60, 303031, 0x82, //DUP3
			0x60, 313130, 0x83, //DUP4
			0x60, 313031, 0x84, //DUP5
			0x60, 313131, 0x85, //DUP6
			0x60, 303031, 0x86, //DUP7
			0x60, 303031, 0x87, //DUP8
			0x60, 313030, 0x88, //DUP9
			
			0x60, 313030, 0x89, //DUP10
			0x60, 313030, 0x8a, //DUP11
			0x60, 313030, 0x8b, //DUP12
			0x60, 303031, 0x8c, //DUP13
			0x60, 313131, 0x8d, //DUP14
			0x60, 303031, 0x8e, //DUP15
			0x60, 313130, 0x8f, //DUP16
			
			0x90, //SWAP1
			0x91, //SWAP2
			0x92, //SWAP3
			0x93, //SWAP4
			0x94, //SWAP5
			0x95, //SWAP6
			0x96, //SWAP7
			0x97, //SWAP8
			0x98, //SWAP9
			0x99, //SWAP10
			0x9a, //SWAP11
			0x9b, //SWAP12
			0x9c, //SWAP13
			0x9d, //SWAP14
			0x9e, //SWAP15
			0x9f, //SWAP16
			
			0x60, 313030, 0xa0, //LOG0
			0x60, 313030, 0xa1, //LOG1
			0x60, 313030, 0xa2, //LOG2
			0x60, 313030, 0xa3, //LOG3
			0x60, 313030, 0xa4, //LOG4
*/
			0x60, 313030, //PUSH1
			0x58, //PC
			
			//0x60, 32, //PUSH1
			//0x60, 313030, 0x56, //JUMP
			//0x60, 313030, 0x57, //JUMPI
			
			
			//0x60, 313030, 0x30, //ADDRESS
			//0x60, 313030, 0x31, //BALANCE
			//0x60, 313030, 0x32, //ORIGIN
			//0x60, 313030, 0x33, //CALLER
			//0x60, 313030, 0x34, //CALLVALUE
			//0x60, 313030, 0x35, //CALLDATALOAD
			//0x60, 313030, 0x36, //CALLDATASIZE
			//0x60, 313030, 0x37, //CALLDATACOPY
			//0x60, 313030, 0x38, //CODESIZE
			//0x60, 313030, 0x39, //CODECOPY
			//0x60, 313030, 0x3a, //GASPRICE
			//0x60, 313030, 0x3b, //EXTCODESIZE
			//0x60, 313030, 0x3c, //EXTCODECOPY
			//0x60, 313030, 0x40, //BLOCKHASH
			//0x60, 313030, 0x41, //COINBASE
			//0x60, 313030, 0x42, //TIMESTAMP
			//0x60, 313030, 0x43, //NUMBER
			//0x60, 313030, 0x44, //DIFFICULTY
			//0x60, 313030, 0x45, //GASLIMIT
			//0x60, 313030, 0x50, //POP
			
			//0x60, 313030, 0x51, //MLOAD
			//0x60, 313030, 0x52, //MSTORE
			//0x60, 313030, 0x53, //MSTORE8
			//0x60, 313030, 0x54, //SLOAD
			//0x60, 313030, 0x55, //SSTORE
			//0x60, 313030, 0x59, //MSIZE
			//0x60, 313030, 0x5a, //GAS
			//0x60, 313030, 0x5b, //JUMPDEST
			
			//0x60, 313030, 0xf0, //CREATE
			//0x60, 313030, 0xf1, //CALL
			//0x60, 313030, 0xf2, //CALLCODE
			//0x60, 313030, 0xf3, //RETURN
			//0x60, 313030, 0xf4, //DELEGATECALL
			//0x60, 313030, 0xfe, //INVALID
			//0x60, 313030, 0xff, //SELFDESTRUCT
		);

		if (!$this->oOpcodes->hex_set($this->aHex)) die('oOpcodes->hex_set');
		
		$i_opargs = 0;
		foreach ($this->aHex as $k => $sHex) {
			$this->i_pc = $k;
			
			if ($i_opargs !== 0) { $i_opargs--; continue; }
			
			if (!$this->oOpcodes->initiate($k, $sHex)) die('oOpcodes->initiate'); // view
			if (!$this->oOpcodes->describe($k, $sHex)) die('oOpcodes->describe');
			
			$aArguments = $this->oOpcodes->aArguments;

			$iDelta = $this->oOpcodes->aaOpcodes[$sHex][1];

/*
s[0] if s[1] 6= 0
*/

$aa_p = array(
	$sHex,
	$aArguments,
	$iDelta,
	$this->i_pc,
	$this->oStack->aaStack,
);

			if (!$this->oStack->positioning($aa_p)) die('oStack->positioning'); //$k, $sHex, $aArguments, $iDelta)) die('oStack->positioning');
			
			
			$aa_p[4] = $this->oStack->aaStack;
			
			//if (!$this->oStack->positioning($k, $sHex, $aArguments, $iDelta)) die('oStack->positioning');
			//if (!$this->oMemory->positioning($k, $sHex)) die('oMemory->positioning');
			if (!$this->oState->positioning($aa_p)) die('oState->positioning');

			$i_opargs = count($aArguments);
			
		}
		
		var_dump('$this->oStack->aaStack');
		var_dump($this->oStack->aaStack);
		return true;
	}

}

?>