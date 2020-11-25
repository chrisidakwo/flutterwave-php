All notable changes to ``flutterwave-php`` will be documented in this file.

## 0.1.0 - 2020-08-04

- Initial release with standard payment, verify transaction, and refund transaction implemented.

## 0.1.1 - 2021-09-04

- Added new features:
  - Enable transactions with credit/debit cards
  - Handle card transaction authorization processes
  - Added charge validation for validating bank account and/or debit/credit card transactions
  - Added `encryptTransactionData()` function to encrypt transaction charge data
  - Moved `ChrisIdakwo\Support\Entity` to a new namespace `ChrisIdakwo\Support\Entities\Entity`
  - Added entity classes to support easy typing of response objects
  - Cleaned up codebase
