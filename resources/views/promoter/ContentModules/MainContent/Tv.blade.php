@extends('promoter.layouts.app')

@section('main')

<div class="row mt">
  <h2><i class="fa fa-angle-right"></i>Streamings de TV</h2>
</div>
    <div class="row mt">
      <div class="col-lg-12">
        <div class="content-panel">
          
                <table class="table table-bordered table-striped table-condensed" id="TV">            
                    <thead>
                            <tr>
                              <th>Nombre</th>
                              <th>Logo</th>
                              <th>Streaming</th>
                              <th>Proveedor</th>
                              <th>Redes Sociales</th>
                              <th>Estatus</th>
                            </tr>
                    </thead>

                  </table>
          </div>
        </div>
      </div>
@include('promoter.modals.TvViewModal')
@endsection

@section('js')
<script>

$(document).ready(function(){

  var TV = $('#TV').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! url('DataTv') !!}',
            columns: [
                {data: 'name_r', name: 'name_r'},
                {data: 'logo', name: 'logo',  orderable: false, searchable: false},
                {data: 'streaming', name: 'streaming'},
                {data: 'Seller.name', name: 'Seller.name'},
                {data: 'SocialMedia', name: 'SocialMedia',orderable: false, searchable: false},
                {data: 'Estatus', name: 'Estatus', orderable: false, searchable: false}
            ]
        });

    $(document).on('click', '#status', function() {    
        var x = $(this).val();

                    $( "#formStatus" ).on( 'submit', function(e)
                {
                    var s=$("input[type='radio'][name=status]:checked").val();
                    var url = 'admin_tv/'+x;
                    e.preventDefault();
                    $.ajax({
                            url: url,
                            type: 'post',
                            data: {
                                    _token: $('input[name=_token]').val(),
                                    status: s,
                                  }, 
                            success: function (result) {

                                                        $('#myModal').toggle();
                                                        $('.modal-backdrop').remove();
                                                        alert("Se ha "+s+" con exito");
                                                        Radio.ajax.reload();
                                                        },

                            error: function (result) {
                            alert('Existe un Error en su Solicitud');
                            console.log(result);
                            }
                            });  
                                            });

    });

});

</script>
@endsection