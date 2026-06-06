<?php

namespace Driyoagung\TesPackageLaravel\Tests\Feature;

use Driyoagung\TesPackageLaravel\Tests\TestCase;

class LandingPageTest extends TestCase
{
    public function test_landing_page_can_be_rendered(): void
    {
        $response = $this->get('/tes-package');

        $response
            ->assertOk()
            ->assertSee('Tes Package Laravel')
            ->assertSee('tes-package::landing');
    }
}
