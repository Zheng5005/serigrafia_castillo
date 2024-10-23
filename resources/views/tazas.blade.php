<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
            {{ __('Tazas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">

                <form action="{{ url('cars/createtazas') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="product_id" :value="__('ID del producto:')" />
                        <x-text-input id="product_id" class="block mt-1 w-full" type="text" name="product_id" :value="$product" readonly/>
                        <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                    </div>
                    <!-- Quantity -->
                    <div>
                        <x-input-label for="quantity" :value="__('Cantidad')" />
                        <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity')" />
                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Descripción')" />
                        
                        <!--<textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea> -->

                        <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" />

                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <br>

                    <!-- Image -->
                    <div>
                        <x-input-label for="Image" :value="__('Imagen')" />
                        <input type="file" name="Image">
                    </div>

                    <!-- Boton -->
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-3">
                            {{ __('Agregar') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>