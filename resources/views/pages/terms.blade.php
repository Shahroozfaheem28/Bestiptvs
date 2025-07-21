@extends('layouts.app')

@section('title', $page->title)

@section('content')
<div class="py-5" style="background-color: #f9f9f9;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4 text-primary" style="font-weight: 700;">
                            {{ $page->title }}
                        </h2>
                        <hr class="mb-4" style="border-top: 2px solid #007bff; width: 60px; margin: auto;">
                        <div class="mt-4" style="line-height: 1.8; font-size: 1.1rem;">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
