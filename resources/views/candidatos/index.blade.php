<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Candidatos Vacante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-bold">
                    <h1 class="text-4xl font-bold text-center my-10">Candidatos Vacante : 
                        {{$vacante->titulo}}</h1>
                    
                    <div class="md:flex md:justify-center p-5">
                        <ul class="divide-y divide-gray-200 w-full">
                            @forelse ($vacante->candidatos as $candidato)
                                <li class="p-3 flex items-center">
                                    <div class="flex-1">
                                        <p class="text-xl font-medium text-gray-800">{{ $candidato->user->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $candidato->user->email}}</p>
                                        <p class="text-sm font-medium text-gray-600">
                                            Día que se postuló: <span class="font-normal"> {{ $candidato->created_at->diffForHumans()}} </span>
                                        </p>
                                    </div>
                                    <div>
                                        <a href="{{asset('storage/cv/' . $candidato->cv)}}" 
                                        class="inlibe-flex items-center shadow-sm px-2.5 py-0.5 border-gray-300 text-sm leading-5 font-medium rounded-full
                                        text-gray-700 bg-inherit-white hover:bg-gray-50"
                                        target="_blank"
                                        rel="noreferrer noopener"
                                        >
                                            Ver CV <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m-6 3.75 3 3m0 0 3-3m-3 3V1.5m6 9h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                                              </svg>
                                              
                                        </a>
                                    </div>
                                </li>
                            @empty
                                <p class="p-3 text-center text-sm text-gray-600">No hay candidatos aún</p>
                            @endforelse
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
