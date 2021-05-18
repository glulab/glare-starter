@extends('layouts.app')

@php
$seoTitle = $homeSeo->meta_title ?? $homeSeo->meta_title ?? $settings->site_name ?? '';
$seoDescription = $homeSeo->meta_description ?? '';
$seoUrl = route('home');
$seoImage = optional(optional($homeSeo)->seo_image)->getUrl('preview');
@endphp

@section('header')
    <x-site.home-video/>
    <x-site.home-banner/>
@endsection

@section('top-fluid')
    <x-site.home-slider class=""/>
@endsection

@section('top')
    @includeWhen(isset($sections['top']), 'home.home-sections', ['location' => 'top'])
    <x-site.photo-links :items="optional(\Form::load('home', 'home_photo_links'))->photo_links" class="on-home" containerClass="mb-5"/>
    {{-- <x-offer class="" on="home"/> --}}
@endsection

@section('side')
    {{-- @include('home.home-sections', ['location' => 'column']) --}}
@endsection

@section('content-fluid')
    {{-- <x-home-content/> --}}
@endsection

@section('content')
    @include('home.home-sections', ['location' => 'main'])
    <x-site.galleries :feed="optional(\Form::load('home', 'home_gallery'))->galleries"/>
@endsection

@section('bottom')
    @include('home.home-sections', ['location' => 'bottom'])
    <x-site.map container-class=""/>
@endsection

@section('bottom-fluid')
    <x-site.contact-form/>
@endsection
