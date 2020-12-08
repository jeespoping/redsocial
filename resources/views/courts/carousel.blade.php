
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">

    <ol class="carousel-indicators">
        @foreach($court->photos as $photo)
            <li data-target="#carousel-example-generic"
                data-slide-to="{{ $loop->index }}"
                class="{{ $loop->first ? 'active' : ''}}">
            </li>
        @endforeach
    </ol>

    <div class="carousel-inner">
        @foreach ($court->photos as $photo)
            <div class="carousel-item {{ $loop->first ? 'active' : ''}}">
                <img style="width: 100%" src="{{ url('storage/'.$photo->url) }}">
            </div>
        @endforeach
    </div>
</div>
