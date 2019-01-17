<?php
/**
 * This file is part of the romanpitak/nginx-config-processor package.
 *
 * (c) Roman Piták <roman@pitak.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Effiana\Nginx\Config;

use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{

    public function testGetText()
    {
        $comment = new Comment('c');
        $this->assertEquals("c", $comment->getText());
    }

    public function testToString()
    {
        $comment = new Comment('c');
        $this->assertEquals("# c\n", (string) $comment);
    }

}
