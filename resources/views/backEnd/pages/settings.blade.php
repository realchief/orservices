@extends('backLayout.app')
@section('title')
Edit Layout
@stop

@section('content')

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Settings</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <div class="form-horizontal form-label-left">
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Airtable Name :
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <h4>{{$settings->airtable_name}}</h4>
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Base Name :
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <h4>{{$settings->base_name}}</h4>
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Api Key : 
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <h4>{{$settings->api_key}}</h4>
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Link to Template :
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <h4>{{$settings->link}}</h4>
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Note : 
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <h4>{{$settings->note}}</h4>
                </div>
              </div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-fw fa-edit"></i> Edit</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="x_panel">
          <div class="x_title">
            <h2>Datasync</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li style="padding-top: 5px;"><button class="badge sync_all" name="all_tables" style="background: #00a65a; margin: 0;">Sync Entire Base</button></li>
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <table class="table table-striped jambo_table bulk_action" id="tblUsers">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Table Name</th>
                        <th class="text-center">Table Source</th>
                        <th class="text-center">Total Records</th>
                        <th class="text-center">Last Synced</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($airtables as $key => $airtable)
                    <tr>
                      <td class="text-center">{{$key+1}}</td>
                      <td class="text-center">{{$airtable->name}}</td>
                      <td class="text-center">{{$settings->airtable_name}}</td>
                      <td class="text-center">{{$airtable->records}}</td>
                      <td class="text-center">{{$airtable->syncdate}}</td> 
                      <td class="text-center">
                        <button class="badge sync_now" name="{{$airtable->name}}" style="background: #00a65a;">Sync Now</button>
                        <button class="badge" style="background: #f39c12;"><a href="tb_{!! strtolower($airtable->name) !!}" style="color: white;">View Table</a></button>
                      </td>
                    </tr>
                  @endforeach             
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<!--- .modal-dialog -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  {{ Form::open(array('url' => ['datasync', 1], 'method' => 'put', 'enctype'=> 'multipart/form-data')) }}
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edit Settings</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal form-label-left">
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Airtable Name 
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input type="name" id="email" name="airtable_name" class="form-control col-md-7 col-xs-12" value="{{$settings->airtable_name}}">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Base Name 
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input type="name" id="email" name="base_name" class="form-control col-md-7 col-xs-12" value="{{$settings->base_name}}">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Api Key 
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input id="occupation" type="text" name="api_key" class="optional form-control col-md-7 col-xs-12" value="{{$settings->api_key}}">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Link to Template
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input id="occupation" type="text" name="link" class="optional form-control col-md-7 col-xs-12" value="{{$settings->link}}">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Note 
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input id="occupation" type="text" name="note" class="optional form-control col-md-7 col-xs-12" value="{{$settings->note}}">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>

    </div>
  </div>

  {!! Form::close() !!}
</div>
<!--- .modal-dialog -->
@endsection
@section('scripts')

<script type="text/javascript">
  $(document).ready(function() {
      var $img = $('<img class="probar titleimage" id="title" src="images/xpProgressBar.gif" alt="Loading..." />');
      var $img1 = $('<img class="probar titleimage" id="title" src="images/xpProgressBar.gif" alt="Loading..." />');
    $('.sync_all').click(function(){
        $(this).hide();
        $(this).after($img1);
        all_sync(0);
    });
  
    function all_sync(n){
      $here = $('.sync_now').eq(n);
      $here.hide();
      name = $here.attr('name');
      $here.after($img);
      name = name.toLowerCase();
      $.ajax({
          type: "GET",
          url: '/sync_'+name,
          success: function(result) {
              $img.remove();
              $here.show();
              $here.html('Updated');
              $here.removeClass('bg-yellow');
              $here.addClass('bg-purple');
              $here.parent().prev().html('<?php echo date("Y/m/d H:i:s"); ?>');
              if((n + 1) != $('.sync_now').length)
                all_sync(n+1);
              else{
                $img1.remove();
                $('.sync_all').show();
                $('.sync_all').html('Updated');
                $('.sync_all').removeClass('bg-yellow');
                $('.sync_all').addClass('bg-purple');
              }

          }
      });

    }

    $('.sync_now').click(function(){
        $(this).hide();
        name = $(this).attr('name');

        $(this).after($img);
        $here = $(this);
        name = name.toLowerCase();
        $.ajax({
            type: "GET",
            url: '/sync_'+name,
            success: function(result) {
                $img.remove();
                $here.show();
                $here.html('Updated');
                $here.removeClass('bg-yellow');
                $here.addClass('bg-purple');
                $here.parent().prev().html('<?php echo date("Y/m/d H:i:s"); ?>');
            }
        });
    });
  });
</script>
@endsection