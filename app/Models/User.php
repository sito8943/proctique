<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use InteractsWithMedia;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
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

    // Model relations
    public function projects()
    {
        return $this->hasMany(Project::class, 'author_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'author_id');
    }

    /**
     * Marks the user as deleted by updating the email to a unique
     * placeholder (to free the original for reuse) and soft-deleting
     * the user record.
     */
    public function markAsDeleted(): void
    {
        // Ensure unique email after deletion to avoid unique index conflicts
        $suffix = '__deleted__' . $this->id;
        $maxLen = 255; // default email column length
        $base = substr($this->email ?? '', 0, max(0, $maxLen - strlen($suffix)));
        $this->email = $base . $suffix;
        $this->save();

        // Soft delete the user
        $this->delete();
    }

    public function getImageUrl(string $conversion = 'preview'): string
    {
        if ($this->media->first()) {
            return $this->media->first()->getUrl($conversion);
        } else {
            return asset('img/placeholder.png');
        }
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Crop, 50, 50)
            ->nonQueued();

        $this
            ->addMediaConversion('website')
            ->fit(Fit::Crop, 200, 200)
            ->nonQueued();
    }
}
