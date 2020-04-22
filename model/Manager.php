<?php
namespace Keen\Blog;

abstract class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO(
            'mysql:host=localhost;dbname=cours;charset=utf8', 'root', '',
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
        );

        return $db;
    }

}