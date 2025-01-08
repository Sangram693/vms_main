<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'logo',
        'website',
        'company_type',
        'gst_number',
        'industry_type',
        'registration_number',
        'founded_date',
        'number_of_employees',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'founded_date' => 'date',
        'status' => 'boolean',
    ];

    /**
     * Define the relationship with the User model (Super Admin).
     * A company may have a super admin or related users.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Scope to filter active companies.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope to filter inactive companies.
     */
    public function scopeInactive($query)
    {
        return $query->where('status', false);
    }
}
