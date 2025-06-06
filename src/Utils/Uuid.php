<?php


namespace Ufo\DoctrineHelper\Utils;

class Uuid
{
    /**
     * @return string
     */
    public static function generate(): string
    {
        return \Ramsey\Uuid\Uuid::uuid7()->toString();
    }

    /**
     * @param $name
     * @return string
     */
    public static function hash($name): string
    {
        return \Ramsey\Uuid\Uuid::uuid3(\Ramsey\Uuid\Uuid::NAMESPACE_OID, $name)->toString();
    }

}