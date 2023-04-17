<?php

namespace App\Models;

use App\Models\Profile;
use App\Models\Front\Cart\Cart;
use App\Models\Admin\Order\Order;
use Illuminate\Auth\Events\Verified;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\Admin\Customer\BillingAddress;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\VerificationNotification;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method static firstOrCreate(array $array)
 * @method static where(string $string, mixed $input)
 * @method static create(array $array)
 * @method static paginate(int $int)
 * @method static first()
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendEmailVerificationNotification($cart_id = null)
    {
        $this->notify(new VerificationNotification($cart_id));
    }
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
        $this->markEmailAsVerified();
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }
    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }
    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }
    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
