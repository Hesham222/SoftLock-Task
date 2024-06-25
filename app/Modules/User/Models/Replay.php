<?php

namespace User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Replay extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function deletedBy()
    {
        return $this->belongsTo('Admin\Models\Admin', 'deleted_by')->withTrashed();
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }
}
