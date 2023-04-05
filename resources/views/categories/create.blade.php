@extends('layouts.app')

@section('content')
    <h1>{{ __('app.category.create') }}</h1>
    <div>
        <form method="POST" action="{{ route('categories.store', ['locale' => app()->getLocale()]) }}">
            @csrf
            @if (count($categories) > 0)
                <div class="form-group">
                    <label>{{ __('app.parent_category') }}</label>
                    <select class="form-control" name="parent_id">
                        <option value="">-</option>
                        @foreach($categories as $category)
                            <option value="{{ $category['key'] }}">{{ $category['val'] }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="form-group">
                <label for="name">{{ __('app.name') }}</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div>
                <button class="btn btn-success">{{ __('app.submit') }}</button>
            </div>
        </form>
    </div>
@endsection
