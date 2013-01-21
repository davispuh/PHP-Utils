<?php

class Utilities {

    Static Public Function RemoveDoubleWhitespace($ParameterText) {
        $ReturnValue = $ParameterText;
        $Replaced = False;
        Do {
            $ReturnValue = Str_IReplace('  ', ' ', $ReturnValue);
            If (SubStr_Count($ReturnValue, '  ') === 0) {
                $Replaced = True;
            };
        } While ($Replaced === False);
        Return $ReturnValue;
    }

    Static Public Function ShiftLeft($Number, $Bits) {
        //return bcmul($Number, bcpow('2', $Bits));
        return gmp_mul($Number, gmp_pow(2, $Bits));
    }

    Static Public Function ShiftRight($Number, $Bits) {
        //return bcdiv($Number, bcpow('2', $Bits));
        return gmp_div($Number, gmp_pow(2, $Bits));
    }

    Static Public Function BitwiseOR($Number1, $Number2) {
        return gmp_or($Number1, $Number2);
    }

    Static Public Function BitwiseAND($Number1, $Number2) {
        return gmp_and($Number1, $Number2);
    }

    Static Public Function BitSet($Number, $Bit) {
        if (is_resource($Number) !== true) {
            $Number = gmp_init($Number);
        };
        gmp_setbit($Number, $Bit - 1, true);
        return $Number;
    }

    Static Public Function BitClear($Number, $Bit) {
        if (is_resource($Number) !== true) {
            $Number = gmp_init($Number);
        };
        gmp_setbit($Number, $Bit - 1, false);
        return $Number;
    }

    Static Public Function BitTest($Number, $Bit) {
        if (is_resource($Number) !== true) {
            $Number = gmp_init($Number);
        };
        return gmp_testbit($Number, $Bit - 1);
    }

    Static Public Function GetStrVal($Number) {
        return gmp_strval($Number);
    }

    Static Public Function GetIntVal($Number) {
        return gmp_intval($Number);
    }

    Static Function GetDateTime($DateTime = NULL) {
        if ($DateTime === NULL) {
            $DateTime = 'now';
        };
        return new \DateTime($DateTime);
    }

    Static Function GetInterval($Period) {
        return new \DateInterval($Period);
    }

    Static Function ParseDateInterval(\DateInterval $DateInterval) {
        $Seconds = 0;
        $Seconds+= $DateInterval->y * 60 * 60 * 24 * 365;
        $Seconds+= $DateInterval->m * 60 * 60 * 24 * 30;
        $Seconds+= $DateInterval->d * 60 * 60 * 24;
        $Seconds+= $DateInterval->h * 60 * 60;
        $Seconds+= $DateInterval->i * 60;
        $Seconds+= $DateInterval->s;
        return $Seconds;
    }

    Static Function CreateTime($Time) {
        $Result = NULL;
        $Hour = 0;
        $Minute = 0;
        $Second = 0;
        $Milisecond = 0;
        $ParsedTime = Explode(':', $Time);
        if (Count($ParsedTime) > 1) {
            $Hour = (int) Trim($ParsedTime[0]);
            if (Count($ParsedTime) > 1) {
                $Minute = (int) Trim($ParsedTime[1]);
            };
            if (Count($ParsedTime) > 2) {
                $Second = (int) Trim($ParsedTime[2]);
            };
            if (Count($ParsedTime) > 3) {
                $Milisecond = (int) Trim($ParsedTime[3]);
            };
            $Result = $Hour . ':' . $Minute . ':' . $Second . ':' . $Milisecond;
        };
        return $Result;
    }

    Static Function CreateDate($Date) {
        $Result = NULL;
        $Day = 0;
        $Month = 0;
        $Year = 0;
        $ParsedDate = Explode('/', $Date);
        if (Count($ParsedDate) <= 1) {
            $ParsedDate = Explode('-', $Date);
        };
        if (Count($ParsedDate) <= 1) {
            $ParsedDate = Explode('.', $Date);
        };
        if (Count($ParsedDate) > 1) {
            $Day = IntVal(Trim($ParsedDate[0]));
            if (Count($ParsedDate) > 1) {
                $Month = IntVal(Trim($ParsedDate[1]));
            };
            if (Count($ParsedDate) > 2) {
                $Year = IntVal(Trim($ParsedDate[2]));
            };
            $Result = $Day . '.' . $Month;
        };
        return $Result;
    }

