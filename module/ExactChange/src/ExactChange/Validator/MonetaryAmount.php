<?php
namespace ExactChange\Validator;

class MonetaryAmount extends \Zend\Validator\AbstractValidator {

    const MSG_INVALID_CHAR              = 'msgInvalidChar';
    const MSG_VALID_CHAR_WRONG_POSITION = 'msgValidCharWrongPosition';
    const MSG_MISSING_VALUE             = 'msgMissingValue';
    const MSG_FORMAT_INVALID            = 'msgFormatInvalid';
    const MSG_MISSING_DECIMAL_PLACE     = 'msgMissingDecimal';

    public $minimum     = 1;
    public $maximum     = 90;

    protected $messageVariables = array(
        'min' => 'minimum',
    );

    protected $messageTemplates = array(
        self::MSG_INVALID_CHAR              => "Invalid characters found in '%value%'",
        self::MSG_VALID_CHAR_WRONG_POSITION => "Valid character in wrong position in '%value%'",
        self::MSG_MISSING_VALUE             => "Missing value in '%value%'",
        self::MSG_MISSING_DECIMAL_PLACE     => "Missing decimal place in '%value%'. E.g, £23.00",
//        self::MSG_FORMAT_INVALID            => "The currency format you have provided is invalid",
    );

    public function isValid($str) {
//        $valid = true;
        $this->setValue($str);

        // Check for invalid characters
        if (preg_match('/[^p0-9.,£]/i', $str)) {
            $this->error(self::MSG_INVALID_CHAR);
            return false;
        }

        // Check for missing value
        if (!preg_match('/[0-9]/', $str))
        {
            $this->error(self::MSG_MISSING_VALUE);
            return false;
        }

        // Check for £ in wrong position
        if (preg_match('/\d[£]/', $str))
        {
            $this->error(self::MSG_VALID_CHAR_WRONG_POSITION);
            return false;
        }

        // Check for p in wrong position
        $pattern = '/ [p]\d | [p][£] | [p][.] | [p][,] | [p][p] /';
        if (preg_match(str_replace(' ', '', $pattern), $str))
        {
            $this->error(self::MSG_VALID_CHAR_WRONG_POSITION);
            return false;
        }

        // Check for inclusion of decimal in value with £ prefix and p suffix
        $pattern = '/ (?=^£) /';
        if (preg_match(str_replace(' ', '', $pattern), $str))
        {
            if(preg_match('/p\z/i', $str))
            {
                if(!preg_match('/\.\d{1,2}/', $str))
                {
                    $this->error(self::MSG_MISSING_DECIMAL_PLACE);
                    return false;
                }
            }
        }

//        // Check overall format
//        $pattern = '/^ (£|[£])? (?!0\.00) \d{1,3}(,\d{3}) * (\.\d\d)? [p]? /';
//        if (!preg_match(str_replace(' ', '', $pattern), $str))
//        {
//            $this->error(self::MSG_FORMAT_INVALID);
//            return false;
//        }

        return true;
    }
}