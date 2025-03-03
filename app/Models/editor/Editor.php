<?php

namespace App\Models\editor;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Editor extends Authenticatable
{
      /** @use HasFactory<\Database\Factories\UserFactory> */
      use HasFactory, Notifiable, HasRoles;
      protected $guard_name  ='editor';

      /**
       * The attributes that are mass assignable.
       *
       * @var list<string>
       */
      protected $fillable = [
        'username',
        'name',
        'address',
        'contact',
        'email',
        'password',
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
}
