<?php

// Santiago Rodriguez
// Miguel Angel Martinez

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * ATTRIBUTES
     * $this->attributes['id'] - int - contains the user primary key (id)
     * $this->attributes['name'] - string - contains the user name
     * $this->attributes['email'] - string - contains the user email
     * $this->attributes['email_verified_at'] - timestamp - contains the user email verification date
     * $this->attributes['password'] - string - contains the user password
     * $this->attributes['budget'] - float - contains the user budget
     * $this->attributes['role'] - string - contains the user role (admin/customer)
     * $this->attributes['remember_token'] - string - contains the remember token
     * $this->attributes['created_at'] - timestamp - contains the user creation date
     * $this->attributes['updated_at'] - timestamp - contains the user update date
     *
     * RELATIONS
     * $this->orders - HasMany - contains the orders placed by this user
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'budget',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Boot function - sets default role based on email domain
     */
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($user) {
            $user->role = str_contains($user->email, '@customkicks.com') ? 'admin' : 'customer';
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Validate user data
     */
    public static function validate($request): void
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'budget' => 'nullable|numeric|min:0',
            'role' => 'nullable|in:admin,customer',
        ]);
    }

    /**
     * Get user ID
     */
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    /**
     * Get user name
     */
    public function getName(): string
    {
        return $this->attributes['name'];
    }

    /**
     * Set user name
     */
    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    /**
     * Get user email
     */
    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    /**
     * Set user email
     */
    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    /**
     * Get user budget
     */
    public function getBudget(): float
    {
        return $this->attributes['budget'] ?? 0.0;
    }

    /**
     * Set user budget
     */
    public function setBudget(float $budget): void
    {
        $this->attributes['budget'] = $budget;
    }

    /**
     * Get user role
     */
    public function getRole(): string
    {
        return $this->attributes['role'];
    }

    /**
     * Set user role
     */
    public function setRole(string $role): void
    {
        $this->attributes['role'] = $role;
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->getRole() === 'admin';
    }

    /**
     * Get user's orders
     *
     * @return HasMany Orders placed by this user
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get orders for this user
     */
    public function getOrders()
    {
        return $this->orders;
    }
}
