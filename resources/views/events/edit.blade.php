@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/event/{{$event->id}}/update" enctype="multipart/form-data" method="post">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-8 offset-2">
                    
                        <div class="row">
                            <h1>Edit Event</h1>
                        </div>
                    
                        <div class="form-group row w-50">
                            <label for="title" class="col-md-4 col-form-label">Title</label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"  value="{{ old('title') ?? $event->title }}" autocomplete="title" autofocus>
                                        
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                            
                        </div>

                        <div class="row">
                            <label for="image" class="col-md-4 col-form-label">Event Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror      
                        </div> 
                        
                        <div class="form-group row w-25">
                            <label for="start" class="col-md-4 col-form-label">Start</label>
                                <input id="start" type="datetime-local" class="form-control @error('start') is-invalid @enderror" value="{{ old('start') ?? $event->start }}"　name="start" autocomplete="start" autofocus>
                                
                                @error('start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                        </div>

                        <div class="form-group row w-25">
                            <label for="end" class="col-md-4 col-form-label">End</label>
                                <input id="end" type="datetime-local" class="form-control @error('end') is-invalid @enderror" value="{{ old('end') ?? $event->end }}" name="end" autocomplete="end" autofocus>

                                @error('end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                        </div>

                        <div class="form-group row">
                            <label for="details" class="col-md-4 col-form-label">Details</label>
                                <textarea id="details" type="text" rows="5" class="form-control @error('details') is-invalid @enderror" name="details"   autocomplete="details" autofocus>{{ old('details') ?? $event->details }}</textarea>
                                        
                                @error('details')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                            
                        </div>

                        <div class="form-group row">
                            <label for="url" class="col-md-4 col-form-label">URL</label>
                                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url"  value="{{ old('url') ?? $event->url}}" autocomplete="username" autocomplete="url" autofocus>
                                        
                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                            
                        </div>

                        <div class="form-group row w-25">
                            <label for="color" class="col-md-4 col-form-label">Color</label>
                                <input id="color" type="color" class="form-control @error('color') is-invalid @enderror" name="color"  value="{{ old('color') ?? $event->color}}" autocomplete="color" autocomplete="color" autofocus>
                                        
                                @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                            
                        </div>

                        <div class="row pt-4">
                            <button class="btn btn-primary">Save</button>
                        </div>
                </div>
            </div>
    </form>
</div>
@endsection
