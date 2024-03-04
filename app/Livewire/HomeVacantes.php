<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class HomeVacantes extends Component
{

    public $termino;
    public $categoria;
    public $salario;


    protected $listeners = ['terminosBusqueda' => 'buscar' ];

    public function buscar($termino, $categoria, $salario)
    {

        $this->termino = $termino;
        $this->categoria = $categoria;
        $this->salario = $salario;

        /* dd('Desde Componente Padre'); */
    }


    public function render()
    {
        /* Aqui consultamos a la bd para obtener las vacantes */
        /* $vacantes = Vacante::all(); */

        $vacantes = Vacante::when($this->termino, function($query){
            $query->where('titulo', 'LIKE', "%" . $this->termino . "%"); /* mientras hay el temrino de busqueda %% */
        })
        ->when($this->termino, function($query){
            $query->orwhere('empresa', 'LIKE', "%" . $this->termino . "%");
        })
        ->when($this->categoria, function($query){
            $query->where('categoria_id', $this->categoria);
        })
        ->when($this->salario, function($query){
            $query->where('salario_id', $this->salario);
        })
        ->get();
        
        return view('livewire.home-vacantes', [
            'vacantes' => $vacantes
        ]);
    }
}
