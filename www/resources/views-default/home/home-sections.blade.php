@if (isset($sections[$location]))
@foreach ($sections[$location] as $section)
    @includeFirst(['home.home-sections-' . $location, 'home.home-sections-section'], ['section' => $section, 'location' => $location, 'class' => $class ?? ''])
@endforeach
@endif
