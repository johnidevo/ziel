<?php

require __DIR__.'/../config/bootstrap.php';

echo '<pre>';

use App\Suiteziel\Org\Diamonds;
use App\Suiteziel\Vm\Opcodes;
use App\Suiteziel\Vm\Stack;
use App\Suiteziel\Vm\Box;

$oDiamonds = new Diamonds();
$oOpcodes = new Opcodes();
$oBox = new Box();

$oDiamonds->iCursor = 1; // skip compilation
$oDiamonds->sContract = 'Storage.sol'; // contract file name in contracts folder
$oDiamonds->sFolder = '20220714123825000000'; // specify folder
if (!$oDiamonds->set_output_folder()) die('oDiamonds->set_output_folder'); //set it
if (!$oDiamonds->compile_contract()) die('oDiamonds->compile_contract');
if (!$oDiamonds->iCursor) die('oDiamonds->iCursor');
if (!$oDiamonds->read_from_file()) die('oDiamonds->read_from_file');
var_dump($oDiamonds->sHex);
if (!$oDiamonds->decode_hex()) die('oDiamonds->decode_hex');
if (!$oOpcodes->hex_set($oDiamonds->aHex)) die('$oOpcodes->hex_set');

var_dump(implode(",", str_split($oDiamonds->sHex, 2)));
var_dump(implode(",", $oDiamonds->aHex));


$iCountArguments = 0; //if ! stack #no continue...

foreach ($oDiamonds->aHex as $k => $sHex) {
	if ($iCountArguments !== 0) {
		$iCountArguments = $iCountArguments - 1;
		continue;
	}

	if (!$oOpcodes->initiate($k, $sHex)) die('oOpcodes->initiate');
	if (!$oOpcodes->describe($k, $sHex)) die('oOpcodes->describe');
	$iCountArguments = count($oOpcodes->aArguments);
	
	
	if (!$oBox->implement($oOpcodes, $sHex)) die('oBox->implement');


}


