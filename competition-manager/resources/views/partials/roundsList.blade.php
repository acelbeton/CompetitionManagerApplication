@if(count($rounds) == 0)
    <div>
        <span>There are no Rounds yet</span>
    </div>
@else
    <table>
        <thead>
        <tr>
            <th>Round Number</th>
            <th>Location</th>
            <th>Date</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($rounds as $round)
            <tr>
                <td class="round-number"> {{ $round->round_number }} </td>
                <td class="location"> {{ $round->location }} </td>
                <td class="date"> {{ $round->date }} </td>
                <td>
                    <form action="{{ route('competitors.findByRoundId', $round->id) }}" method="GET" class="ajax-form">
                        @csrf
                        <button type="submit" class="btn btn-primary competitor-round ajax-submit">Competitors</button>
                    </form>
                </td>
                <td>
                    <button class="btn btn-danger delete-round" data-id="{{ $round->id }}">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
