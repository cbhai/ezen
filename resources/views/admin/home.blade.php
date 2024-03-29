@extends('layouts.admin')
@section('content')
<div class="flex flex-wrap">
    {{-- Number block --}}
    <div class="{{ $settings1['column_class'] }} px-4">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
                        <h5 class="text-xs font-bold uppercase text-blueGray-400">
                            {{ $settings1['chart_title'] }}
                        </h5>
                        <span class="text-xl font-semibold text-blueGray-700">
                            {{ number_format($settings1['total_number']) }}
                        </span>
                    </div>
                    <div class="relative flex-initial w-auto pl-4">
                        <div class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white rounded-full shadow-lg bg-lightBlue-500">
                            <i class="fas fa-globe"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Number block --}}
    <div class="{{ $settings2['column_class'] }} px-4">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
                        <h5 class="text-xs font-bold uppercase text-blueGray-400">
                            {{ $settings2['chart_title'] }}
                        </h5>
                        <span class="text-xl font-semibold text-blueGray-700">
                            {{ number_format($settings2['total_number']) }}
                        </span>
                    </div>
                    <div class="relative flex-initial w-auto pl-4">
                        <div class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white rounded-full shadow-lg bg-lightBlue-500">
                            <i class="fas fa-globe"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Number block --}}
    <div class="{{ $settings3['column_class'] }} px-4">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
                        <h5 class="text-xs font-bold uppercase text-blueGray-400">
                            {{ $settings3['chart_title'] }}
                        </h5>
                        <span class="text-xl font-semibold text-blueGray-700">
                            {{ number_format($settings3['total_number']) }}
                        </span>
                    </div>
                    <div class="relative flex-initial w-auto pl-4">
                        <div class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white rounded-full shadow-lg bg-lightBlue-500">
                            <i class="fas fa-globe"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Number block --}}
    <div class="{{ $settings4['column_class'] }} px-4">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
                        <h5 class="text-xs font-bold uppercase text-blueGray-400">
                            {{ $settings4['chart_title'] }}
                        </h5>
                        <span class="text-xl font-semibold text-blueGray-700">
                            {{ number_format($settings4['total_number']) }}
                        </span>
                    </div>
                    <div class="relative flex-initial w-auto pl-4">
                        <div class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white rounded-full shadow-lg bg-lightBlue-500">
                            <i class="fas fa-globe"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Latest Entries --}}
    {{-- <div class="{{ $settings5['column_class'] }} px-4">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
                        <h5 class="text-xs font-bold uppercase text-blueGray-400">
                            {{ $settings5['chart_title'] }}
                        </h5>
                    </div>
                    <div class="relative flex-initial w-auto pl-4">
                        <div class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white bg-indigo-500 rounded-full shadow-lg">
                            <i class="fas fa-table"></i>
                        </div>
                    </div>
                    <div class="w-full mt-4 overflow-x-auto">
                        <table class="table table-index">
                            <thead>
                                <tr>
                                    @foreach($settings5['fields'] as $key => $value)
                                        <th>
                                            {{ trans(sprintf('cruds.%s.fields.%s', $settings5['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($settings5['data'] as $entry)
                                    <tr>
                                        @foreach($settings5['fields'] as $key => $value)
                                            <td>
                                                @if($value === '')
                                                    {{ $entry->{$key} }}
                                                @elseif(is_iterable($entry->{$key}))
                                                    @foreach($entry->{$key} as $subEentry)
                                                    <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                    @endforeach
                                                @else
                                                  Nitin  {{ data_get($entry, $key . '.' . $value) }}
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="{{ count($settings5['fields']) }}">{{ __('No entries found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


     {{-- Latest Entries --}}
     <div class="{{ $settings5['column_class'] }} px-4">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
                        <h5 class="text-xs font-bold uppercase text-blueGray-400">
                            {{ $settings5['chart_title'] }}
                        </h5>
                    </div>
                    <div class="relative flex-initial w-auto pl-4">
                        <div class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white bg-indigo-500 rounded-full shadow-lg">
                            <i class="fas fa-table"></i>
                        </div>
                    </div>
                    <div class="w-full mt-4 overflow-x-auto">
                        <table class="table table-index">
                            <thead>
                                <tr>
                                    @foreach($settings5['fields'] as $key => $value)
                                        <th>
                                            {{ trans(sprintf('cruds.%s.fields.%s', $settings5['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($settings5['data'] as $entry)
                                    <tr>
                                        @foreach($settings5['fields'] as $key => $value)
                                            <td>
                                                @if($value === '')
                                                    {{ $entry->{$key} }}
                                                @elseif(is_iterable($entry->{$key}))
                                                    @foreach($entry->{$key} as $subEentry)
                                                        <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                    @endforeach
                                                @else
                                                    {{ data_get($entry, $key . '.' . $value) }}
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="{{ count($settings5['fields']) }}">{{ __('No entries found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>





    {{-- Bar chart --}}
    <div class="{{ $chart6->options['column_class'] }} px-4">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg">
            <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                    <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
                        <h5 class="text-xs font-bold uppercase text-blueGray-400">
                            {{ $chart6->options['chart_title'] }}
                        </h5>
                    </div>
                    <div class="relative flex-initial w-auto pl-4">
                        <div class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white bg-red-500 rounded-full shadow-lg">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                    </div>
                    <div class="w-full">
                        {{ $chart6->renderHtml() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    {{ $chart6->renderJs() }}
@endpush
