@props([
'headers' => [],
'collection' => [],
'actions' => [],
'search_action' => '',
'limits' => [10, 20, 50, 100, 500, -1],
'defaultSearch' => true
])
@php
    function tableCellText($item, array $header)
    {
        if (!isset($header['value'])) {
            return '';
        } elseif (is_callable($header['value'])) {
            return $header['value']($item);
        } elseif (is_object($item) || is_array($item)) {
            return data_get($item, $header['value']);
        } else {
            return $header['value'];
        }
    }

    function tableActionLink($item,$action)
    {
        if (!isset($action['link'])) {
            return '';
        } elseif (is_callable($action['link'])) {
            return $action['link']($item);
        } else {
            return $action['link'];
        }
    }

    $hasActions = is_array($actions) && count($actions);
    $hasPagination = $collection instanceof Illuminate\Pagination\LengthAwarePaginator;
    $successStatus = ['active','complete','received'];
    $dangerStatus = ['inactive','pending','deactive'];
@endphp

<div class="col-md-12">
    <div class="row mb-1 pe-2 justify-content-between">
        <div class="col-3">
            @if ($hasPagination)
                <div class="col-4">
                    <select
                        name="limit"
                        class="form-select"
                    >
                        @foreach ($limits as $limit)
                            @if ($limit == -1)
                                <option value="-1">All</option>
                            @else
                                <option value="{{ $limit }}" {{ request('limit') == $limit ? 'selected':'' }}>{{ $limit }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
        <div class="col-9">
            <form action="{{ $search_action }}" method="GET">
                @if($defaultSearch)
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-3">
                                <select name="field" class="form-select">
                                    @foreach($headers as $header)
                                        @if(array_key_exists('searchable',$header) && $header['searchable'])
                                            <option value="{{ $header['value'] }}"
                                                    @if($header['value'] == request('field')) selected @endif>
                                                {{ $header['text'] }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-8">
                                <input type="search" name="keyword" class="form-control"
                                       value="{{ request('keyword') }}">
                            </div>
                            <div class="col-1">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                @else
                    {{ $searchForm ?? null }}
                @endif

            </form>
        </div>
    </div>
</div>
<div {{ $attributes->merge(['class' => 'basetable table-responsive pt-0']) }}>
    <table class="table">
        <thead class="table-primary">
        <tr>
            <th>#</th>
            @foreach ($headers as $header)
                <th>
                    <span class="text-width-90" title="{{ $header['text'] ?? null }}">
                        {{ translate($header['text'] ?? null) }}
                    </span>
                </th>
            @endforeach
            @if ($hasActions)
                <th>{{ translate('Action') }}</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @forelse($collection as $item)
            <tr>
                <td>
                    {{ $hasPagination ? $collection->firstItem() + $loop->index : $loop->iteration }}
                </td>
                @foreach ($headers as $header)
                    @php
                        $field = tableCellText($item, $header);
                    @endphp
                    <td>
                        @if(in_array($field, $successStatus))
                            <span class="badge bg-success text-capitalize">
                                {{$field}}
                            </span>
                        @elseif(in_array($field, $dangerStatus))
                            <span class="badge bg-danger text-capitalize">
                                {{$field}}
                            </span>
                        @elseif(array_key_exists('image',$header) && $header['image'])
                            <img height="40" width="40" src="{{$field}}" alt="">
                        @else
                            <span class="text-width-120" title="{{ $field }}">
                                {{ $field }}
                            </span>
                        @endif
                    </td>
                @endforeach
                @if ($hasActions)
                    <td>
                        @foreach ($actions as $action)
                            @if (!empty($action))
                                @if (isset($action['method']) && strtolower($action['method']) == 'delete')
                                    <form action="{{ tableActionLink($item, $action) }}"
                                          onclick="return confirm('Are you sure?')"
                                          class="d-inline-block" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" @class([
                                        'btn', 'btn-sm', $action['class'] ?? 'btn-outline-danger'])>
                                        <i class="{{ $action['icon'] ?? null }}"></i>
                                        {{ $action['text'] ?? null }}
                                        </button>
                                    </form>
                                @else
                                    <a id="{{ $action['id'] ?? null }}"
                                       href="{{ tableActionLink($item, $action) }}"
                                       @class(['btn', 'btn-sm', $action['class'] ?? 'btn-outline-light'])>
                                    <i class="{{ $action['icon'] ?? null }}"></i>
                                    {{ $action['text'] ?? null }}
                                    </a>
                                @endif
                            @endif
                        @endforeach

                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($headers) + 2 }}" class="text-center">
                    <h4 class="py-5 text-muted">No data found ):</h4>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@if ($hasPagination)
    {{ $collection->links() }}
    @push('scripts')
        <script>
            var limitSelects = document.querySelectorAll('select[name="limit"]');
            var totalLimitSelects = limitSelects.length;

            for (let i = 0; i < totalLimitSelects; i++) {
                var element = limitSelects[i];
                element.addEventListener('change', function (ev) {
                    var url = new URL('', "{{ $collection->path() }}");
                    url.searchParams.set('limit', ev.target.value);
                    window.location.href = url.toString();
                });
            }
        </script>
    @endPush
@endif


