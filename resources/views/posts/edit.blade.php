@extends('main')

@section('title', ' Edit Blog Post')

@section('stylesheets')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>

    <script>
      tinymce.init({
        selector: 'textarea',
        plugins: ["lists advlist"],
        menubar: false,
        toolbar: 'undo, redo | styleselect | bold, italic | alignleft, aligncenter, alignright, alignjustify | bullist, numlist, outdent, indent'

      });
    </script>

@endsection

@section('content')

    <div class="row">
        {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => true]) !!}
        <div class="col-md-8">
            {{ Form::label('title', 'Title:')}}
            {{ Form::text('title', null, ['class' => 'form-control input-lg']) }}

            {{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
            {{ Form::text('slug', null,['class' => 'form-control'])}}

            {{ Form::label('category_id','Category:', ['class' => 'form-spacing-top']) }}
            {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

            {{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
            {{ Form::select('tags[]', $tags, null, ['class' => 'select2-multi form-control', 'multiple' => 'multiple']) }}

            {{ Form::label('featured_image', 'Featured Image:') }}
            {{ Form::file('featured_image', ['class' => 'form-spacing-top']) }}

            {{ Form::label('body', 'Body:', ['class' => 'form-spacing-top'])}}
            {{ Form::textarea('body',null, ['class' => 'form-control']) }}
        </div>

        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Create At:</dt>
                    <dd>{{ date('M j, Y h:ia ',strtotime($post->created_at)) }}</dd>
                </dl>

                <dl class="dl-horizontal">
                    <dt>Last Updated:</dt>
                    <dd>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
                </dl>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-6">
                    {{ Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => "btn btn-danger btn-block")) }}
                </div>

                <div class="col-sm-6">
                    {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
                </div>
            </div>

        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('scripts')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script type="text/javascript">
          $('.select2-multi').select2();
          $('.select2-multi').select2().val({!! json_encode($post->tags()->allRelatedIds()) !!}).trigger('change');
        </script>

@endsection
