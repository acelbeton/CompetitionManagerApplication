@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <h2>Competitors</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCompetitorModal">
            Add Competitor
        </button>
    </div>

    <div id="addCompetitorModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Competitor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addCompetitorForm" action="{{ route('competitors.store') }}" method="POST">
                        @csrf
                        <div class="form-group" id="usersDropdownContainer">
                            @include('partials.usersDropDown', ['users' => $users])
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="round_id" value="{{ $roundId }}">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Add Competitor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="competitorsList">
        @include('partials.competitorsList')
    </div>



@endsection
