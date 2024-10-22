<?php
class TestOneIsOne extends Unit{

    // your test go here

    public function testOneIsOne()
    {
        $this->assert_equal(1, 1);
    }

    
} // all tests must be prefixed by 'test' and camelcased, else will be ignored