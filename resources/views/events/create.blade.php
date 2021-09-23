@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/event" enctype="multipart/form-data" method="post">
            @csrf


            <div class="row">
                <div class="col-8 offset-2">
                    
                        <div class="row">
                            <h1>Add New Event</h1>
                        </div>
                    
                        <div class="form-group row w-50">
                            <label for="title" class="col-md-4 col-form-label ">Title</label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"  value="{{ old('title') }}" autocomplete="title" autofocus required>
                                        
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                            
                        </div>

                        <div class="row">
                            <label for="image" class="col-md-4 col-form-label">Event Image</label>
                                <input type="file" class="form-control-file" id="image" name="image" required>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror      
                        </div> 
                        
                        <div class="form-group row w-25">
                            <label for="start" class="col-md-4 col-form-label ">Start</label>
                                <input id="start" type="datetime-local" class="form-control @error('start') is-invalid @enderror" name="start" autocomplete="start" autofocus required>
                                
                                @error('start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                        </div>

                        <div class="form-group row w-25">
                            <label for="end" class="col-md-4 col-form-label">End</label>
                                <input id="end" type="datetime-local" class="form-control @error('end') is-invalid @enderror" name="end" autocomplete="end" autofocus required>

                                @error('end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                        </div>

                        <div class="form-group row">
                            <label for="details" class="col-md-4 col-form-label">Details</label>
                                <textarea id="details" type="text" rows="5" class="form-control @error('details') is-invalid @enderror" name="details"  value="{{ old('details') }}" autocomplete="details" autofocus></textarea>        
                                @error('details')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                            
                        </div>

                        <div class="form-group row">
                            <label for="url" class="col-md-4 col-form-label">URL</label>
                                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url"  value="{{ old('url')}}" autocomplete="url" autocomplete="url" autofocus>
                                        
                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                            
                        </div>

                        <div class="form-group row w-25">
                            <label for="color" class="col-md-4 col-form-label">Color</label>
                                <input id="color" type="color" class="form-control @error('color') is-invalid @enderror" name="color"  value="{{ old('color') ?? '#0000FF'}}" autocomplete="color" autocomplete="color" autofocus>
                                        
                                @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                            
                        </div>

                        <div class="row pt-4">
                            <button class="btn btn-primary">Add New Event</button>
                        </div>
                </div>
            </div>
        </form>
</div>
@endsection

