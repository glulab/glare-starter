@extends('page.show')

@section('content')

    <x-site.page-title :page="$page" class="page-title"/>
    <x-site.format-model :model="$page" :nl2br="false"/>
    <x-blog class=""/>

@endsection
