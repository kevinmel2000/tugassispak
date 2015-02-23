<?php

class ARFisType 
{
    public static $FIS_TSUKAMOTO = 0;
    public static $FIS_MAMDANI = 1;
    public static $FIS_SUGENO = 2;
    
    public static $MAMDANI_AND_METHOD_MIN = 11;
    public static $MAMDANI_AND_METHOD_PROD = 12;
    public static $MAMDANI_OR_METHOD_MAX = 13;
    public static $MAMDANI_OR_METHOD_PROBOR = 14;
    public static $MAMDANI_IMPLICATION_MIN = 15;
    public static $MAMDANI_IMPLICATION_PROD = 16;
    public static $MAMDANI_AGGREGATION_MAX = 17;
    public static $MAMDANI_AGGREGATION_SUM = 18;
    public static $MAMDANI_AGGREGATION_PROBOR = 19;
    public static $MAMDANI_DEFUZZIFICATION_CENTROID = 20;
    public static $MAMDANI_DEFUZZIFICATION_BISECTOR = 21;
    public static $MAMDANI_DEFUZZIFICATION_MOM = 22;
    public static $MAMDANI_DEFUZZIFICATION_LOM = 23;
    public static $MAMDANI_DEFUZZIFICATION_SOM = 24;
    
    public static $SUGENO_AND_METHOD_MIN = 51;
    public static $SUGENO_AND_METHOD_PROD = 52;
    public static $SUGENO_OR_METHOD_MAX = 53;
    public static $SUGENO_OR_METHOD_PROBOR = 54;
    public static $SUGENO_DEFUZZIFICATION_WVTAVER = 55;
    public static $SUGENO_DEFUZZIFICATION_WTSUM = 56;
    
    public static $TSUKAMOTO_AND_METHOD_MIN = 100;
    public static $TSUKAMOTO_AND_METHOD_PROD = 101;
    
    public static $TSUKAMOTO_OR_METHOD_MAX = 102;
    public static $TSUKAMOTO_OR_METHOD_PROBOR = 103;
    
    public static $TSUKAMOTO_DEFUZZIFICATION_WVTAVER = 111;
}

?>
