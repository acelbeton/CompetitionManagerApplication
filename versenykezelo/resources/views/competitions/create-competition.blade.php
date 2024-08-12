@extends('layouts.app')

@section('content')

    <div class="text-center">
        <h1>Create Competition</h1>
    </div>

    <div class="container">
        <form id="competition-form">
            @csrf
            <div class="form-group">
                <label for="competition_name">Competition Name:</label>
                <input type="text" name="competition_name" placeholder="Name of the Competition" class="form-control">
            </div>
            <div class="form-group">
                <label for="competition_year">Year:</label>
                <input type="number" name="competition_year" placeholder="2024" class="form-control">
            </div>
            <div class="form-group">
                <label for="available_languages">Available Languages:</label>
                <div id="available_languages-wrapper">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="available_languages[]" placeholder="Hungarian" required>
                        <div class="input-group-append">
                            <button class="btn btn-danger remove-language" type="button">&times;</button>
                        </div>
                    </div>
                </div>
                <button type="button" id="add-language" class="btn btn-primary">Add Language</button>
            </div>
            <div class="form-group">
                <label for="maximum_points">Maximum Points:</label>
                <input type="number" class="form-control" name="maximum_points" placeholder="30">
            </div>
            <button type="submit" class="btn btn-success" onclick="saveCompetition()">Create Competition</button>
        </form>
        <div id="message"></div>
    </div>

@endsection
