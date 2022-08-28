@extends('layout')

@section('content')


<div class="card">
    <header class="card-header">
        <h1 class="card-header-title is-size-3">
            Add student
        </h1>
        <button class="card-header-icon" aria-label="more options">
            <span class="icon">
                <i class="fas fa-angle-down" aria-hidden="true"></i>
            </span>
        </button>
    </header>
    @if ($errors->any())
    <div class="notification is-danger">
        Please correct the errors!
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{route('students.store')}}">
        @csrf
        <div class="card-content">
            <div class="content">
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Name</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input value="{{ old('name') }}" name="name" class="input" type="input" placeholder="Student's name">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Email</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input value="{{ old('email') }}" name="email" class="input" type="email" placeholder="Student's email">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Phone</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input value="{{ old('phone') }}" name="phone" class="input" type="tel" placeholder="Student's phone">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Address</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <textarea name="address" class="textarea" placeholder="Cecilia Chapman
711-2880 Nulla St.
Mankato Mississippi 96522
(257) 563-7401 ">{{ trim(old('address')) }}</textarea>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">City</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input value="{{ old('city') }}" name="city" class="input" type="input" placeholder="Student's city">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">State</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input value="{{ old('state') }}" name="state" class="input" type="input" placeholder="Student's state">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Country</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input value="{{ old('country') }}" name="country" class="input" type="input" placeholder="Student's country">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Status</label>
                    </div>
                    <div class="field-body">
                        <p class="control">
                            <label class="checkbox">
                                <input value="1" {{old('status')?'checked':''}} name="status" type="checkbox">
                                Is active
                            </label>
                        </p>
                    </div>
                </div>
                <hr>
                <p class="is-size-4">
                    Marks
                </p>
                <div class="columns">
                    <div class="column">
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">English</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input value="{{ old('english') }}" name="english" class="input" type="input" placeholder="Student's marks in english">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="column">
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Maths</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input value="{{ old('maths') }}" name="maths" class="input" type="input" placeholder="Student's marks in maths">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">History</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input value="{{ old('history') }}" name="history" class="input" type="input" placeholder="Student's marks in history">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="card-footer buttons">
            <a href="{{route('students.index')}}" class="button card-footer-item has-background-danger-light has-text-danger has-text-weight-bold">Cancel</a>
            <button type="reset" class="button card-footer-item has-background-info-light has-text-info has-text-weight-bold">Clear</button>
            <button type="submit" class="button card-footer-item has-background-primary-light has-text-primary has-text-weight-bold">Save</button>
        </footer>
    </form>
</div>
@endsection