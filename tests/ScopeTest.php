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

class ScopeTest extends TestCase
{

    public function testFromFile()
    {
        $nginxTmpFile = '/tmp/nginx-config-out.conf';
        Scope::fromFile('tests/test_input.conf')->saveToFile($nginxTmpFile);
        $this->assertEquals(@file_get_contents('tests/test_input.conf'), @file_get_contents('' . $nginxTmpFile . ''));
        @unlink($nginxTmpFile);
    }

    /**
     * @expectedException \Effiana\Nginx\Config\Exception
     */
    public function testSaveToFile()
    {
        $scope = new Scope();
        $scope->saveToFile('this/path/does/not/exist.conf');
    }

    public function testCreate()
    {
        $config_string = (string) Scope::create()
            ->addDirective(Directive::create('server')
                ->setChildScope(Scope::create()
                    ->addDirective(Directive::create('listen', 8080))
                    ->addDirective(Directive::create('server_name', 'example.net'))
                    ->addDirective(Directive::create('root', 'C:/www/example_net'))
                    ->addDirective(Directive::create('location', '^~ /var/', Scope::create()
                        ->addDirective(Directive::create('deny', 'all'))
                    )->setCommentText('Deny access for location /var/')
                    )
                )
            )->__toString();
        $this->assertEquals($config_string, @file_get_contents('tests/scope_create_output.conf'));
    }

}
