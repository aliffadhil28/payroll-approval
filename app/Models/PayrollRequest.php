<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollRequest extends Model
{
    protected $table = 'payroll_request';
    protected $fillable = ['payroll_id','bonus','status','payment_slip','created_by','updated_by','processed_by'];

    public function payroll(){
        return $this->belongsTo(Payroll::class, 'payroll_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by','id');
    }
}
