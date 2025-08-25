<?php
namespace Hossam\ActionsNextJs;

class Request
{
    public function getQuery()
    {
        return $_SERVER['QUERY_STRING'] ?? '';
    }
}
?>