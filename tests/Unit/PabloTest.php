<?php
class PabloTest extends \PHPUnit_Framework_TestCase{

public function test_probar_que_dos_mas_dos_es_4(){
    
    $res = 2 + 2;
    $this->assertEquals(4,$res);
}

}