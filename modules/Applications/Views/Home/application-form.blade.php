@extends('application::layouts.app')
@section('title', 'employee')
@section('header')
@endsection
@section('style')
@endsection
@section('content')
    <div class="d-flex">
        <div class="">
            @include('application::components.sidebar', ['active' => 'application'])
        </div>
        <div class="w-100 input-bg">
            <div class="m-3 bg-white">
                <form id="app-form" action="{{ route('application.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container " style="height: 95vh;border-radius: 5px;border-top: 5px solid black;">
                        <div class="title fs-4 my-2">Application Form</div>
                        <div class="body d-flex gap-3" style="flex-direction: column;">
                            <input type="text" value="{{ $userObj->id }}" hidden name="user_id">
                            @error('user_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" hidden value="{{ $jobId }}" name="job_posting_id">
                            @error('job_posting_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="col-6">
                                <label for="" class="py-2">Cover Latter <span
                                        style="color: gray;">(Optional)</span>
                                </label>
                                <div id="coverLetterEditor" style="height: 30vh;"></div>
                                <input type="hidden" name="cover_letter" id="cover_letter">
                                @error('cover_letter')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="" class="py-2">Select resume</label>
                                <input type="file" name="resume" class="form-control" id="" required>
                                @error('resume')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="" class="py-2">Expected CTC</label>
                                <input type="number" name="expected_ctc" required placeholder="Enter ctc"
                                    class="form-control" id="">
                                @error('expected_ctc')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <button class="btn btn-dark">Submit</button>
                            </div>
                        </div>
                        <div class="buttons"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        var quill = new Quill('#coverLetterEditor', {
            theme: 'snow',
            placeholder: 'Write your cover letter here...'
        });
        document.querySelector('#app-form').addEventListener('submit', function(e) {
            const coverLetterHtml = quill.root.innerHTML;
            document.getElementById('cover_letter').value = coverLetterHtml;

        });
    </script>

@endsection
