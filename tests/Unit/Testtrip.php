<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class Testtrip extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_trip_store(): void
    {
        $requestData = [
            'destination' => 'test_destination',
            'status' => 'available',
            'start_date' => '2021-01-01',
            'end_date' => '2021-01-02',
            'max_participants' => 10,
            'price' => 100.50,
            'city' => 'test_city',
            'description' => 'test_description',
            
        ];
        

        $response = $this->post('/trip', $requestData);

        $this->assertTrue(true);
    }
}