    Static Function FormatDateInterval($DateInterval) {
        $Seconds = self::ParseDateInterval($DateInterval);
        $Hours = floor($Seconds / 3600);
        $Minutes = floor(($Seconds / 60) % 60);
        $Text = str_pad($Hours, 2, "0", STR_PAD_LEFT) . ":" . str_pad($Minutes, 2, "0", STR_PAD_LEFT) . ":" . str_pad($Seconds % 60, 2, "0", STR_PAD_LEFT);
        return $Text;
    }

    Static Function FormatNumber($Number, $Sep = ' ') {
        if (is_numeric($Number)) {
            return number_format($Number, 0, ',', $Sep);
        };
        return '';
    }

    Static Function CompareMax($Number1, $Number2) {
        if ($Number1 >= $Number2)
            return 0;
        return -1;
    }

    Static Function UIntersectArrayMerge($Array1, $Array2, $CompareFunction) {
        $ResultArray = Array_UIntersect_Assoc($Array1, $Array2, $CompareFunction) + $Array2;
        KSort($ResultArray);
        return $ResultArray;
    }

    Public Static Function GetValue($Array, $Value1 = NULL, $Value2 = NULL, $Value3 = NULL, $Value4 = NULL) {
        $Result = $Array;
        if (Is_Array($Array) === True) {
            if ($Value4 !== NULL) {
                $Result = $Array[$Value1][$Value2][$Value3][$Value4];
            } elseif ($Value3 !== NULL) {
                if (Key_Exists($Value1, $Array) === True) {
                    if (Is_Array($Array[$Value1]) === True) {
                        $Result = $Array[$Value1][$Value2][$Value3];
                    };
                };
            } elseif ($Value2 !== NULL) {
                if (Key_Exists($Value1, $Array) === True) {
                    if (Is_Array($Array[$Value1]) === True) {
                        if (Key_Exists($Value2, $Array[$Value1]) === True) {
                            $Result = $Array[$Value1][$Value2];
                        }
                    } else {
                        $Result = $Array[$Value1];
                    }
                }
            } elseif ($Value1 !== NULL) {
                if (Key_Exists($Value1, $Array) === True) {
                    $Result = $Array[$Value1];
                };
            } else {
                $Result = NULL;
            }
        };
        return $Result;
    }

    Public Static Function GetOrFirst($Key, $Array) {
        if (empty($Key) || array_key_exists($Key, $Array) === false) {
            reset($Array);
            $Key = key($Array);
        };
        return $Key;
    }

    Public Static Function IsValidFQDN($FQDN) {
        return (!empty($FQDN) && preg_match('/(?=^.{1,254}$)(^(?:(?!\d|-)[a-z0-9\-]{1,63}(?<!-)\.)+(?:[a-z]{2,})$)/i', $FQDN) > 0);
    }

    Public Static Function ParseURL($URL) {
        $Parsed = parse_url($URL);
        $URL = new stdClass();
        $URL->Scheme = isset($Parsed['scheme']) ? $Parsed['scheme'] : null;
        $URL->Host = isset($Parsed['host']) ? $Parsed['host'] : null;
        $URL->Port = isset($Parsed['port']) ? $Parsed['port'] : null;
        $URL->User = isset($Parsed['user']) ? $Parsed['user'] : null;
        $URL->Pass = isset($Parsed['pass']) ? $Parsed['pass'] : null;
        $URL->Path = isset($Parsed['path']) ? $Parsed['path'] : '';
        $URL->Query = isset($Parsed['query']) ? $Parsed['query'] : '';
        $URL->Fragment = isset($Parsed['fragment']) ? $Parsed['fragment'] : '';
        return $URL;
    }

    Public Static Function ParseQuery($QueryString) {
        $Parameters = Array();
        parse_str($QueryString, $Parameters);
        return $Parameters;
    }

    Public Static Function GetHost($URL) {
        $Parsed = parse_url($URL);
        if ($Parsed && !empty($Parsed)) {
            return $Parsed['host'];
        }
        return null;
    }

    Public Static Function QueryFirstResult($Result) {
        if (!empty($Result) and Count($Result) > 0) {
            return $Result[0];
        };
        return null;
    }

    Public Static Function NormalizeIP($IP) {
        $PackedIP = inet_pton($IP);
        if (!$PackedIP or empty($PackedIP)) {
            return false;
        };
        return inet_ntop($PackedIP);
    }

}
