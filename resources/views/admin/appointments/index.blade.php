<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Appointments') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                @forelse ($appointments as $appointment)
                    <div class="item-card flex flex-row justify-between items-center">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($appointment->product->thumbnail) }}" alt=""
                                class="rounded-2xl object-cover w-[90px] h-[90px]">
                            <div class="flex flex-col">
                                <h3 class="text-indigo-950 text-xl font-bold">{{ $appointment->name }}</h3>
                            </div>
                        </div>
                        <div class="hidden md:flex flex-col">
                            <p class="text-slate-500 text-sm">Budget</p>
                            <h3 class="text-indigo-950 text-xl font-bold"> ${{ number_format($appointment->budget, 0, ',', '.') }}</h3>
                        </div>
                        <div class="hidden md:flex flex-col">
                            <p class="text-slate-500 text-sm">Date</p>
                            <h3 class="text-indigo-950 text-xl font-bold">
                                {{ $appointment->created_at->format('M d, Y') }}
                            </h3>
                        </div>
                        <div class="hidden md:flex flex-row items-center gap-x-3">
                            <a href="{{ route('admin.appointments.show', $appointment) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                                Details
                            </a>
                        </div>
                    </div>
                @empty
                    <p>Belum ada data terbaru</p>
                @endforelse
                {{-- pagination --}}
                {{ $appointments->links() }}
            </div>
        </div>
    </div>
</x-app-layout>