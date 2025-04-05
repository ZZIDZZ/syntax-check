def on_receive_transactions(self, proto, transactions):
        "receives rlp.decoded serialized"
        log.debug('----------------------------------')
        log.debug('remote_transactions_received', count=len(transactions), remote_id=proto)

        def _add_txs():
            for tx in transactions:
                self.add_transaction(tx, origin=proto)
        gevent.spawn(_add_txs)