<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Statistics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg"> 
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="py-3 w-full rounded-3xl bg-red-500 text-white">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif       
                <form method="POST" action="{{route('admin.statistics.update', $statistic)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" 
                          value="{{$statistic->name}}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="icon" :value="__('icon')" />
                        <img src="{{Storage::url($statistic->icon)}}" alt="" class="rounded-2xl object-cover w-[90px] h-[90px]">
                        <x-text-input id="icon" class="block mt-1 w-full" type="file" name="icon" autofocus autocomplete="icon" />
                        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="goal" :value="__('goal')" />
                        <x-text-input id="goal" class="block mt-1 w-full" type="text" name="goal" 
                        value="{{$statistic->goal}}" required autofocus autocomplete="goal" />
                        <x-input-error :messages="$errors->get('goal')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
            
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update Statistic
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>