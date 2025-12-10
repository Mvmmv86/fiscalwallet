@props([
    'headers' => [],
    'striped' => false,
])

<div class="overflow-x-auto rounded-lg border border-gray-100">
    <table class="w-full">
        @if(count($headers) > 0)
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    @foreach($headers as $header)
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ $header }}
                        </th>
                    @endforeach
                </tr>
            </thead>
        @elseif(isset($head))
            <thead class="bg-gray-50 border-b border-gray-200">
                {{ $head }}
            </thead>
        @endif

        <tbody class="divide-y divide-gray-100 bg-white">
            {{ $slot }}
        </tbody>

        @if(isset($foot))
            <tfoot class="bg-gray-50 border-t border-gray-200">
                {{ $foot }}
            </tfoot>
        @endif
    </table>
</div>
