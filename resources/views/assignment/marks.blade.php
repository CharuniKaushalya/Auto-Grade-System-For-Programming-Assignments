@extends('layouts.admin')

@section('content')
<!-- page content wrapper -->
<div class="page-content-wrap">                    
                    
    <!-- page content holder -->
    <div class="page-content-holder">
        <div class="row">
            <div class="col-md-12">
                @foreach($test as $key => $data)
                    <div class="alert alert-primary">
                        <h2><strong>Test {{ $key }}</strong></h2>
                        <div class="col-md-12 col-xs-12"> 
                             {!! Form::open(['method'=>'POST','files'=>true,'role'=>'form','class'=>'form-horizontal','id'=>'code']) !!}
                            {!! csrf_field() !!}
                            <h4><span class="control-label">
                                Input : <strong>{{ $data->input }}</strong>&nbsp;&nbsp;&nbsp;
                            </span></h4>
                            <h4><span class="control-label">
                                Output : <strong>{{ $data->output }}</strong>&nbsp;&nbsp;&nbsp;
                            </span></h4>
                            <div id="response"  style="font-size:16px;text-align:center">
                                <div class="processing"></div>
                                <div class="meta"></div>
                                <div class="output"></div>
                            </div>

                            <div >                                 
                                <input type="submit" name="submit" class="btn btn-success btn-large pull-right" value="Submit" />
                             </div>
                            {!! Form::close() !!}


                        </div>
                    </div>

                @endforeach
                            
            </div>
        </div>   
    </div>
</div>  
@endsection
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script type="text/javascript">

// OBJECTS



jQuery(document).ready(function($) {
   // $('#code').submit( function(){
    var obj = {!! json_encode($test->toArray()) !!};
$.each(obj, function (index, value) {

        var data = {
           source: '{{ $source }}',
           lang: {!! $lang !!},
           input: value.input
        };
        var source = '{{ $source }}';
        if( source == '' ) {
            alert( 'No source code provided in the area.');
            return false;
        }
        
        $('.processing').html('<div class="loading">Processing...</div>');
        
        $.ajax({
            type: 'post',
            url: '{{ url('/compile') }}',
            dataType: 'json',
            data: data + '&process=1',
            cache: false,
            success: function(response){
                $('.loading').remove();
                $('.cmpinfo').remove();
                $('#response').show();
                         if( response.status == 'success' ) {
                    $('.meta').text( response.meta );
                    $('.output').html('<strong>Output</strong>: <br><br><pre>' + response.output + '</pre>');
                    
                    if( response.cmpinfo ) {
                        $('.cmpinfo').remove();
                        $('.meta').after('<div class="cmpinfo"></div>');
                        $('.cmpinfo').html('<strong>Compiler Info: </strong> <br><br>' + response.cmpinfo );
                    }
                    
                } else {
                    //$('.output').html('<pre>' + response + '</pre>');
                    alert( response.output );
                }
                //alert( response.msg );
            }
        });
  console.log(value);
});
        
       /* return false;
    });*/
});

</script>
