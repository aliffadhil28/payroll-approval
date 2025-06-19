<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payroll extends Model
{
    protected $table = 'payrolls';
    protected $fillable = ['user_id','basic_salary','payment_date','created_at','updated_by'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
