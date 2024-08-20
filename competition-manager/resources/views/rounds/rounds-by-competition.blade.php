@extends('layouts.app')
@section('content')

    <div class="container mt-5">
        <h2>Rounds</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRoundModal">
            Add Round
        </button>
    </div>

    <div class="modal fade" id="addRoundModal" tabindex="-1" role="dialog" aria-labelledby="addRoundModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoundModalLabel">Add Round</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addRoundForm" action="{{ route('rounds.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="competition_id" value="{{ $competitionId }}">
                        <div class="form-group">
                            <label for="round_number">Round Number</label>
                            <input type="number" class="form-control" id="round_number" name="round_number" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="roundsList">
        @include('partials.roundsList', ['rounds' => $rounds])
    </div>

@endsection
