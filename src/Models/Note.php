<?php

namespace Driyoagung\TesPackageLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'tes_package_notes';

    protected $fillable = [
        'title',
        'content',
    ];
}
