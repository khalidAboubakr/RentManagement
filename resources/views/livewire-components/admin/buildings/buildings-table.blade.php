
<div>

    <div class="text-4xl font-bold text-center dark:text-white">{{ __('app.Buildings') }} ({{ $buildings->total() }})</div>

    <div class="bg-white shadow-md rounded my-6">
        @if ($header)
            <div class="flex items-center justify-between">

                <div class="py-5 px-2">
                    <button class="bg-indigo-800 px-5 py-3 text-sm shadow-sm font-medium tracking-wider border text-indigo-100 rounded-full hover:shadow-lg hover:bg-indigo-900 outline-none focus:outline-none" onclick="Livewire.emit('openCreateBuildingModal')">
                        {{ __('app.Add') }}
                    </button>
                </div>

                <div class="relative mx-6 my-2 overflow-hidden">
                    <input type="text" class="bg-purple-white shadow rounded border-0 p-3 pr-12 w-full outline-none focus:outline-none" placeholder="{{ __('app.Search') }}" wire:model.debounce.500ms="query">
                    <div class="absolute top-0 right-0 mt-3 mr-4 text-purple-lighter" wire:target="query" wire:loading.remove>
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="absolute top-0 right-0 mt-3 mr-4 text-purple-lighter" wire:target="query" wire:loading>
                        <i class="fas fa-spinner animate-spin"></i>
                    </div>
                </div>
            </div>
        @endif

        <div class="container mx-auto">
        <div class="flex flex-wrap -mx-4">

                    @forelse ($buildings as $building)
                     
<div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/4 p-4">
    <a href="#">
        <img class="p-8 rounded-t-lg" src="/{{$building->image}}" alt="صورة المبني" />
    </a>
    <div class="px-5 pb-5">
        <a href="#">
            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $building->name }}</h5>
        </a>

       

        <ul role="list" class="space-y-5 my-7">
        <li class="flex space-x-3">
               
            </li>
            <li class="flex space-x-3">
                <!-- Icon -->
                <span class="text-base font-bold leading-bold text-gray-500 dark:text-gray-400">{{ __('app.ID') }} :</span>
                <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">{{ $building->id }}</span>
            </li>
            <li class="flex space-x-3">
                <!-- Icon -->
                <span class="text-base font-bold leading-bold text-gray-500 dark:text-gray-400">{{ __('app.BuildingType') }} :</span>
                <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">
                @if ($building->buildingtype ==1)
                                    سكني
                                @endif
                                @if ($building->buildingtype ==2)
                                    تجاري
                                @endif
                                @if ($building->buildingtype ==3)
                                    أرض
                                @endif
                </span>
            </li>
            <li class="flex space-x-3">
                <!-- Icon -->
                <span class="text-base font-bold leading-bold text-gray-500 dark:text-gray-400">{{ __('app.Floors') }} :</span>
                <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">{{ $building->apartments_max_floor }}</span>
                
            </li>
            <li class="flex space-x-3">
                <!-- Icon -->
                <span class="text-base font-bold leading-bold text-gray-500 dark:text-gray-400">{{ __('app.Total Apartments') }} :</span>
                <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">{{ $building->apartments_count }}</span>
            </li>
            <!-- <li class="flex space-x-3">
                <span class="text-base font-bold leading-bold text-gray-500 dark:text-gray-400">{{ __('app.Has Basement') }}</span>
                <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">
                @if ($building->apartments->where('floor', 0)->count())
                              <i class="fas fa-check fa-lg text-green-600"></i>
                          @else
                              <i class="fas fa-times fa-lg text-red-600"></i>
                          @endif
                </span>
            </li> -->
            <li class="flex space-x-3">
                <!-- Icon -->
                <span class="text-base font-bold leading-bold text-gray-500 dark:text-gray-400">{{ __('app.Created At') }} :</span>
                <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">{{ $building->created_at }}</span>
            </li>
           
        </ul>
        <div class="flex items-center justify-center">
                              <a href="{{ route('admin.buildings.show', $building->id) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                  <i class="fas fa-eye"></i>
                              </a>
                              <button class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="Livewire.emit('openEditBuildingModal', {{ $building->id }})">
                                  <i class="fas fa-pen"></i>
                              </button>
                              <button class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="deleteBuilding({{ $building->id }})">
                                  <i class="fas fa-trash"></i>
                              </button>
                          </div>
    </div>
</div>

                    @empty
                        <tr><td class="py-3 px-6 text-center text-lg" colspan="20">{{ __('app.Nothing found') }}</td></tr>
                    @endforelse
                    </div>
                </div>

        <div class="p-5">
            {{ $buildings->links() }}
        </div>

        @livewire('admin.buildings.create-building')
        @livewire('admin.buildings.edit-building')

        @push('scripts')
            <script>
                const deleteBuilding = (buildingId) => {
                    Swal.fire({
                        title: "{{ __('app.Are you sure?') }}",
                        text: "{!! __('app.You wont be able to revert this!') !!}",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonText: "{{ __('app.Cancel') }}",
                            confirmButtonText: "{{ __('app.Yes, delete it!') }}",
                        showLoaderOnConfirm: true,
                        preConfirm: () => @this.call('destroyBuilding', buildingId),
                    })
                };
            </script>
        @endpush
    </div>
</div>
