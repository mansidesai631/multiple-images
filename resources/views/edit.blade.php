<html lang="en">
<head>
  <title>Edit Profile</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<style>
.thumb{
    margin: 10px 5px 0 0;
    width: 300px;
}
.img-wrap {
    position: relative;
    float:left;
}

.img-wrap #clear {
    position: absolute;
    top: 2px;
    right: 2px;
    z-index: 100;
}

.hide{
    display:none;
}
</style>
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
                    <input type="file" id="file-input" value="image[]"/>
                    <div class="input-group-btn">
                    <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                  </div>
                </div>

                <div class="clone hide">
                  <div class="control-group input-group" style="margin-top:10px">
                    <input type="file" id="file-input" value="image[]"/>
                    <div class="input-group-btn">
                      <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                    </div>
                  </div>
                </div>
            </div>
            <div id="thumb-output">
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

$(document).ready(function(){
    $('#file-input').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
            $("#clear").removeClass("hide");
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element
                        $('#thumb-output').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });

        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
    });
});
</script>
</body>
</html>
