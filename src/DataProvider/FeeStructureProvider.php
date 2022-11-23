<?php

namespace PragmaGoTech\Interview\DataProvider;

class FeeStructureProvider
{
    public static function getFeeStructure(int $numberOfMonths): array
    {
        $feeStructure = [];
        if ($numberOfMonths == 12) {
            $feeStructure = [
                ['amount' => 1000, 'fee' => 50],
                ['amount' => 2000, 'fee' => 90],
                ['amount' => 3000, 'fee' => 90],
                ['amount' => 4000, 'fee' => 115],
                ['amount' => 5000, 'fee' => 100],
                ['amount' => 6000, 'fee' => 120],
                ['amount' => 7000, 'fee' => 140],
                ['amount' => 8000, 'fee' => 160],
                ['amount' => 9000, 'fee' => 180],
                ['amount' => 10000, 'fee' => 200],
                ['amount' => 11000, 'fee' => 220],
                ['amount' => 12000, 'fee' => 240],
                ['amount' => 13000, 'fee' => 260],
                ['amount' => 14000, 'fee' => 280],
                ['amount' => 15000, 'fee' => 300],
                ['amount' => 16000, 'fee' => 320],
                ['amount' => 17000, 'fee' => 340],
                ['amount' => 18000, 'fee' => 360],
                ['amount' => 19000, 'fee' => 380],
                ['amount' => 20000, 'fee' => 400],
            ];
        }

        if ($numberOfMonths == 24) {
            $feeStructure = [
                ['amount' => 1000, 'fee' => 70],
                ['amount' => 2000, 'fee' => 100],
                ['amount' => 3000, 'fee' => 120],
                ['amount' => 4000, 'fee' => 160],
                ['amount' => 5000, 'fee' => 200],
                ['amount' => 6000, 'fee' => 240],
                ['amount' => 7000, 'fee' => 280],
                ['amount' => 8000, 'fee' => 320],
                ['amount' => 9000, 'fee' => 360],
                ['amount' => 10000, 'fee' => 400],
                ['amount' => 11000, 'fee' => 440],
                ['amount' => 12000, 'fee' => 480],
                ['amount' => 13000, 'fee' => 520],
                ['amount' => 14000, 'fee' => 560],
                ['amount' => 15000, 'fee' => 600],
                ['amount' => 16000, 'fee' => 640],
                ['amount' => 17000, 'fee' => 680],
                ['amount' => 18000, 'fee' => 720],
                ['amount' => 19000, 'fee' => 760],
                ['amount' => 20000, 'fee' => 800],
            ];
        }

        return $feeStructure;
    }
}