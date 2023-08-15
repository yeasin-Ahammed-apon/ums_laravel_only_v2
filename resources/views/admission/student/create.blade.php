@extends('layout')
@section('meta-tag')
{{ $title ?? Auth::user()->role->name }}
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Student Create Form',
        'color' => 'card-info',
    ])
    <!-- general form elements -->
    <div class="card">
        <form action="{{ route('admission.student.store', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                {{-- role --}}
                <input type="hidden" name="role" value="student" class="form-control custom-form-control"
                    placeholder="Enter name">
                {{-- name --}}
                <div class="form-group custom-form-group col-12 col-sm-4">
                    <label>name</label>
                    <input type="text" value="{{ $data->name }}" class="form-control custom-form-control"
                        placeholder="Enter name" disabled>
                </div>
                {{-- temporary_id --}}
                <div class="form-group custom-form-group col-12 col-sm-4">
                    <label>temporary_id</label>
                    <input type="text" value="{{ $data->temporary_id }}" class="form-control custom-form-control"
                        placeholder="Enter temporary_id" disabled>
                </div>
                {{-- batch_id --}}
                <div class="form-group custom-form-group col-12 col-sm-4">
                    <label>batch</label>
                    <input type="text" value="{{ ordinalFormat($data->batch->batch_number) }}"
                        class="form-control custom-form-control" placeholder="Enter batch_id"disabled>
                </div>
                {{-- department --}}
                <div class="form-group custom-form-group col-12 col-sm-8">
                    <label>department</label>
                    <input type="text" value="{{ $data->batch->department->name }}"
                        class="form-control custom-form-control" placeholder="Enter department" disabled>
                </div>
                {{-- advance_payment --}}
                <div class="form-group custom-form-group col-12 col-sm-4">
                    <label>advance_payment</label>
                    <input type="text" value="{{ $data->advance_payment }}" name="advance_payment"
                        class="form-control custom-form-control  @error('advance_payment') is-invalid @enderror"
                        placeholder="Enter advance_payment" disabled>
                    {!! validationError('advance_payment', $errors) !!}
                </div>
                {{-- father_name --}}
                <div class="form-group custom-form-group col-12 col-sm-4">
                    <label>father_name</label>
                    <input type="text" value="{{ $data->father_name }}" name="father_name"
                        class="form-control custom-form-control @error('father_name') is-invalid @enderror"
                        placeholder="Enter father_name">
                    {!! validationError('father_name', $errors) !!}
                </div>
                {{-- mother_name --}}
                <div class="form-group custom-form-group col-12 col-sm-4">
                    <label>mother_name</label>
                    <input type="text" value="{{ $data->mother_name }}" name="mother_name"
                        class="form-control custom-form-control @error('mother_name') is-invalid @enderror"
                        placeholder="Enter mother_name">
                    {!! validationError('mother_name', $errors) !!}
                </div>
                {{-- present_address --}}
                <div class="form-group custom-form-group col-12 col-sm-4">
                    <label>present_address</label>
                    <input type="text" value="{{ $data->present_address }}" name="present_address"
                        class="form-control custom-form-control @error('present_address') is-invalid @enderror"
                        placeholder="Enter present_address">
                    {!! validationError('present_address', $errors) !!}
                </div>
                {{-- permanent_address --}}
                <div class="form-group custom-form-group col-12 col-sm-4">
                    <label>permanent_address</label>
                    <input type="text" value="{{ $data->permanent_address }}" name="permanent_address"
                        class="form-control custom-form-control @error('permanent_address') is-invalid @enderror"
                        placeholder="Enter permanent_address">
                    {!! validationError('permanent_address', $errors) !!}
                </div>
                {{-- email --}}
                <div class="form-group custom-form-group col-12 col-sm-4">
                    <label>email</label>
                    <input type="email" value="{{ $data->email }}" name="email"
                        class="form-control custom-form-control @error('email') is-invalid @enderror"
                        placeholder="Enter email">
                    {!! validationError('email', $errors) !!}
                </div>
                {{-- phone --}}
                <div class="form-group custom-form-group col-12 col-sm-4">
                    <label>phone</label>
                    <input type="tel" value="{{ $data->phone }}" name="phone"
                        class="form-control custom-form-control @error('phone') is-invalid @enderror"
                        placeholder="Enter phone">
                    {!! validationError('phone', $errors) !!}
                </div>
                {{-- emergency_phone --}}
                <div class="form-group custom-form-group col-12 col-sm-4">
                    <label>emergency_phone</label>
                    <input type="tel" value="{{ $data->emergency_phone }}" name="emergency_phone"
                        class="form-control custom-form-control @error('emergency_phone') is-invalid @enderror"
                        placeholder="Enter emergency_phone">
                    {!! validationError('emergency_phone', $errors) !!}
                </div>
                {{-- emergency_phone_name --}}
                <div class="form-group custom-form-group col-12 col-sm-4">
                    <label>emergency_phone_name</label>
                    <input type="text" value="{{ $data->emergency_phone_name }}" name="emergency_phone_name"
                        class="form-control custom-form-control @error('emergency_phone_name') is-invalid @enderror"
                        placeholder="Enter emergency_phone_name">
                    {!! validationError('emergency_phone_name', $errors) !!}
                </div>
                {{-- blood_group_id --}}
                <div class="form-group custom-form-group col-12 col-sm-4">
                    <label>blood_group</label>
                    <select name="blood_group_id"
                        class="form-control custom-form-control @error('blood_group_id') is-invalid @enderror">
                        @foreach (\App\Models\BloodGroup::all() as $blood)
                            <option value="{{ $blood->id }}">{{ $blood->name }}</option>
                        @endforeach
                    </select>
                    {!! validationError('blood_group_id', $errors) !!}
                </div>
                {{-- gender_id --}}
                <div class="form-group custom-form-group col-12 col-sm-4">
                    <label>gender</label>
                    <select name="gender_id"
                        class="form-control custom-form-control @error('gender_id') is-invalid @enderror">
                        @foreach (\App\Models\Gender::all() as $program)
                            <option value="{{ $program->id }}">{{ $program->name }}</option>
                        @endforeach
                    </select>
                    {!! validationError('gender_id', $errors) !!}
                </div>
                {{-- image --}}
                <div class="form-group custom-form-group col-12 col-sm-4">
                    <label>image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="image" id="custom-file-input"
                                class="custom-file-input  @error('image') is-invalid @enderror"
                                accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event)">
                            <label class="custom-file-label" id="custom-file-label">Choose Image</label>
                        </div>
                    </div>
                    <div class="mt-2">
                        <img id="image-preview" src="" alt="Image Preview"
                            style="max-width: 200px; max-height: 200px;">
                    </div>
                    {!! validationError('image', $errors) !!}
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm mt-1 mb-1 btn-primary" onclick="disableButton(this)">
                    Update
                </button>
            </div>
        </form>
    </div>
    <!-- /.card -->
    <!-- general form elements -->
    @include('parts.title_end')
@endsection
@section('scripts')
    <script>
        document.getElementById('image-preview').style.display = 'none';

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image-preview');
                output.style.display = 'block'
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
