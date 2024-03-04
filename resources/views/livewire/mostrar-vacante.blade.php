<div class="p-10">
    <div class="mb-5">
        <h3 class="font-bold text-lg text-gray-800 my-3 text-center">
            Puesto: {{ $vacante->titulo }}
        </h3>
        
        <div class="text-center  p-4">
            <p class="font-bold text-sm uppercase text-gray-800 my-5">Empresa:
                <span class="normal-case font-normal">{{ $vacante->empresa }}</span>
            </p>
            <hr>
            <p class="font-bold text-sm uppercase text-gray-800 my-5">Último día para postularse:
                <span class="normal-case font-normal">{{ Carbon\Carbon::parse( $vacante->ultimo_dia)->toFormattedDateString() }}</span>
            </p>
            <hr>
            <p class="font-bold text-sm uppercase text-gray-800 my-5">Categoria:
                <span class="normal-case font-normal">{{ $vacante->categoria ->categoria}}</span>
            </p>
            <hr>
            <p class="font-bold text-sm uppercase text-gray-800 my-5">Salario:
                <span class="normal-case font-normal">{{ $vacante->salario->salario }}</span>
            </p>
            <hr>
        </div>
    </div>

    <div class="md:grid md:grid-cols-6 gap-4 ">
        {{-- Imagen --}}
        {{-- <div class="md:col-span-2">
            <img src="{{ asset('storage/vacantes/' . $vacante->imagen) }}" alt="{{ 'Imagen vacante' .$vacante->titulo }}">
        </div> --}}

        {{-- Descripcion --}}
        <div class="md:col-span-4">
            <h2 class="text-2xl font-bold mb-5">Descripción del Puesto</h2>
            <p>{{ $vacante->descripcion }}</p>
        </div>
    </div>

    @guest
        <div class="mt-5 bg-gray-50 border border-dashed p-5 text-center">
            <p>
                ¿Deseas aplicar a esta vacante? <a href="{{route('register')}}" class="font-bold text-indigo-600">Crear una nueva cuenta para aplicar a muchas vacantes</a>
            </p>
        </div>
    @endguest

    @cannot('create', App\Models\Vacante::class)
        <livewire:postular-vacante :vacante="$vacante" />
    @endcannot

    
    

</div>
