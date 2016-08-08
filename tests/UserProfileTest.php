<?php

use App\City;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UserProfileTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function it_can_have_basic_fields()
    {
        $city = factory(City::class)->create();
        $user = factory(User::class)->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'gender' => 'male',
            'birth_date' => Carbon::createFromFormat('Y-m-d', '1991-09-20'),
            'city_id' => $city->id,
            'website' => 'https://example.org',
        ]);

        $this->assertEquals('John Doe', $user->full_name);
        $this->assertEquals('male', $user->gender);
        $this->assertEquals($city->name, $user->city_name);
        $this->assertEquals('https://example.org', $user->website);
        $this->assertEquals('20.09.1991', $user->birth_date->format('d.m.Y'));
    }
}
