@if ($errors->any())
    <div {{ $attributes }}>
        <div class="text-sm font-medium text-danget-500">{{ __('Whoops! Something went wrong.') }}</div>

        <ul class="mt-3 text-xs list-disc list-inside text-danget-500">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
