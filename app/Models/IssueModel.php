<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueModel extends Model
{
    use HasFactory;

    protected $table = 'issue';
    protected $fillable = [
        'project_id', 'subject', 'description', 'due_date', 'status_id', 'category_id',
    ];
}
