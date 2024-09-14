<?php

namespace MiniRoute\Controller;

use MiniRoute\Request;

class ArticleController
{

    public function getAll(Request $request)
    {

        print_r($request);
        print_r($request->getAttributes());

        return json_encode([
            ['id' => 1],
            ['id' => 2],
            ['id' => 3]
        ]);
    }
}