/*
[
	"0x608060405234801561001057600080fd5b50610150806100206000396000f3fe608060405234801561001057600080fd5b50600436106100365760003560e01c80632e64cec11461003b5780636057361d14610059575b600080fd5b610043610075565b60405161005091906100d9565b60405180910390f35b610073600480360381019061006e919061009d565b61007e565b005b60008054905090565b8060008190555050565b60008135905061009781610103565b92915050565b6000602082840312156100b3576100b26100fe565b5b60006100c184828501610088565b91505092915050565b6100d3816100f4565b82525050565b60006020820190506100ee60008301846100ca565b92915050565b6000819050919050565b600080fd5b61010c816100f4565b811461011757600080fd5b5056fea2646970667358221220140fd858a621706cd19a802320077c4560f27ad02dd54267c2fe5d8406717a9464736f6c63430008070033"
]
{
	"functionDebugData": {},
	"generatedSources": [],
	"linkReferences": {},
	"object": "608060405234801561001057600080fd5b50610150806100206000396000f3fe608060405234801561001057600080fd5b50600436106100365760003560e01c80632e64cec11461003b5780636057361d14610059575b600080fd5b610043610075565b60405161005091906100d9565b60405180910390f35b610073600480360381019061006e919061009d565b61007e565b005b60008054905090565b8060008190555050565b60008135905061009781610103565b92915050565b6000602082840312156100b3576100b26100fe565b5b60006100c184828501610088565b91505092915050565b6100d3816100f4565b82525050565b60006020820190506100ee60008301846100ca565b92915050565b6000819050919050565b600080fd5b61010c816100f4565b811461011757600080fd5b5056fea2646970667358221220140fd858a621706cd19a802320077c4560f27ad02dd54267c2fe5d8406717a9464736f6c63430008070033",
	"opcodes": "PUSH1 0x80 PUSH1 0x40 MSTORE CALLVALUE DUP1 ISZERO PUSH2 0x10 JUMPI PUSH1 0x0 DUP1 REVERT JUMPDEST POP PUSH2 0x150 DUP1 PUSH2 0x20 PUSH1 0x0 CODECOPY PUSH1 0x0 RETURN INVALID PUSH1 0x80 PUSH1 0x40 MSTORE CALLVALUE DUP1 ISZERO PUSH2 0x10 JUMPI PUSH1 0x0 DUP1 REVERT JUMPDEST POP PUSH1 0x4 CALLDATASIZE LT PUSH2 0x36 JUMPI PUSH1 0x0 CALLDATALOAD PUSH1 0xE0 SHR DUP1 PUSH4 0x2E64CEC1 EQ PUSH2 0x3B JUMPI DUP1 PUSH4 0x6057361D EQ PUSH2 0x59 JUMPI JUMPDEST PUSH1 0x0 DUP1 REVERT JUMPDEST PUSH2 0x43 PUSH2 0x75 JUMP JUMPDEST PUSH1 0x40 MLOAD PUSH2 0x50 SWAP2 SWAP1 PUSH2 0xD9 JUMP JUMPDEST PUSH1 0x40 MLOAD DUP1 SWAP2 SUB SWAP1 RETURN JUMPDEST PUSH2 0x73 PUSH1 0x4 DUP1 CALLDATASIZE SUB DUP2 ADD SWAP1 PUSH2 0x6E SWAP2 SWAP1 PUSH2 0x9D JUMP JUMPDEST PUSH2 0x7E JUMP JUMPDEST STOP JUMPDEST PUSH1 0x0 DUP1 SLOAD SWAP1 POP SWAP1 JUMP JUMPDEST DUP1 PUSH1 0x0 DUP2 SWAP1 SSTORE POP POP JUMP JUMPDEST PUSH1 0x0 DUP2 CALLDATALOAD SWAP1 POP PUSH2 0x97 DUP2 PUSH2 0x103 JUMP JUMPDEST SWAP3 SWAP2 POP POP JUMP JUMPDEST PUSH1 0x0 PUSH1 0x20 DUP3 DUP5 SUB SLT ISZERO PUSH2 0xB3 JUMPI PUSH2 0xB2 PUSH2 0xFE JUMP JUMPDEST JUMPDEST PUSH1 0x0 PUSH2 0xC1 DUP5 DUP3 DUP6 ADD PUSH2 0x88 JUMP JUMPDEST SWAP2 POP POP SWAP3 SWAP2 POP POP JUMP JUMPDEST PUSH2 0xD3 DUP2 PUSH2 0xF4 JUMP JUMPDEST DUP3 MSTORE POP POP JUMP JUMPDEST PUSH1 0x0 PUSH1 0x20 DUP3 ADD SWAP1 POP PUSH2 0xEE PUSH1 0x0 DUP4 ADD DUP5 PUSH2 0xCA JUMP JUMPDEST SWAP3 SWAP2 POP POP JUMP JUMPDEST PUSH1 0x0 DUP2 SWAP1 POP SWAP2 SWAP1 POP JUMP JUMPDEST PUSH1 0x0 DUP1 REVERT JUMPDEST PUSH2 0x10C DUP2 PUSH2 0xF4 JUMP JUMPDEST DUP2 EQ PUSH2 0x117 JUMPI PUSH1 0x0 DUP1 REVERT JUMPDEST POP JUMP INVALID LOG2 PUSH5 0x6970667358 0x22 SLT KECCAK256 EQ 0xF 0xD8 PC 0xA6 0x21 PUSH17 0x6CD19A802320077C4560F27AD02DD54267 0xC2 INVALID 0x5D DUP5 MOD PUSH18 0x7A9464736F6C634300080700330000000000 ",
	"sourceMap": "191:356:0:-:0;;;;;;;;;;;;;;;;;;;"
}

{

	"diamond": "6080604052348015600f57600080fd5b506004361060325760003560e01c80632e64cec11460375780636057361d14604c575b600080fd5b60005460405190815260200160405180910390f35b605c6057366004605e565b600055565b005b600060208284031215606f57600080fd5b503591905056fea264697066735822122010a74f9187dc7391d7b8887a52082dee5456f7a700b0abfad5ee020598bbaf8264736f6c634300080f0033",
}


000 PUSH1 80
002 PUSH1 40
004 MSTORE
005 CALLVALUE
006 DUP1
007 ISZERO
008 PUSH2 0010
011 JUMPI
012 PUSH1 00
014 DUP1
015 REVERT
016 JUMPDEST
017 POP
018 PUSH2 0150
021 DUP1
022 PUSH2 0020
025 PUSH1 00
027 CODECOPY
028 PUSH1 00
030 RETURN
031 INVALID
032 PUSH1 80
034 PUSH1 40
036 MSTORE
037 CALLVALUE
038 DUP1
039 ISZERO
040 PUSH2 0010
043 JUMPI
044 PUSH1 00
046 DUP1
047 REVERT
048 JUMPDEST
049 POP
050 PUSH1 04
052 CALLDATASIZE
053 LT
054 PUSH2 0036
057 JUMPI
058 PUSH1 00
060 CALLDATALOAD
061 PUSH1 e0
063 SHR
064 DUP1
065 PUSH4 2e64cec1
070 EQ
071 PUSH2 003b
074 JUMPI
075 DUP1
076 PUSH4 6057361d
081 EQ
082 PUSH2 0059
085 JUMPI
086 JUMPDEST
087 PUSH1 00
089 DUP1
090 REVERT
091 JUMPDEST
092 PUSH2 0043
095 PUSH2 0075
098 JUMP
099 JUMPDEST
100 PUSH1 40
102 MLOAD
103 PUSH2 0050
106 SWAP2
107 SWAP1
108 PUSH2 00d9
111 JUMP
112 JUMPDEST
113 PUSH1 40
115 MLOAD
116 DUP1
117 SWAP2
118 SUB
119 SWAP1
120 RETURN
121 JUMPDEST
122 PUSH2 0073
125 PUSH1 04
127 DUP1
128 CALLDATASIZE
129 SUB
130 DUP2
131 ADD
132 SWAP1
133 PUSH2 006e
136 SWAP2
137 SWAP1
138 PUSH2 009d
141 JUMP
142 JUMPDEST
143 PUSH2 007e
146 JUMP
147 JUMPDEST
148 STOP
149 JUMPDEST
150 PUSH1 00
152 DUP1
153 SLOAD
*/
?>