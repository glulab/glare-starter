@extends('layouts.app')

@php
$seoTitle = !empty($page->meta_title) ? $page->meta_title : ($page->title . ' | ' . $settings->site_name);
$seoDescription = !empty($page->meta_description) ? $page->meta_description : (!empty($page->description) ? $page->description : '');
$seoUrl = $page->urlByType;
$seoImage = optional(optional($page)->image)->getUrl('preview');
@endphp

@section('content')

    <div class="page-title">{!! $page->title !!}</div>
    <x-site.format-model :model="$page" :nl2br="false"/>{{-- <x-site.format-page :text="$page->text" :images="$page->images" :nl2br="false"/> --}}

@endsection

<x-site.page-is-active :page="$page"/>
