{{-- resources/views/filament/resources/smart-ad-resource/pages/analytics.blade.php --}}
<x-filament-panels::page>
    <div class="space-y-6">
        <div class="grid grid-cols-1 gap-6">
            @foreach ($this->getHeaderWidgets() as $widget)
                @livewire($widget)
            @endforeach
        </div>
    </div>
</x-filament-panels::page>