<?php

class Gasto extends \Eloquent {
    use SoftDeletingTrait;
    // Add your validation rules here
    public static $rules = [
        'num_factura' => 'required',
        'date' => 'required',
        'datefactura' => 'required',
        'monto' => 'required',
        'descripcion' => 'required',
        'departamentos_id' => 'required',
        'cheques_id' => 'required',
    ];
    // Don't forget to fill this array
    protected $fillable = ['num_factura', 'date', 'datefactura', 'monto', 'descripcion', 'departamentos_id','cheques_id'];

    public function departamento() {

        return $this->HasMany('Departamento','id','departamentos_id');
    }
  public function cheque() {

        return $this->HasMany('Cheque','id','cheques_id');
    }
}
