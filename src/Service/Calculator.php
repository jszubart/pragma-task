<?php

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\Exception\EmptyFeeStructure;
use PragmaGoTech\Interview\Exception\NoFeeException;
use PragmaGoTech\Interview\Exception\WrongTermException;
use PragmaGoTech\Interview\FeeCalculator;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\DataProvider\FeeStructureProvider;

class Calculator implements FeeCalculator
{
    /**
     * @throws NoFeeException
     * @throws WrongTermException
     * @throws EmptyFeeStructure
     */
    public function calculate(LoanProposal $application): float
    {
        $term = $application->term();
        $amount = $application->amount();
        $fee = $this->processFeeValue($term, $amount);
        return round($fee/5) * 5;
    }

    private function processFeeValue(int $term, float $amount): float
    {
        if (!in_array($term, [12,24])) {
            throw new WrongTermException('Wrong term provided');
        }

        $feeStructure = FeeStructureProvider::getFeeStructure($term);
        if (empty($feeStructure)) {
            throw new EmptyFeeStructure('No fee structure defined');
        }

        $amountIsEqualToBreakPoint = array_search($amount, array_column($feeStructure, 'amount'));
        if ($amountIsEqualToBreakPoint !== false) {
            return (float) $feeStructure[$amountIsEqualToBreakPoint]['fee'];
        }

        $previousBreakPoint = $beforeBreakPoint = $afterBreakPoint = null;
        $previousFee = $feeBefore = $feeAfter = 0;
        $correctAmount = false;
        foreach ($feeStructure as $breakPointData) {
            $breakPointValue = $breakPointData['amount'];
            $breakPointFee = $breakPointData['fee'];
            if (is_null($previousBreakPoint)) {
                $previousBreakPoint = $breakPointValue;
                $previousFee = $breakPointFee;
                continue;
            }

            if ($amount > $previousBreakPoint && $amount < $breakPointValue) {
                $beforeBreakPoint = $previousBreakPoint;
                $feeBefore = $previousFee;
                $afterBreakPoint = $breakPointValue;
                $feeAfter = $breakPointFee;
                $correctAmount = true;
                break;
            }

            $previousBreakPoint = $breakPointValue;
            $previousFee = $breakPointFee;
        }

        if (!$correctAmount) {
            throw new NoFeeException('Fee cannot be calculated');
        }

        if ($feeBefore == $feeAfter) {
            return (float) $feeBefore;
        }

        $breakPointDifference = $afterBreakPoint - $beforeBreakPoint;


        $feeDifference = $feeAfter - $feeBefore;
        $breakPointsProportion = ($afterBreakPoint - $amount) / $breakPointDifference;
        return (float) $feeBefore + ($breakPointsProportion * $feeDifference);
    }
}