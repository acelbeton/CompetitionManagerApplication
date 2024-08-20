@extends('layouts.app')
@section('content')

    <div class="container mt-5">
        <h2>Competitions</h2>
    </div>

    @if(count($competitions) == 0)
        <div>
            <span>There are no Competitions yet</span>
        </div>
    @else
        <table>
            <thead>
            <tr>
                <th>Competition Name</th>
                <th>Competition Year</th>
                <th>Maximum Points</th>
                <th>Available Languages</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($competitions as $competition)
                <tr>
                    <td class="competition-name"> {{ $competition->competition_name }}</td>
                    <td class="competition-year"> {{ $competition->competition_year }}</td>
                    <td class="maximum-points"> {{ $competition->maximum_points }}</td>
                    <td class="available-languages">
                        {{ is_array($competition->available_languages)
                            ? implode(', ', $competition->available_languages)
                            : implode(', ', json_decode($competition->available_languages, true))
                        }}
                    </td>
                    <td>
                        <form action="{{ route('rounds.findByCompetitionId', $competition->id) }}" method="GET" class="ajax-form">
                            @csrf
                            <button type="submit" class="btn-primary ajax-submit">Rounds</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@endsection
