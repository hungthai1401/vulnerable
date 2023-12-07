<x-pulse::card :cols="$cols" :rows="$rows" :class="$class">
    <x-pulse::card-header name="Security Vulnerability Composer Dependencies">
        <x-slot:icon>
            <x-dynamic-component :component="'pulse::icons.sparkles'" />
        </x-slot:icon>
    </x-pulse::card-header>

    <x-pulse::scroll :expand="$expand" wire:poll.5s="">
        @if (!count($packages))
            <x-pulse::no-results />
        @else
            <div class="grid grid-cols-1 @lg:grid-cols-2 @3xl:grid-cols-3 @6xl:grid-cols-4 gap-2">
                <x-pulse::table>
                    <colgroup>
                        <col width="100%" />
                        <col width="0%" />
                    </colgroup>
                    <x-pulse::thead>
                        <tr>
                            <x-pulse::th>Package</x-pulse::th>
                            <x-pulse::th class="text-right">Security Issues</x-pulse::th>
                        </tr>
                    </x-pulse::thead>
                    <tbody>
                    @foreach ($packages as $packageName => $packageIssues)
                        <tr class="h-2 first:h-0"></tr>
                        <tr wire:key="{{ $packageName }}">
                            <x-pulse::td class="max-w-[1px]">
                                <code class="block text-xs text-gray-900 dark:text-gray-100 truncate" title="">
                                    {{ $packageName }}
                                </code>
                            </x-pulse::td>
                            <x-pulse::td numeric class="text-gray-700 dark:text-gray-300 font-bold">
                                <ul>
                                    @foreach($packageIssues as $packageIssue)
                                        <li>
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 truncate" title="">
                                                <a href='{{ $packageIssue['link'] }}'>
                                                    {{ $packageIssue['title'] }}
                                                </a>
                                            </p>
                                        </li>
                                    @endforeach
                                </ul>
                            </x-pulse::td>
                        </tr>
                    @endforeach
                    </tbody>
                </x-pulse::table>
            </div>
        @endif
    </x-pulse::scroll>
</x-pulse::card>
