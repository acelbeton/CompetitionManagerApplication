<nav class="navbar navbar-expand-lg">
    <a class="ajax-link navbar-brand" href="{{ url('/') }}">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
             <i class="fas fa-bars"></i>
        </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="{{ route('create-competition') }}" class="ajax-link nav-link">Create Competition</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('competition-index') }}" class="ajax-link nav-link">Competitions</a>
            </li>
        </ul>
    </div>
</nav>
