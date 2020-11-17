<?php


namespace Appino\Blockchain\Interfaces;


abstract class ChartType{

    /**
     * Total Circulating Bitcoin
     * The total number of mined bitcoin that are currently circulating on the network.
     */
    const TotalCirculatingBitcoin = 'total-bitcoin';
    /**
     * Market Price
     * The average USD market price across major bitcoin exchanges.
     */
    const MarketPrice = 'market-price';
    /**
     * Market Capitalization (USD)
     * The total USD value of bitcoin in circulation.
     */
    const MarketCapitalization = 'market-cap';
    /**
     * Exchange Trade Volume (USD)
     * The total USD value of trading volume on major bitcoin exchanges.
     */
    const MarketExchangeTradeVolume = 'trade-volume';

    /**
     * Blockchain Size (MB)
     * The total size of the blockchain minus database indexes in megabytes.
     */
    const BlockchainSize = 'block-size';
    /**
     * Average Block Size (MB)
     * The average block size over the past 24 hours in megabytes.
     */
    const AverageBlockSize = 'avg-block-size';
    /**
     * Average Transactions Per Block
     * The average number of transactions per block over the past 24 hours.
     */
    const AverageTransactionsPerBlock = 'n-transactions-per-block';
    /**
     * Total Number of Transactions
     * The total number of transactions on the blockchain.
     */
    const TotalNumberofTransactions = 'n-transactions-total';
    /**
     * Median Confirmation Time
     * The median time for a transaction with miner fees to be included in a mined block and added to the public ledger.
     */
    const MedianConfirmationTime = 'median-confirmation-time';
    /**
     * Average Confirmation Time
     * The average time for a transaction with miner fees to be included in a mined block and added to the public ledger.
     */
    const AverageConfirmationTime = 'avg-confirmation-time';

    /**
     * Total Hash Rate (TH/s)
     * The estimated number of terahashes per second the bitcoin network is performing in the last 24 hours.
     */
    const TotalHashRate = 'hash-rate';
    /**
     * Hashrate Distribution
     * An estimation of hashrate distribution amongst the largest mining pools.
     */
    const HashrateDistribution = 'pools';
    /**
     * Hashrate Distribution Over Time
     * An estimation of hashrate distribution over time amongst the largest mining pools
     */
    const HashrateDistributionOverTime = 'pools-timeseries';
    /**
     * Network Difficulty
     * A relative measure of how difficult it is to mine a new block for the blockchain.
     */
    const NetworkDifficulty = 'difficulty';
    /**
     * Miners Revenue (USD)
     * Total value of coinbase block rewards and transaction fees paid to miners.
     */
    const MinersRevenue = 'miners-revenue';
    /**
     * Total Transaction Fees (BTC)
     * The total BTC value of all transaction fees paid to miners. This does not include coinbase block rewards.
     */
    const TotalTransactionFees = 'transaction-fees';
    /**
     * Total Transaction Fees (USD)
     * The total USD value of all transaction fees paid to miners. This does not include coinbase block rewards.
     */
    const TotalTransactionFeesUSD = 'transaction-fees-usd';
    /**
     * Fees Per Transaction (USD)
     * Average transaction fees in USD per transaction.
     */
    const FeesPerTransaction = 'fees-usd-per-transaction';
    /**
     * Cost % of Transaction Volume
     * A chart showing miners revenue as percentage of the transaction volume.
     */
    const CostPerTransactionPercent = 'cost-per-transaction-percent';
    /**
     * Cost Per Transaction
     * A chart showing miners revenue divided by the number of transactions.
     */
    const CostPerTransaction = 'cost-per-transaction';

    /**
     * Unique Addresses Used
     * The total number of unique addresses used on the blockchain.
     */
    const UniqueAddressesUsed = 'n-unique-addresses';
    /**
     * Confirmed Transactions Per Day
     * The total number of confirmed transactions per day.
     */
    const ConfirmedTransactionsPerDay = 'n-transactions';
    /**
     * Transaction Rate Per Second
     * The number of transactions added to the mempool per second.
     */
    const TransactionRatePerSecond = 'transactions-per-second';
    /**
     * Output Value Per Day
     * The total value of all transaction outputs per day. This includes coins returned to the sender as change.
     */
    const OutputValuePerDay = 'output-volume';
    /**
     * Mempool Transaction Count
     * The total number of unconfirmed transactions in the mempool.
     */
    const MempoolTransactionCount = 'mempool-count';
    /**
     * Mempool Size Growth
     * The rate at which the mempool is growing in bytes per second.
     */
    const MempoolSizeGrowth = 'mempool-growth';
    /**
     * Mempool Size (Bytes)
     * The aggregate size in bytes of transactions waiting to be confirmed.
     */
    const MempoolSize = 'mempool-size';
    /**
     * Mempool Bytes Per Fee Level
     * The current state of the mempool organized by bytes per fee level.
     */
    const MempoolBytesPerFeeLevel = 'mempool-state-by-fee-level';
    /**
     * Unspent Transaction Outputs
     * The total number of valid unspent transactions outputs. This excludes invalid UTXOs with opcode OP_RETURN
     */
    const UnspentTransactionOutputs = 'utxo-count';
    /**
     * Transactions Excluding Popular Addresses
     * The total number of transactions excluding those involving the network's 100 most popular addresses.
     */
    const TransactionsExcludingPopularAddresses = 'n-transactions-excluding-popular';
    /**
     * Estimated Transaction Value (BTC)
     * The total estimated value in BTC of transactions on the blockchain. This does not include coins returned as change.
     */
    const EstimatedTransactionValueBTC = 'estimated-transaction-volume';
    /**
     * Estimated Transaction Value (USD)
     * The total estimated value in USD of transactions on the blockchain. This does not include coins returned as change.
     */
    const EstimatedTransactionValueUSD = 'estimated-transaction-volume-usd';

    /**
     * Blockchain.com Wallets
     * The total number of unique Blockchain.com wallets created.
     */
    const BlockchainWallets = 'my-wallet-n-users';

    /**
     * Market Value to Realised Value
     * MVRV is calculated by dividing Market Value by Realised Value. In Realised Value, BTC prices are taken at the time they last moved, instead of the current price like in Market Value
     */
    const MarketValuetoRealisedValue = 'mvrv';
    /**
     * Network Value to Transactions
     * NVT is computed by dividing the Network Value (= Market Value) by the total transactions volume in USD over the past 24hour.
     */
    const NetworkValuetoTransactions = 'nvt';
    /**
     * Network Value to Transactions Signal
     * NVTS is a more stable measure of NVT, with the denominator being the moving average over the last 90 days of NVT's denominator
     */
    const NetworkValuetoTransactionsSignal = 'nvts';
}
