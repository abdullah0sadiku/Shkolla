<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'text', 'photo', 'user_id', 'user_name',
    ];
    

    protected static function booted(): void
    {
        // Listen to the "deleted" event
        self::deleted(function (Media $media) {
            // Get the photo path from the database
            $filePath = public_path('storage/' . $media->photo);

            // Check if the file exists
            if (File::exists($filePath)) {
                // Delete the file
                File::delete($filePath);
                logger()->info('File deleted successfully:', ['path' => $filePath]);
            } else {
                logger()->warning('File does not exist at path:', ['path' => $filePath]);
            }
        });
    }



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
