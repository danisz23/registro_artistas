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
        'email',
        'password',
        'role', // Agregar aquí
    ];
// Métodos de ayuda para roles
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isRegionalAdmin(): bool
    {
        return $this->role === 'regional_admin';
    }

    public function isArtistIndividual(): bool
    {
        return $this->role === 'artist_individual';
    }

    public function isArtistColectivo(): bool
    {
        return $this->role === 'artist_colectivo';
    }
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
    public function solicitudIndividual()
    {
        return $this->hasOne(SolicitudArtistaIndividual::class);
    }

    public function artistaIndividual()
    {
        return $this->hasOne(ArtistaIndividual::class);
    }
}
