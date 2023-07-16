<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_user_details()
    {
        Config::set('database.default', 'mysql_test');
        $user = User::query()->create(
            [
                'name' => 'John Doe Test',
                'email' => 'john' . rand(0, 150000) . '@example_test' . rand(0, 150000) . '.com',
                'phone' => '1234567890',
                'password' => 'password123',
            ]
        );

        $request = new Request(
            [
                'id' => $user->id,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '1234567890',
                'password' => 'password123',
            ]
        );

        /** @var User $userMock */
        $userMock = Mockery::mock(User::class)->makePartial();
        $user->delete();
        $userMock->shouldReceive('save')->once();

        $userService = new UserService();
        $updated = $userService->updateUserData($request, $userMock);
        $this->assertTrue($updated);
        $this->assertEquals('John Doe', $userMock->name);
        $this->assertEquals('john@example.com', $userMock->email);
        $this->assertEquals('1234567890', $userMock->phone);
        $this->assertTrue(Hash::check('password123', $userMock->password));
    }

    /** @test */
    public function it_creates_user()
    {
        Config::set('database.default', 'mysql_test');

        $request = new Request(
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '1234567890',
                'password' => 'password123',
            ]
        );

        $userService = new UserService();
        $createdUser = $userService->createUser($request);

        $this->assertInstanceOf(User::class, $createdUser);
        $this->assertEquals('John Doe', $createdUser->name);
        $this->assertEquals('john@example.com', $createdUser->email);
        $this->assertEquals('1234567890', $createdUser->phone);
        $this->assertTrue(Hash::check('password123', $createdUser->password));
        $deleted = $userService->deleteUser($createdUser->id);
        $this->assertTrue($deleted);
        $deletedUser = User::find($createdUser->id);
        $this->assertNull($deletedUser);
    }

    /** @test */
    public function it_deletes_user_by_id()
    {
        Config::set('database.default', 'mysql_test');
        $user = User::create(
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '1234567890',
                'password' => bcrypt('password123'),
            ]
        );

        $userService = new UserService();
        $deleted = $userService->deleteUser($user->id);
        $this->assertTrue($deleted);
        $deletedUser = User::find($user->id);
        $this->assertNull($deletedUser);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
