
//SPDX-License-Identifier: UNLICENSED

pragma solidity ^0.8.15;
contract TestingStuff {

	uint public x;

    function f(uint a, uint b) public pure returns (uint) {
        return a * (b + 42);
    }
    
    function add() public {
        x = f(1, 4);
    }
}