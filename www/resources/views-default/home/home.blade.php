@extends('layouts.app')

@php
$seoTitle = $homeSeo->meta_title ?? $homeSeo->meta_title ?? $settings->site_name ?? '';
$seoDescription = $homeSeo->meta_description ?? '';
$seoUrl = route('home');
$seoImage = optional(optional($homeSeo)->seo_image)->getUrl('preview');
@endphp

@section('full-width')
    <x-site.home-slider class=""/>
    {{-- <x-site.home-banner/> --}}
@endsection

@section('top')
    <x-site.photo-links :items="optional(\Form::load('site', 'home_photo_links'))->photo_links" class="on-home" containerClass="mb-5"/>
    @includeWhen(isset($sections['top']), 'home.home-sections', ['location' => 'top'])
    {{-- <x-offer class="" on="home"/> --}}
@endsection

@section('side')

@endsection

@section('content')
    @include('home.home-sections', ['location' => 'main'])
@endsection

@section('bottom')
    @include('home.home-sections', ['location' => 'bottom'])
    <x-site.map container-class=""/>
@endsection
