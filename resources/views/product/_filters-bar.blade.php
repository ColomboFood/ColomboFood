<div class="flex flex-col w-full py-2 mb-2 space-x-2 md:w-64 md:mb-auto" aria-label="Sidebar">

    <div class="flex flex-col">
        <div class="flex w-full">
            <x-input type="text" placeholder="{{ __('Search...') }}" wire:model.debounce.500ms="query" />
            <x-button>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </x-button>
        </div>
    </div>

    <div class="w-56 p-2 mt-4 space-y-6 bg-base-100">
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
                                wire:model="collection" value="{{ $menuBrand->slug }}">
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
