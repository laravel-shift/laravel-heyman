<?php

namespace Imanghafoori\HeyMan\Situations;

use Imanghafoori\HeyMan\YouShouldHave;

class SituationsProxy
{
    const situations = [
        RouteSituations::class,
        ViewSituations::class,
        EloquentSituations::class,
        EventSituations::class,
    ];

    public static function call($method, $args)
    {
        $args = is_array($args[0]) ? $args[0] : $args;
        foreach (self::situations as $className) {
            if (method_exists($className, $method) || app($className)->hasMethod($method)) {
                app($className)->$method(...$args);

                return app(YouShouldHave::class);
            }
        }
    }
}