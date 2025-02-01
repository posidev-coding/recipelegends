<x-filament-panels::page>

    <div class="space-y-4">

        <div class="flex items-center space-x-8 text-sm -mt-4">
            <div>Submitted by&nbsp;<span class="font-bold">{{ $recipe->user->name }}</span></div>
            <div>Updated on {{ $recipe->updated_at->toFormattedDateString() }}</div>
        </div>

        <div class="flex border-t border-gray-400"></div>

        <div class="grid grid-cols-3 gap-2">

            <div class="flex flex-col space-y-2">
                <div class="font-semibold tracking-tight uppercase text-sm text-sky-600">Prep</div>
                <div class="text-sm text-gray-600">{{ $recipe->prep_time ?? 'n/a' }}</div>
            </div>

            <div class="flex flex-col space-y-2">
                <div class="font-semibold tracking-tight uppercase text-sm text-sky-600">Cook</div>
                <div class="text-sm text-gray-600">{{ $recipe->cook_time ?? 'n/a' }}</div>
            </div>

            <div class="flex flex-col space-y-2">
                <div class="font-semibold tracking-tight uppercase text-sm text-sky-600">Total</div>
                <div class="text-sm text-gray-600">-</div>
            </div>

        </div>

        <div class="grid grid-cols-3 gap-2">

            <div class="flex flex-col space-y-2">
                <div class="font-semibold tracking-tight uppercase text-sm text-sky-600">Serves</div>
                <div class="text-sm text-gray-600">{{ $recipe->servings ?? 'n/a' }}</div>
            </div>

            <div class="flex flex-col space-y-2">
                <div class="font-semibold tracking-tight uppercase text-sm text-sky-600">Makes</div>
                <div class="text-sm text-gray-600">{{ $recipe->yield ?? 'n/a' }}</div>
            </div>

        </div>

        <div class="flex border-t border-gray-400"></div>

        @if ($preview)
            <img class="h-auto max-w-full" src="{{ $preview }}" />
        @endif

        <div class="flex border-b border-gray-400 pt-4"></div>

        <p class="text-xl font-bold tracking-wide py-2 text-sky-600">
            Ingredients
        </p>

        @forelse ($recipe->ingredients as $ingredient)
            @if ($ingredient['type'] == 'heading')
                <p class="font-semibold uppercase text-sm tracking-wider pt-2">
                    {{ $ingredient['data']['content'] }}</p>
            @else
                <div class="flex items-center space-x-4">
                    <x-filament::input.checkbox />
                    <div>{{ $ingredient['data']['content'] }}</div>
                </div>
            @endif
        @empty
            <p class="text-gray-400 pt-4">Recipe missing ingredients</p>
        @endforelse

        <div class="flex border-b border-gray-400 pt-4"></div>

        <p class="text-xl font-semibold tracking-wide py-2 text-sky-600">
            Directions
        </p>

        @forelse ($recipe->directions as $direction)
            @if ($direction['type'] == 'heading')
                <p class="font-semibold uppercase text-sm tracking-wider pt-2">{{ $direction['data']['content'] }}</p>
            @else
                <div class="flex items-center space-x-4">
                    <x-filament::input.checkbox />
                    <div>{{ $direction['data']['content'] }}</div>
                </div>
            @endif
        @empty
            <p class="text-gray-400 pt-4">Recipe missing ingredients</p>
        @endforelse

        <div class="flex border-b border-gray-400 pt-4"></div>

        <p class="text-xl font-semibold tracking-wide py-2 text-sky-600">
            Notes
        </p>

        <p class="pt-2">
            {{ $recipe->notes ?? 'No notes...' }}
        </p>

    </div>

</x-filament-panels::page>
