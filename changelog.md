All notable changes to ``flutterwave-php`` will be documented in this file.

## 0.1.0 - 2020-08-04

- Initial release with standard payment, verify transaction, and refund transaction implemented.


## 0.1.1 - 2020-11-25

- Added support for these services:
  - Bank account payment, transfer, and verification
  - BVN verification
  - Debit card preauthorization charge, cancellation, and refund 
  - Moved validators into a new namespace
  - Refactored Transaction entity. Added extra fields to allow the class to be easily used to format responses from other services with similar response JSON structure.
  - Added a few tests. Others pending.

  
## 0.1.2 - 2021-09-04

- Added new features:
  - Enable transactions with credit/debit cards
  - Handle card transaction authorization processes
  - Added charge validation for validating bank account and/or debit/credit card transactions
  - Added `encryptTransactionData()` function to encrypt transaction charge data
  - Moved `ChrisIdakwo\Support\Entity` to a new namespace `ChrisIdakwo\Support\Entities\Entity`
  - Added entity classes to support easy typing of response objects
  - Cleaned up codebase
