<?php
use PHPUnit\Framework\TestCase;

class TerrainLevelingTest extends TestCase {

    public function testExample1() {
        $this->assertMinimumForArea(["10", "31"], 2);
    }

    public function testExample2() {
        $this->assertMinimumForArea(["54454", "61551"], 7);
    }

    public function testExample3() {
        $this->assertMinimumForArea(["989"], 0);
    }
    
    public function testExample4() {
        $this->assertMinimumForArea(["90"], 8);
    }
    
    public function testExample5() {
        $this->assertMinimumForArea(["5781252", "2471255", "0000291", "1212489"], 53);
    }

    private function assertMinimumForArea(array $area, int $expectedMinimum) {
        $leveling = new TerrainLeveling();
        $this->assertEquals($expectedMinimum, $leveling->getMinimum($area));
    }
}