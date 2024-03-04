<?php

namespace App\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    use WithFileUploads;
    
    public $cv;
    public $vacante;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function postularme()
    {

        //Variable de validacion Almacenar CV 
        $datos = $this->validate();

        // Almacenar el CV
        $cv= $this->cv->store('public/cv');
        $datos['cv'] = str_replace('public/cv/', '', $cv);


        // Crear la vacante
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $datos['cv']
        ]);

        // Crear notificacion y enviar el email
        $this->vacante->reclutador->notify( new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id) ); // metodo que notifica al usuario


        //Mostrar al usuario un mensaje de ok
        session()->flash('mensaje', 'Se envió correctamente, Mucha Suerte!');
        
        return redirect()->back(); 
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}