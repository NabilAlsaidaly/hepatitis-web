<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    protected $primaryKey = 'User_ID';

    protected $fillable = ['Name', 'Email', 'Password', 'Role_ID'];

    protected $hidden = ['Password', 'remember_token'];

    // ✅ تشفير كلمة المرور تلقائيًا عند تعيينها
    public function setPasswordAttribute($value)
    {
        $this->attributes['Password'] = Hash::make($value);
    }

    // ✅ العلاقة مع جدول الأدوار
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'Role_ID');
    }

    // ✅ العلاقة مع المرضى (للطبيب فقط)
    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class, 'Doctor_ID');
    }

    // ✅ تحديد الحقل المستخدم لتسجيل الدخول
    public function getAuthPassword()
    {
        return $this->Password;
    }

    // ✅ دالة لحساب الأحرف الأولى من الاسم
    public function initials(): string
    {
        $name = $this->Name ?? '';
        $parts = explode(' ', $name);
        $initials = '';
        foreach ($parts as $part) {
            $initials .= strtoupper(mb_substr($part, 0, 1));
        }
        return $initials ?: 'D'; // D = Default fallback
    }
}
