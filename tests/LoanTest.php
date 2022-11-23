<?php

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Exception\NoFeeException;
use PragmaGoTech\Interview\Exception\WrongTermException;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Service\Calculator;

class LoanTest extends TestCase
{
    public function testBreakPointFee()
    {
        $calculator = new Calculator();
        $loanProposal = new LoanProposal(24, 11000);
        $fee = $calculator->calculate($loanProposal);
        $this->assertEquals(440, $fee);
    }

    public function testSimpleFee()
    {
        $calculator = new Calculator();
        $loanProposal = new LoanProposal(12, 1500);

        $this->assertEquals(70, $calculator->calculate($loanProposal));
    }

    public function testEqualBreakPointsFee()
    {
        $calculator = new Calculator();
        $loanProposal = new LoanProposal(12, 3000);

        $this->assertEquals(90, $calculator->calculate($loanProposal));
    }

    public function testHighFee()
    {
        $calculator = new Calculator();
        $loanProposal = new LoanProposal(12, 18888);
        $this->assertEquals(360, $calculator->calculate($loanProposal));
    }

    public function testComplexFee()
    {
        $calculator = new Calculator();
        $loanProposal = new LoanProposal(24, 17649.01);
        $fee = $calculator->calculate($loanProposal);
        $this->assertTrue($fee > 680 && $fee < 720);
    }

    public function testNotDefinedTerm()
    {
        $this->expectException(WrongTermException::class);
        $loanProposal = new LoanProposal(36, 1500);
        $calculator = new Calculator();
        $calculator->calculate($loanProposal);
    }

    public function testTooLowLoan()
    {
        $this->expectException(NoFeeException::class);
        $loanProposal = new LoanProposal(12, 900);
        $calculator = new Calculator();
        $calculator->calculate($loanProposal);
    }

    public function testTooHighLoan()
    {
        $this->expectException(NoFeeException::class);
        $loanProposal = new LoanProposal(24, 21000);
        $calculator = new Calculator();
        $calculator->calculate($loanProposal);
    }
}