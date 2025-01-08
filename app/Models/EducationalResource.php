<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalResource extends Model
{
    protected $table = 'educational_resources';
    protected $fillable = ['title', 'description', 'type', 'file_path', 'video_url'];
}
