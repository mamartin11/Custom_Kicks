<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_and_set_name()
    {
        $user = new User();
        $user->setName('Juan');
        $this->assertEquals('Juan', $user->getName());
    }

    /** @test */
    public function it_can_get_and_set_email()
    {
        $user = new User();
        $user->setEmail('test@example.com');
        $this->assertEquals('test@example.com', $user->getEmail());
    }

    /** @test */
    public function it_can_get_and_set_budget()
    {
        $user = new User();
        $user->setBudget(1000.50);
        $this->assertEquals(1000.50, $user->getBudget());
    }

    /** @test */
    public function it_can_get_and_set_role()
    {
        $user = new User();
        $user->setRole('admin');
        $this->assertEquals('admin', $user->getRole());
    }

    /** @test */
    public function it_knows_if_is_admin()
    {
        $user = new User();
        $user->setRole('admin');
        $this->assertTrue($user->isAdmin());
        $user->setRole('customer');
        $this->assertFalse($user->isAdmin());
    }

    /** @test */
    public function it_has_orders_relationship()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);
        $this->assertTrue($user->orders->contains($order));
    }
} 