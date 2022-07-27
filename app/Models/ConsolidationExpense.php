<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsolidationExpense extends Model
{
    protected $fillable = ["budget_minus", "amount"];
    public $timestamps = false;
    use HasFactory;

}
