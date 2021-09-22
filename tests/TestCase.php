<?php

namespace Tests;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function pretendToBeStaff() {
        return $this->createUser(['staff' => '1']);
    }
    
    public function createUser($params=[]) {
        return User::factory()->create($params);
    }

    public function createStaff() {
        return Staff::create(['user_id' => $this->createUser()->id]);
    }
}
