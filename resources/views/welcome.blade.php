@extends('layout')

@section('content')


@forelse ($students as $student) <div class="card">
    <header class="card-header">
        <p class="card-header-title">
            {{$student->name}}
        </p>
        <button class="card-header-icon" aria-label="more options">
            <span class="student-status-{{$student->id}} tag has-text-white {{$student->status?'has-background-success':'has-background-danger'}}">
                {{$student->status?'Active':'Inactive'}}
            </span>
        </button>
    </header>
    <div class="card-content">
        <div class="content">
            <p>
                <b>Email:</b> <a href="mailto: {{$student->email}}"> {{$student->email}}</a>
            </p>
            <p>
                <b>Phone:</b> <a href="tel: {{$student->email}}"> {{$student->phone}}</a>
            </p>
            <p>
                <b>Address:</b>
                {{$student->address}}
                <br>
                <a class="has-text-info" target="_blank" href="http://maps.google.com/?q={{$student->address}}">See it on maps</a>

            </p>

            <small class="mr-4"><b>Created on :</b> <time datetime="2016-1-1">{{$student->created_at}}</time></small>
            <small class="mx-4"> <b>Updated on :</b> <time datetime="2016-1-1">{{$student->updated_at}}</time></small>
        </div>
    </div>
    <footer class="card-footer">
        <a href="{{route('students.show',$student->id)}}" class="card-footer-item has-background-info has-text-white">View</a>
        <a href="{{route('students.edit',$student->id)}}" class="card-footer-item has-background-info-light has-text-dark">Edit</a>
        <a data-id="{{$student->id}}" class="student-status-change-{{$student->id}} disable-student card-footer-item has-background-danger-light has-text-dark">Mark as Inactive</a>
        <a data-id="{{$student->id}}" class=" delete-student card-footer-item has-background-danger has-text-white">Delete</a>
    </footer>
    <form id="deleteform{{$student->id}}" action="{{route('students.destroy',$student->id)}}" method="post">
        @csrf
        @method('delete')
    </form>
</div>
<br>
@empty
<p>
    No record found
</p>
@endforelse
@endsection

@section('script')
<script>
    $(".disable-student").on('click', (elem) => {
        let id = $(elem.currentTarget).data('id')
        $.ajax({
            url: '/students/change-status/' + id,
            method: 'POST',
            data: {
                '_token': "{{csrf_token()}}",
            },
            success: (result) => {
                let text = result.status ? 'Active' : 'Inactive';
                let color = result.status ? 'has-background-success' : 'has-background-danger';
                let colorbtn = result.status ? 'has-background-danger-light':'has-background-success-light';
                let textbtn = result.status ?'Inactive':'Active';
                $(".student-status-" + id)
                    .html(text)
                    .removeClass('has-background-success')
                    .removeClass('has-background-danger')
                    .addClass(color)

                $(".student-status-change-" + id)
                    .html('Mark as '+textbtn)
                    .removeClass('has-background-success-light')
                    .removeClass('has-background-danger-light')
                    .addClass(colorbtn)
            },
            error: (error) => {
                console.error(error);
            }
        });
    })
</script>
<script src="/js/script.js"></script>
@endsection