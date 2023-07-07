<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D14;

use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;
use PHPUnit\Framework\TestCase;

final class OrthogonallyConnectedGroupFinderTest extends TestCase
{
    public function test find(): void
    {
        $given = Map::fromString(
            <<<EOF
            ##.#.#..####
            .#.#.#.####.
            ....#.#.##.#
            EOF,
        );

        $sut = OrthogonallyConnectedGroupFinder::find($given, Point::of(x: 8, y: 0));
        $actual = implode("\n------------\n", array_map(strval(...), iterator_to_array($sut)));
        self::assertSame(
            <<<MAP
                    #   
                        
                        
            ------------
                    ##  
                    #   
                        
            ------------
                    ### 
                   ###  
                    #   
            ------------
                    ####
                   #### 
                    ##  
            MAP,
            $actual,
        );

    }
}
