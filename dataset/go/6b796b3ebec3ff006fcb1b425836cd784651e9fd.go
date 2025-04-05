func findFirstInvalidTxn(db *badger.DB, lowTs, highTs uint64) uint64 {
	checkAt := func(ts uint64) error {
		txn := db.NewTransactionAt(ts, false)
		_, err := seekTotal(txn)
		txn.Discard()
		return err
	}

	if highTs-lowTs < 1 {
		log.Printf("Checking at lowTs: %d\n", lowTs)
		err := checkAt(lowTs)
		if err == errFailure {
			fmt.Printf("Violation at ts: %d\n", lowTs)
			return lowTs
		} else if err != nil {
			log.Printf("Error at lowTs: %d. Err=%v\n", lowTs, err)
			return 0
		}
		fmt.Printf("No violation found at ts: %d\n", lowTs)
		return 0
	}

	midTs := (lowTs + highTs) / 2
	log.Println()
	log.Printf("Checking. low=%d. high=%d. mid=%d\n", lowTs, highTs, midTs)
	err := checkAt(midTs)
	if err == badger.ErrKeyNotFound || err == nil {
		// If no failure, move to higher ts.
		return findFirstInvalidTxn(db, midTs+1, highTs)
	}
	// Found an error.
	return findFirstInvalidTxn(db, lowTs, midTs)
}