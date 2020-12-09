<?php

class SensitiveMaskUtils extends RocketTestCase
{
    /**
     * @see CLX6-258
     */
    public function testSensitiveMaskLeavesParamUntouched()
    {
        $o = new stdClass();
        $o->iban = '323';
        $o->password = 'asdf123';
        $x = [];
        $x['obj'] = $o;

        sensitive_mask_var($x);
        $this->assertSame('323', $x['obj']->iban);
    }
}
