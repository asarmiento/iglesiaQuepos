<?php

namespace SistemasAmigables\Entities;


class Expense extends Entity
{
    protected $timestamp;

    protected $fillable= ['invoiceNumber','invoiceDate','date','detail','amount','check_id','departament_id','imagen'];

    public function getRules()
    {
        return [
            'invoiceNumber'  =>'required',
            'invoiceDate'    =>'required',
            'date'           =>'required',
            'amount'         =>'required',
            'check_id'       =>'required',
            'departament_id' =>'required',
            'detail'         =>'required'
        ];
    }

    public function departaments()
    {
        return $this->belongsTo(Departament::getClass(),'departament_id','id');
    }

    public function typeExpenses()
    {
        return $this->belongsToMany(TypeExpense::getClass(),'expense_typeExpense')->withPivot('balance');
    }
    public function getExist()
    {
        // TODO: Implement getExist() method.
    }
}
