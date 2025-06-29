<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'ktp_photo',
        'ktp_selfie_photo',
        'verification_status',
        'verified_at',
        'verification_notes',
        'verification_submitted_at',
        'phone',
        'address',
        'picture',
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
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'verified_at' => 'datetime',
        'verification_submitted_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Scope untuk filter berdasarkan status verifikasi
     */
    public function scopeVerificationStatus($query, $status)
    {
        return $query->where('verification_status', $status);
    }

    /**
     * Scope untuk user yang pending verifikasi
     */
    public function scopePendingVerification($query)
    {
        return $query->where('verification_status', 'pending')
                    ->whereNotNull('verification_submitted_at')
                    ->orderBy('verification_submitted_at', 'asc');
    }

    /**
     * Scope untuk user yang sudah diverifikasi
     */
    public function scopeVerified($query)
    {
        return $query->where('verification_status', 'approved');
    }

    /**
     * Scope untuk user yang ditolak
     */
    public function scopeRejected($query)
    {
        return $query->where('verification_status', 'rejected');
    }

    /**
     * Check apakah user sudah submit dokumen verifikasi
     */
    public function hasSubmittedVerification()
    {
        return !is_null($this->ktp_photo) && !is_null($this->ktp_selfie_photo);
    }

    /**
     * Check apakah user sudah terverifikasi
     */
    public function isVerified()
    {
        return $this->verification_status === 'approved';
    }

    /**
     * Check apakah verifikasi user pending
     */
    public function isPendingVerification()
    {
        return $this->verification_status === 'pending' && $this->hasSubmittedVerification();
    }

    /**
     * Check apakah verifikasi user ditolak
     */
    public function isRejected()
    {
        return $this->verification_status === 'rejected';
    }

    /**
     * Get full URL for KTP photo
     */
    public function getKtpPhotoUrlAttribute()
    {
        return $this->ktp_photo ? asset('storage/' . $this->ktp_photo) : null;
    }

    /**
     * Get full URL for KTP selfie photo
     */
    public function getKtpSelfiePhotoUrlAttribute()
    {
        return $this->ktp_selfie_photo ? asset('storage/' . $this->ktp_selfie_photo) : null;
    }

    /**
     * Get verification status badge color for UI
     */
    public function getVerificationBadgeColorAttribute()
    {
        return match($this->verification_status) {
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            default => 'secondary'
        };
    }

    /**
     * Get verification status text in Indonesian
     */
    public function getVerificationStatusTextAttribute()
    {
        return match($this->verification_status) {
            'pending' => 'Waiting for verification',
            'approved' => 'Verified',
            'rejected' => 'Rejected',
            default => 'Not submitted yet.'
        };
    }
}
