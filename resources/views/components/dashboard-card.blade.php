@props(['title', 'value', 'icon', 'actionText' => null, 'actionUrl' => '#'])

<div class="bg-white overflow-hidden shadow rounded-lg">
    <div class="p-5">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                {!! $icon !!}
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        {{ $title }}
                    </dt>
                    <dd>
                        <div class="text-lg font-medium text-gray-900">
                            {{ $value }}
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    @if($actionText)
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <a href="{{ $actionUrl }}"
                    class="font-medium text-[var(--color-primary)] hover:text-[var(--color-primary-hover)]">
                    {{ $actionText }}
                </a>
            </div>
        </div>
    @endif
</div>