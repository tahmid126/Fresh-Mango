<?php

namespace App\Models;


use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',  
        'phone', 
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    
    public function seller()
    {
        return $this->hasOne(Seller::class);
    }

    
    public function canAccessPanel(Panel $panel): bool
    {
       
        if ($panel->getId() === 'admin') {
            
            return $this->role === 'admin';
        }

        
        if ($panel->getId() === 'seller') {
           
            return $this->role === 'seller' && $this->seller && $this->seller->status === 'approved';
        }

        
        return false;
    }
}