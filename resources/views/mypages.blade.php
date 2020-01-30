@extends('layout')

@section('content')
  <!-- ================ End Header Area ================= -->
  <!-- ================ start banner Area ================= -->
  <section class="home-banner-area">

    <div class="container">
        <div class="row justify-content-center fullscreen align-items-center">
        <div class="pagine_personali">
            @foreach($pages as $page)
                <a href="/mypages/{{$page->id}}"> {{$page->nome_pagina}}</a>
            @endforeach
        </div>
    </div>
  </section>
  <!-- ================ End banner Area ================= -->

@endsection
