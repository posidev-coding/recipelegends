<x-filament-panels::page>

    {{-- <div class="flex text-2xl font-semibold tracking-widest">
        {{ $recipe->title }}
    </div> --}}

    <div>
        @if ($preview)
            <img src="{{ $preview }}" />
        @else
            No Image
        @endif
    </div>
    {{-- @if ($this->hasInfolist())
        {{ $this->infolist }}
    @else
        {{ $this->form }}
    @endif

    @if (count($relationManagers = $this->getRelationManagers()))
        <x-filament-panels::resources.relation-managers :active-manager="$this->activeRelationManager" :managers="$relationManagers" :owner-record="$record"
            :page-class="static::class" />
    @endif --}}
</x-filament-panels::page>
