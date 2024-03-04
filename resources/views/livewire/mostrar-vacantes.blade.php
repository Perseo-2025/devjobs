<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        
        @if (count($vacantes) > 0)
            
            @foreach ($vacantes as $vacante )
                <div class="p-6 text-gray-900 bg-white border-b border-gray-200 
                        md:flex md:justify-between md:items-center">

                    <div class="space-y-3 gap-3 mb-10 md:w-1/2">
                        <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-xl font-bold">
                            {{ $vacante->titulo}}
                        </a>
                        <br><hr>
                        <p class="text-sm text-gray-600 font-bold">Empresa: {{$vacante->empresa}}</p>
                        <p class="text-sm text-gray-500">Último día: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
                    </div>

                    <div class="flex text-center items-center mt-5 md:w-1/2 gap-10 mx-10">
                        <a href="{{route('candidatos.index', $vacante)}}"
                            class="bg-gray-800 py-2 
                            px-4 rounded-lg text-white text-xs font-bold uppercase"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        {{-- Create (candidatos)--}}
                        {{$vacante->candidatos->count()}}
                        </a>  
                        <a href="{{ route('vacantes.edit', $vacante->id) }}"
                            class="bg-gray-800 py-2 
                            px-4 rounded-lg text-white text-xs font-bold uppercase"
                        >
                        {{-- Edit --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        </a>    

                        <button 
                            wire:click="$dispatch('mostrarAlerta', {{ $vacante->id }})"
                            class="bg-red-800 py-2
                            px-4 rounded-lg text-white text-xs font-bold uppercase"
                        >
                        {{-- Delete --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                          
                        </button>      
                    </div>       
                    
                </div>
            @endforeach

        @else
            <div class="md:flex justify-center">
                <p class="p-3 text-center text-xs text-gray-600 uppercase items-center">¡Sin vacantes!</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                </svg>   
            </div>  
        @endif

        <div class="flex-justify-center mt-10">
            {{$vacantes->links()}}
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('mostrarAlerta', (vacanteId) => {
                Swal.fire({
                    title: '¿Eliminar Vacante?',
                    text: "Una Vacante eliminada no se puede recuperar:(",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // ELiminar vacante
                        @this.call('eliminarVacante',vacanteId);
                        Swal.fire(
                            'Se eliminó la Vacante',
                            'Eliminado correctamente',
                            'success'
                        )
                    }
                })
 
            });
        });
    </script> 
@endpush

