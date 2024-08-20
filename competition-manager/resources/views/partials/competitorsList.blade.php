@if(count($competitors) == 0)
    <div>
        <span>There are no Competitors to this Round yet</span>
    </div>
@else
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Earned Points</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($competitors as $competitor)
                <tr>
                    <td> {{ $competitor->user->name }} </td>
                    <td> {{ $competitor->gained_points }} </td>
                    <td>
                        <button class="btn btn-danger delete-competitor" data-id="{{ $competitor->id }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endif
