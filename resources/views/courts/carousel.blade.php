<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($court->photos as $photo)
            <li data-target="#carousel-example-generic"
                data-slide-to="{{ $loop->index }}"
                class="{{ $loop->first ? 'active' : ''}}">
            </li>
        @endforeach
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        @foreach ($court->photos as $photo)
            <div class="item {{ $loop->first ? 'active' : ''}}">
                <img style="width: 100%" src="{{ url('storage/'.$photo->url) }}">
            </div>
        @endforeach
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Atras</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
    </a>

</div>

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/twitter-bootstrap.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="/js/twitter-bootstrap.js"></script>
@endpush