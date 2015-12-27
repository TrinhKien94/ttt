<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class testSearch extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_search()
    {
        $this->get('/search')
            -> type('aaa mạnh',  'search_text')
            -> press('Tìm kiếm');
    }
}
