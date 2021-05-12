<?php

namespace Lit\Support;

class LitSitemapHelper extends LitHelper
{
    public function __construct()
    {

    }

    public function changefreq()
    {
        return [
            'never' => 'nigdy',
            'yearly' => 'raz w roku',
            'monthly' => 'raz w miesiącu',
            'weekly' => 'co tydzień',
            'daily' => 'co dziennie',
            'hourly' => 'co godzinę',
            'always' => 'zawsze',
        ];
    }
    public function priority()
    {
        return [
            '1.0' => '1.0',
            '0.9' => '0.9',
            '0.8' => '0.8',
            '0.7' => '0.7',
            '0.6' => '0.6',
            '0.5' => '0.5',
            '0.4' => '0.4',
            '0.3' => '0.3',
            '0.2' => '0.2',
            '0.1' => '0.1',
        ];
    }
}
