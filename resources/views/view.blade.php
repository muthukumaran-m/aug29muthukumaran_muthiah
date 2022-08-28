@extends('layout')

@section('content')


<div class="card">
    <header class="card-header">
        <h1 class="card-header-title is-size-3">
            Student details
        </h1>
        <button class="card-header-icon" aria-label="more options">
            <span class="icon">
                <i class="fas fa-angle-down" aria-hidden="true"></i>
            </span>
        </button>
    </header>
    <div class="card-content">
        <div class="content">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Name</label>
                </div>
                <div class="field-body">
                    <p class="control">
                    <p class="input">{{$student->name}}</p>
                    </p>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Email</label>
                </div>
                <div class="field-body">
                    <p class="control">
                    <p class="input">{{$student->email}}</p>
                    </p>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Phone</label>
                </div>
                <div class="field-body">
                    <p class="control">
                    <p class="input">{{$student->phone}}</p>
                    </p>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Address</label>
                </div>
                <div class="field-body">
                    <p class="control">
                    <p class="textarea">{{$student->address}}
                        <br>
                        <a class="has-text-info" target="_blank" href="http://maps.google.com/?q={{$student->address}}">See it on maps</a>
                    </p>
                    </p>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">City</label>
                </div>
                <div class="field-body">
                    <p class="control">
                    <p class="input">{{$student->city}}</p>
                    </p>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">State</label>
                </div>
                <div class="field-body">
                    <p class="control">
                    <p class="input">{{$student->state}}</p>
                    </p>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Country</label>
                </div>
                <div class="field-body">
                    <p class="control">
                    <p class="input">{{$student->country}}</p>
                    </p>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Status</label>
                </div>
                <div class="field-body">
                    <p class="control">
                        <label class="checkbox">
                            <p class="input">
                                {{$student->status?'Active':'In active'}}
                            </p>
                        </label>
                    </p>
                </div>
            </div>
            <hr>
            <p class="is-size-4">
                Marks
            </p>
            <div class="columns">

                @forelse($student->marks as $mark)
                <div class="field is-horizontal column">
                    <div class="field-label is-normal">
                        <label class="label">{{$mark->subject->name}}</label>
                    </div>
                    <div class="field-body">
                        <p class="control">
                        <p class="input">{{$mark->marks}}</p>
                        </p>
                    </div>
                </div>
                @empty
                <p>No marks found</p>
                @endforelse
            </div>
        </div>
    </div>
    <footer class="card-footer">
        <a href="{{route('students.index') }}" class="card-footer-item has-background-info-light has-text-info has-text-weight-bold">List</a>
        <a href="{{route('students.edit',$student->id)}}" class="card-footer-item has-background-primary-light has-text-primary has-text-weight-bold">Edit</a>
        <a data-id="{{$student->id}}" class=" delete-student card-footer-item has-background-danger has-text-white">Delete</a>
    </footer>
    <form id="deleteform{{$student->id}}" action="{{route('students.destroy',$student->id)}}" method="post">
        @csrf
        @method('delete')
    </form>
</div>
@endsection

@section('script')
<script src="/js/script.js"></script>
@endsection