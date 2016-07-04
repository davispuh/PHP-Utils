## PHP Utils

Several PHP functions.
Hopefully will be useful for someone...

**Table of Contents**

- [Implemented functions](#implemented-functions)
- [Authors](#authors)
- [Unlicense](#unlicense)
- [Contribute](#contribute)

## Implemented functions

`Utilities.php`
* `Utilities::RemoveDoubleWhitespace($Text)`
* `Utilities::ShiftLeft($Number, $Bits)`
* `Utilities::ShiftRight($Number, $Bits)`
* `Utilities::BitwiseOR($Number1, $Number2)`
* `Utilities::BitwiseAND($Number1, $Number2)`
* `Utilities::BitSet($Number, $Bit)`
* `Utilities::BitClear($Number, $Bit)`
* `Utilities::BitTest($Number, $Bit)`
* `Utilities::GetStrVal($Number)`
* `Utilities::GetIntVal($Number)`
* `Utilities::GetDateTime($DateTime = NULL)`
* `Utilities::ParseDateInterval(\DateInterval $DateInterval)`
* `Utilities::CreateTime($Time)`
* `Utilities::CreateDate($Date)`
* `Utilities::FormatDateInterval($DateInterval)`
* `Utilities::FormatNumber($Number, $Sep = ' ')`
* `Utilities::CompareMax($Number1, $Number2)`
* `Utilities::UIntersectArrayMerge($Array1, $Array2, $CompareFunction)`
* `Utilities::GetValue($Array, $Value1 = NULL, $Value2 = NULL, $Value3 = NULL, $Value4 = NULL)`
* `Utilities::GetOrFirst($Key, $Array)`
* `Utilities::IsValidFQDN($FQDN)`
* `Utilities::ParseURL($URL)`
* `Utilities::ParseQuery($QueryString)`
* `Utilities::GetHost($URL)`
* `Utilities::QueryFirstResult($Result)`
* `Utilities::NormalizeIP($IP)`

## Authors

Currently everything (all functions, files, text) in this repository are made by me @davispuh and I've dedicated this repository to public domain.

## Unlicense

All text, documentation, code and files in this repository are in public domain (including this text, README).
It means you can copy, modify, distribute and include in your own work/code, even for commercial purposes, all without asking permission.

## Contribute

Feel free to improve existing functions or add new ones which might be usefull.


**Warning**: By sending pull request to this repository you dedicate any and all copyright interest in pull request (code files and all other) to the public domain. (files will be in public domain even if pull request doesn't get merged)

Also before sending pull request you acknowledge that you own all copyrights or have authorization to dedicate them to public domain.

If you don't want to dedicate code to public domain or if you're not allowed to (eg. you don't own required copyrights) then DON'T send pull request.


