@extends('page.show')

@section('content')

    <x-site.page-title :page="$page" class="page-title"/>
    <x-site.format-model class="page-text" :model="$page" :nl2br="false"/>
    <x-site.galleries :feed="$page->galleries"/>

    <x-site.gallery-index :title="$page->title"/>

@endsection
