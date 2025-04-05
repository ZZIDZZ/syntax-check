public function generateRoll($rollSummary): Roll2d6DrdPlus
    {
        $rollSummary = ToInteger::toInteger($rollSummary);
        $bonusDiceRolls = [];
        $malusDiceRolls = [];
        if ($rollSummary <= 2) { // two ones = malus rolls and one "not valid" malus roll
            $standardDiceRolls = [new Dice1d6Roll(1, 1), new Dice1d6Roll(1, 2)]; // two ones = malus rolls
            $sequenceNumber = 3;
            for ($malusRollsCount = 2 - $rollSummary, $malusRollNumber = 1; $malusRollNumber <= $malusRollsCount; $malusRollNumber++) {
                /** @noinspection PhpUnhandledExceptionInspection */
                $malusDiceRolls[] = new Dice1d6DrdPlusMalusRoll(\random_int(1, 3), $sequenceNumber); // malus roll is valid only in range 1..3
                $sequenceNumber++;
            }
            /** @noinspection PhpUnhandledExceptionInspection */
            $malusDiceRolls[] = new Dice1d6DrdPlusMalusRoll(\random_int(4, 6), $sequenceNumber); // last malus roll was not "valid" - broke the chain
        } elseif ($rollSummary < 12) {
            $randomRange = 12 - $rollSummary; // 1..11
            $firstRandomMinimum = 6 - $randomRange;
            if ($firstRandomMinimum < 1) {
                $firstRandomMinimum = 1;
            }
            $firstRandomMaximum = $rollSummary - $firstRandomMinimum;
            /** @noinspection PhpUnhandledExceptionInspection */
            $firstRoll = \random_int($firstRandomMinimum, $firstRandomMaximum);
            $secondRoll = $rollSummary - $firstRoll;
            $firstDiceRoll = new Dice1d6Roll($firstRoll, 1);
            $secondDiceRoll = new Dice1d6Roll($secondRoll, 2);
            $standardDiceRolls = [$firstDiceRoll, $secondDiceRoll];
        } else { // two sixes = bonus rolls and one "not valid" bonus roll
            $standardDiceRolls = [new Dice1d6Roll(6, 1), new Dice1d6Roll(6, 2)];
            $sequenceNumber = 3;
            for ($bonusRollsCount = $rollSummary - 12, $bonusRollNumber = 1; $bonusRollNumber <= $bonusRollsCount; $bonusRollNumber++) {
                /** @noinspection PhpUnhandledExceptionInspection */
                $bonusDiceRolls[] = new Dice1d6DrdPlusBonusRoll(\random_int(4, 6), $sequenceNumber); // bonus roll is valid only in range 4..6
                $sequenceNumber++;
            }
            /** @noinspection PhpUnhandledExceptionInspection */
            $bonusDiceRolls[] = new Dice1d6DrdPlusBonusRoll(\random_int(1, 3), $sequenceNumber); // last bonus roll was not "valid" - broke the chain
        }

        return $this->createRoll($standardDiceRolls, $bonusDiceRolls, $malusDiceRolls);
    }