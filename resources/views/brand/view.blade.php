@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header">
                        {{--Botón Modal--}}
                        <!-- Button trigger modal -->
                        <br>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#brand-modal-add">
                            Nueva Marca
                        </button>

                        @if ( session()->has('msg') && session()->has('status') )
                            <br><br>
                            <div class="alert alert-{{session('status')}} alert-dismissible fade show" role="alert">
                                {{session('msg')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endIf

                        @include('brand.modal.add')
                    </div>
                    <div class="box-body">
                        {{--Datatable--}}
                        <br>
                        <table id="brand-datatable" class="table table-bordered w-100">
                            <thead>
                                <tr>
                                    <th class="w-25 text-center">Nombre</th>
                                    <th class="w-50 text-center">Descripción</th>
                                    <th class="w-25 text-center">Imagen</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->name }}</td>
                                        <td>{{ $brand->description }}</td>
                                        <td class="text-center"> <img src="{{env('APP_URL', '')}}/storage/app/brand/{{$brand->id}}.{{$brand->extension}}" class="img-fluid" width="40px" height="40px"> </td>
                                        <td class="text-center">
                                            <form class="form-horizontal" method="get" id="delete-brand" enctype="multipart/form-data" action="{{route('destroy-brand', '')}}/{{$brand->id}}" role="form">
                                                @csrf
                                                <div class="modal-footer">
                                                    <button type="button" onclick="confirmar()" id="delete-brand-button" class="submit-form btn btn-danger">Eliminar</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('script')
    <script type="text/javascript">
        function confirmar(){
            swal({
                title: "¿Estás seguro de eliminar esta marca?",
                text: "Una vez eliminado, no podrás recuperar la información ",
                icon: "warning",
                buttons: true,
                dangerMode: true
            })
            .then((willDelete) => {
                if (willDelete){
                    document.getElementById('delete-brand').submit();
                }
            });
        }
    </script>
@endpush

@endsection
