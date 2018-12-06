@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="alert alert-success">
                        <p>
                            
                            Selamat Datang di ONPHPID Tutorial
                        </p>
                            @php
                                $check = Auth::user()->roles();
                            @endphp
                            @if (!$check)
                                
                            @endif
                            <?
                            if (!$check) {
                                # code...
                                <button type="button" id="upgrade" class="btn btn-xs btn-info" data-id="{{ Auth::id() }}" data-member="member">upgrade</button>
                            }
                            
                            ?>
                            
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function(){
        $('#upgrade').click(function(){
            var id = $(this).attr('data-id');
            var member = $(this).attr('data-member');
            var route = '{{ URL('home/upgrade') }}';
            var data = {
                id: id, level: member
            }
            var request = $.post(route, data);
                $(this).html('processing...');
                request.done(function(response){
                    $(this).html('upgrade');
                    if(response.success == 'true')
                        window.location.href = '{{ URL('member') }}';
                });
                request.always(function(response){
                    console.log('complete');
                    $(this).html('upgrade');
                });
        });
    });
</script>
@endsection
