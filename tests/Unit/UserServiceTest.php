<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_user_details()
    {
        $user = User::factory()->create();

        $request = new Request(
            [
                'id' => $user->id,
                'user_name' => 'John Doe',
                'user_email' => 'john@example.com',
                'user_phone' => '1234567890',
                'user_password' => 'password123',
            ]
        );

        /** @var User $userMock */
        $userMock = Mockery::mock(User::class)->makePartial();
        $userMock->shouldReceive('save')->once();

        $userService = new UserService();
        $updated = $userService->updateUserData($request, $userMock);

        $this->assertTrue($updated);
        $this->assertEquals('John Doe', $userMock->name);
        $this->assertEquals('john@example.com', $userMock->email);
        $this->assertEquals('1234567890', $userMock->phone);
        $this->assertTrue(Hash::check('password123', $userMock->password));
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
