<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function loanType(){
        return $this->belongsTo(LoanType::class);
    }

    public function loanPlan(){
        return $this->belongsTo(LoanPlan::class);
    }

    public function payment(){
        return $this->hasMany(Payment::class);
    }
    public function loanSchedule(){
        return $this->hasMany(LoanSchedule::class);
    }
}