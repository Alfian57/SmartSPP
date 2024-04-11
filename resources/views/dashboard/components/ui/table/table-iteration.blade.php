<div>
    @php
        $page = request('page') === null ? 1 : request('page');
        $number = (int) $iteration + ((int) $page - 1) * 25;
    @endphp
    <th>{{ $number }}</th>
</div>
