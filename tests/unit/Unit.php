<?php
/**
 * This is the superclass for the unit tests to be run before the code is committed to the repository.
 * 
 */

class Unit
{

    /**
     * Asserts that the given value is true.
     *
     * @param  mixed  $value  The value to check if true.
     * @return bool           True if the assertion passes, false otherwise.
     */
    protected function assert_true($value): bool
    {
        if ($value) {
            return true;
        } else {
            throw new Error('Value is not true');
        }
    }

    /**
     * Asserts that the given value is false.
     *
     * @param  mixed  $value  The value to check if false.
     * @return bool           True if the assertion passes, false otherwise.
     */
    protected function assert_false($value): bool
    {
        if (!$value) {
            return true;
        } else {
            throw new Error('Value is not false');
        }
    }

    /**
     * Asserts that the given value is null.
     *
     * @param  mixed  $value  The value to check if null.
     * @return bool           True if the assertion passes, false otherwise.
     */
    protected function assert_null($value): bool
    {
        if ($value === null) {
            return true;
        } else {
            throw new Error('Value is not null');
        }
    }


    /**
     * Asserts that the given values are equal.
     *
     * @param  mixed  $value1  The first value to check.
     * @param  mixed  $value2  The second value to check.
     * @return bool           True if the assertion passes, false otherwise.
     */
    protected function assert_equal($value1, $value2): bool
    {
        if ($value1 === $value2) {
            return true;
        } else {
            throw new Error('Values are not equal');
        }
    }


    /**
     * Asserts that the given values are not equal.
     * 
     * @param  mixed  $value1  The first value to check.
     * @param  mixed  $value2  The second value to check.
     * @return bool           True if the assertion passes, false otherwise.
     */
    protected function assert_not_equal($value1, $value2): bool
    {
        if ($value1 !== $value2) {
            return true;
        } else {
            throw new Error('Values are equal');
        }
    }

    /**
     * Asserts that the given values are of the same type.
     * 
     * @param  mixed  $value1  The first value to check.
     * @param  mixed  $value2  The second value to check.
     * @return bool           True if the assertion passes, false otherwise.
     */
    protected function assert_type($value1, $value2): bool
    {
        if (gettype($value1) === gettype($value2)) {
            return true;
        } else {
            throw new Error('Values are not of the same type');
        }
    }   
    
    
    /**
     * Runs all the test methods in this class and prints out the results.
     * 
     * @return void
     */
    public function start_test()
    {
        $tests = get_class_methods($this);
        $test_count = 0;
        $passed = 0;

   

        foreach ($tests as $test) {
            if (substr($test, 0, 4) === 'test') {

                $test_count++;

                try {
                    $this->$test();
                    $passed++;
                    echo "[PASS] ($passed/$test_count) $test\n";
                    
                } catch (Error $e) {
                    echo "[FAIL] ($passed/$test_count) $test: ";
                    echo $e->getMessage();
                    echo "\n";
                }
            }
        }

        
        
    }
}