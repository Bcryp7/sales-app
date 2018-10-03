<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function getCategoryData($overrides = []) : array {

        return array_merge([

            'name' => 'Category 1',
            'description' => 'Just a description for Category 1.',
            'status' => 1,

        ], $overrides);

    }

}
