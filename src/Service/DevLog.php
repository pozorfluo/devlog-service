<?php

namespace App\Service;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

class DevLog
{
    /**
     * @var array <string, mixed>[] [$field_name => $value]
     */
    private static $data;
    private static $cloner;
    private static $dumper;

    public function __construct()
    {
        if (self::$cloner === null) {
            self::$cloner = new VarCloner();
        }
        if (self::$dumper === null) {
            self::$dumper = new HtmlDumper();
        }
    }

    /**
     * Return property value.
     */
    public function __get($property)
    {
        return self::$data[$property];
    }

    public function log(string $name, $variable)
    {
        self::$data[$name] = self::$dumper->dump(
            self::$cloner->cloneVar($variable), true
        );
    }

    public function getData()
    {
        return self::$data;
    }
}
