<?php
/**
 *  kanellov/password-strength-validator.
 *
 * @link https://github.com/kanellov/password-strength-validator for the canonical source repository
 *
 * @copyright Copyright (c) 2017 International Labour Organization
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

namespace KnlvTest;

/**
 * Class PasswordStrengthFunctionTest
 * Test for password_strength function.
 */
class PasswordStrengthFunctionTest extends \PHPUnit_Framework_TestCase
{
    public function provider()
    {
        return array(
            array('password', PWD_CONTAIN_UC, null, true),
            array('password', PWD_CONTAIN_LC, null, false),
            array('Password', PWD_CONTAIN_UC, null, false),
            array('PASSWORD', PWD_CONTAIN_LC, null, true),
            array('password', PWD_CONTAIN_DGT, null, true),
            array('p4ssword', PWD_CONTAIN_DGT, null, false),
            array('password', PWD_CONTAIN_SYM, null, true),
            array('p@ssword', PWD_CONTAIN_SYM, null, false),
            array('password', PWD_CONTAIN_DGT_OR_SYM, null, true),
            array('p4ssword', PWD_CONTAIN_DGT_OR_SYM, null, false),
            array('p@ssowrd', PWD_CONTAIN_DGT_OR_SYM, null, false),
            array('password', PWD_CONTAIN_DGT | PWD_CONTAIN_SYM, null, true),
            array('p@ssw0rd', PWD_CONTAIN_DGT | PWD_CONTAIN_SYM, null, false),
            array('p@ssw0rd', PWD_CONTAIN_DGT | PWD_CONTAIN_SYM | PWD_CONTAIN_UC, null, true),
            array('P@ssw0rd', PWD_CONTAIN_DGT | PWD_CONTAIN_SYM | PWD_CONTAIN_UC, null, false),
            array('password!', PWD_CONTAIN_SYM, null, false),
            array('password!', PWD_CONTAIN_SYM, '!', true),
        );
    }

    /**
     * @dataProvider provider
     *
     * @param $password
     * @param $flags
     * @param $exclude_symbols
     * @param $exception_expected
     */
    public function test_password_strength($password, $flags, $exclude_symbols, $exception_expected)
    {
        if ($exception_expected) {
            $this->setExpectedException('\ErrorException');
        }
        \Knlv\password_strength($password, $flags, $exclude_symbols);
    }
}
