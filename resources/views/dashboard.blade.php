@extends('layouts.app')
@section('toolbar'){
    <div class="content-wrapper px-4 py-2">
        @if ('page.title and page.title != blank' )
        <div class="content-header">
          <h1>{{ 'Dashboard' }}</h1>
        </div>
        @endif
      </div>
}
@endsection
@section('content')

@endsection
