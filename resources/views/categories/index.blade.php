@extends('layouts.app')

@section('content')
    <h1>{{ __('app.categories')  }}</h1>
    <div>
        <a href="{{ route('categories.create', ['locale' => app()->getLocale()]) }}" class="btn btn-info">{{ __('app.category.create') }}</a>
    </div>
    <div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
            @endforeach
        @endif
        <form method="post" action="{{ route('categories.updateMany', ['locale' => app()->getLocale()]) }}">
            @csrf
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">{{ __('app.name') }}</th>
                    <th scope="col">{{ __('app.parent_category') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>
                            <input type="text" name="category[{{ $category->id }}][name]" class="form-control" value="{{ $category->name[app()->getLocale()] ?? '' }}">
                        </td>
                        <td>{{ $category->parent ? $category->parent->getLocaleName() : '-' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
                <button class="btn btn-success">{{ __('app.submit') }}</button>
            </div>
        </form>
    </div>
@endsection
