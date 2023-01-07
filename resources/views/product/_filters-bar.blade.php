<div x-data="{
    open: false
}" x-on:click.outside="open=false">
    <div class="px-6 lg:hidden">
        <x-secondary-button x-on:click="open=true">
            <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="14px" viewBox="0 0 18 14">
                <g id="Group_36196" data-name="Group 36196" transform="translate(-925 -1122.489)">
                    <path id="Path_22590" data-name="Path 22590"
                        d="M942.581,1295.564H925.419c-.231,0-.419-.336-.419-.75s.187-.75.419-.75h17.163c.231,0,.419.336.419.75S942.813,1295.564,942.581,1295.564Z"
                        transform="translate(0 -169.575)" fill="currentColor"></path>
                    <path id="Path_22591" data-name="Path 22591"
                        d="M942.581,1951.5H925.419c-.231,0-.419-.336-.419-.75s.187-.75.419-.75h17.163c.231,0,.419.336.419.75S942.813,1951.5,942.581,1951.5Z"
                        transform="translate(0 -816.512)" fill="currentColor"></path>
                    <path id="Path_22593" data-name="Path 22593"
                        d="M1163.713,1122.489a2.5,2.5,0,1,0,1.768.732A2.483,2.483,0,0,0,1163.713,1122.489Z"
                        transform="translate(-233.213)" fill="currentColor"></path>
                    <path id="Path_22594" data-name="Path 22594"
                        d="M2344.886,1779.157a2.5,2.5,0,1,0,.731,1.768A2.488,2.488,0,0,0,2344.886,1779.157Z"
                        transform="translate(-1405.617 -646.936)" fill="currentColor"></path>
                </g>
            </svg><span class="ml-1">{{ __('Filters') }}</span>
        </x-secondary-button>
    </div>

    <div aria-label="Sidebar" @class([
            'flex flex-col items-start py-2 max-w-xs w-full transition transform origin-left ease-in-out duration-300',
            'fixed top-0 pt-20 px-6 pb-6 left-0 z-10 bg-secondary-50 h-screen overflow-y-auto overflow-x-hidden',
            'lg:translate-x-0 lg:w-64 lg:flex lg:relative lg:items-start lg:overflow-visible lg:left-auto lg:px-auto lg:pt-12 lg:z-0 lg:pb-auto lg:top-auto lg:bg-transparent',
        ])  
        :class="{ '-translate-x-full': !open, 'translate-x-0': open }"
        x-cloak
    >
        <div class="flex justify-start w-full lg:hidden">
            <button
                class="flex items-center justify-center px-2 py-2 mb-6 text-lg transition-opacity cursor-pointer active:-translate-x-1 focus:outline-none hover:opacity-60"
                aria-label="close" x-on:click="open=false"><svg stroke="currentColor" fill="currentColor"
                    stroke-width="0" viewBox="0 0 512 512" class="text-brand-dark" height="1em" width="1em"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="48"
                        d="M244 400L100 256l144-144M120 256h292"></path>
                </svg>
            </button>
        </div>

        <div class="flex flex-col">
            <div class="flex">
                <x-input class="w-full lg:w-36" type="text" placeholder="{{ __('Search...') }}"
                    wire:model.debounce.500ms="query" />
                <x-button class="">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </x-button>
            </div>
        </div>

        <div class="w-48 p-2 mt-4 space-y-6">
            @if ($categories->count())
                <div class="space-y-2">
                    <div class="mb-2 font-bold">{{ __('Categories') }}</div>
                    @foreach ($categories->where('parent_id', null) as $category1)
                        <div class="pl-2 text-sm" x-data="{
                            open: @js($openMenus->contains($category1->name))
                        }">
                            <div
                                class="flex items-center justify-between cursor-pointer {{ $openMenus->contains($category1->name) ? 'font-semibold' : '' }}"]>
                                <span wire:click="toggleCategory('{{ $category1->slug }}')"
                                    x-on:click="open=true">{{ $category1->name }}</span>
                                @if ($categories->filter(fn($c) => $c->parent_id == $category1->id)->count())
                                    <div class="grid w-6 h-6 place-items-center" x-cloak x-show="open"
                                        x-on:click="open=!open">
                                        <x-icons.chevron-right class="w-4 h-4 transform -rotate-90" />
                                    </div>
                                    <div class="grid w-6 h-6 place-items-center" x-cloak x-show="!open"
                                        x-on:click="open=!open">
                                        <x-icons.chevron-right class="w-4 h-4 transform rotate-90" />
                                    </div>
                                @endif
                            </div>
                            <div class="pl-4" x-show="open">
                                @foreach ($categories->where('parent_id', $category1->id) as $category2)
                                    <div
                                        class="flex items-center justify-between cursor-pointer {{ $openMenus->contains($category2->name) ? 'font-semibold' : '' }}">
                                        <span
                                            wire:click="toggleCategory('{{ $category2->slug }}')">{{ $category2->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if ($collections->count())
                <div class="space-y-2">
                    <div class="mb-2 font-bold">{{ __('Collections') }}</div>
                    <div class="flex flex-col px-2">
                        @foreach ($collections as $menuCollection)
                            <label
                                class="flex items-center justify-between py-1 text-sm cursor-pointer group last:pb-1 first:pt-1">
                                <span class="">{{ $menuCollection->name }}</span>
                                <input type="checkbox"
                                    class="w-4 h-4 transition duration-300 ease-in-out border-2 cursor-pointer form-checkbox text-primary-500 focus:ring-offset-0 hover:border-primary-600 focus:outline-none focus:ring-0 focus-visible:outline-none checked:bg-primary-500"
                                    wire:model="collection" value="{{ $menuCollection->slug }}">
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($brands->count())
                <div class="space-y-2">
                    <div class="mb-2 font-bold">{{ __('Brands') }}</div>
                    <div class="flex flex-col px-2">
                        @foreach ($brands as $menuBrand)
                            <label
                                class="flex items-center justify-between py-1 text-sm cursor-pointer group last:pb-1 first:pt-1">
                                <span class="">{{ $menuBrand->name }}</span>
                                <input type="checkbox"
                                    class="w-4 h-4 transition duration-300 ease-in-out border-2 cursor-pointer form-checkbox text-primary-500 focus:ring-offset-0 hover:border-primary-600 focus:outline-none focus:ring-0 focus-visible:outline-none checked:bg-primary-500"
                                    wire:model="brand" value="{{ $menuBrand->slug }}">
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($this->isSetFilters())
                <div class="grid place-items-center">
                    <x-secondary-button wire:click="resetFilters">{{ __('Clear filters') }}</x-secondary-button>
                </div>
            @endif

        </div>
    </div>

</div>