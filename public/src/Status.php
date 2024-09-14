<?php

declare(strict_types=1);

namespace MiniRoute;

enum Status: string
{
    case OK = 'OK';
    case BAD_REQUEST = 'BAD REQUEST';

    const NO_ROUTE = 404;
    const METHOD_NOT_ALLOWED = 405;
}
