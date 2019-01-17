<?php

/**
 * This file is part of the Nginx Config Processor package.
 *
 * (c) Roman Piták <roman@pitak.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Effiana\Nginx\Config;

/**
 * Class EmptyLine
 * @package Effiana\Nginx\Config
 */
class EmptyLine extends Printable
{
    /**
     * @param Text $configString
     * @return EmptyLine
     */
    public static function fromString(Text $configString)
    {
        $configString->gotoNextEol();
        return new self;
    }

    /**
     * @param $indentLevel
     * @param int $spacesPerIndent
     * @return string
     */
    public function prettyPrint($indentLevel, $spacesPerIndent = 4)
    {
        return "\n";
    }
}