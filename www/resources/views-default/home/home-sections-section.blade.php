<article class="section {!! $location !!} {!! $class ?? 'mb-5' !!}">
    <div class="container">
        @if(!empty($section->title))<div class="section-title">{!! $section->title !!}</div>@endif
        <x-site.format-model :model="$section" :nl2br="false"/>{{-- <x-site.format-page :text="$section->text" :images="$section->images" :nl2br="false"/> --}}
    </div>
</article>
