@extends('layouts.app')

@php
$seoTitle = !empty($page->meta_title) ? $page->meta_title : ($page->title . ' | ' . $settings->site_name);
$seoDescription = !empty($page->meta_description) ? $page->meta_description : (!empty($page->description) ? $page->description : '');
$seoUrl = $page->urlByType;
$seoImage = $page->seoimage;
@endphp

@section('header')
    <x-site.frontimage :image="$page->frontimage ?? null"/>
@endsection

@section('content')
    {{-- <x-site.breadcrumb-array :segments="['home', 'page']" :page="$page"/> --}}
    <x-site.page-title :page="$page" class="page-title" {{-- :prefix="['a' => ['text' => __('site::breadcrumbs.offer.index'), 'href' => route('offer.index')]]" --}}/>
    <x-site.format-model class="page-text" :model="$page" :nl2br="false"/>
    @block($page->content_blocks)
    <x-site.galleries :feed="$page->galleries"/>

@endsection

@section('bottom')

@endsection

@section('bottom-fluid')
    <x-site.contact-form/>
@endsection

<x-site.page-is-active :page="$page"/>
