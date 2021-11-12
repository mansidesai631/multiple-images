<html lang="en">
<head>
  <title>Edit Profile</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>

{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id], 'enctype' => 'multipart/form-data']) !!}
<div class="container">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="card">
            {{csrf_field()}}
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Phone Number:</strong>
                    {!! Form::text('phone', null, array('placeholder' => 'Phone Numbe','class' => 'form-control')) !!}
                </div>
            </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <strong>Images:</strong>
                <div class="input-group control-group increment" >
                    {!! Form::file('image[]', null, array('placeholder' => 'Images','class' => 'form-control')) !!}
                    <div class="input-group-btn">
                    <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                  </div>
                </div>

                <div class="clone hide">
                  <div class="control-group input-group" style="margin-top:10px">
                    {!! Form::file('image[]', null, array('placeholder' => 'Images','class' => 'form-control')) !!}
                    <div class="input-group-btn">
                      <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                    </div>
                  </div>
                </div>

            </div>
            <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>
        </div>
    </div>
</div>
{!! Form::close() !!}

<script type="text/javascript">

$(document).ready(function() {
    $(".btn-success").click(function(){
        var html = $(".clone").html();
        $(".increment").after(html);
    });

    $("body").on("click",".btn-danger",function(){
        $(this).parents(".control-group").remove();
    });
});
</script>
</body>
</html>
