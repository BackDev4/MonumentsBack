@extends('adminlte::page')

@section('title', 'Галерея')

@section('content_header')
    <div class="row d-flex justify-content-between col-md">
        <div>
            <h1>Галерея</h1>
        </div>
        <div>
            <x-adminlte-button label="Создать" theme="primary" data-toggle="modal" data-target="#modalCreate"
                               icon="fa fa-lg fa-fw fa-plus">
            </x-adminlte-button>
            <x-adminlte-modal icon="fa fa-info-circle" id="modalCreate" title="Создание"
                              size='lg' v-centered static-backdrop scrollable>
                <form action="{{route('admin.gallery.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">Название картинки</div>
                        <label class="col-md-6">
                            <input class="form-control" type="text" name="title"
                                   placeholder="Enter title">
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Картинка</div>
                        <label class="col-md-6">
                            <input type="file" name="image" class="form-control">
                        </label>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Создать</button>
                    </div>
                    <x-slot name="footerSlot"></x-slot>
                </form>
            </x-adminlte-modal>
        </div>
    </div>
@stop

@section('content')
    @php
        $heads = [
            'id',
            'Название',
            'Описание',
      ];
    @endphp


    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable compressed beautify>
        @foreach($gallery as $gal)
            <tr>
                <td>{{$gal->id}}</td>
                <td>{{$gal->title}}</td>
                <td><img src="{{$gal->image}}" width="150px" alt="not found"></td>
                <td>
                    <x-adminlte-button theme="primary" data-toggle="modal" data-target="#modalEdit{{$gal->id}}"
                                       icon="fa fa-lg fa-fw fa-pen"></x-adminlte-button>
                    <x-adminlte-button theme="danger" data-toggle="modal" data-target="#modalDelete{{$gal->id}}"
                                       icon="fa fa-lg fa-fw fa-trash"></x-adminlte-button>
                    <x-adminlte-button data-toggle="modal" data-target="#modalShow{{$gal->id}}"
                                       icon="fa fa-lg fa-fw fa-eye">
                    </x-adminlte-button>
                </td>
            </tr>
            <x-adminlte-modal icon="fa fa-info-circle" id="modalShow{{$gal->id}}" title="Контакт"
                              size='lg' enctype="multipart/form-data" v-centered static-backdrop scrollable>
                <div class="row">
                    <div class="col-md-6">ID</div>
                    <div class="col-md-6">{{$gal->id}}</div>
                </div>
                <div class="row">
                    <div class="col-md-6">Название</div>
                    <div class="col-md-6">{{$gal->title}}</div>
                </div>
                <div class="row">
                    <div class="col-md-6">Картинка</div>
                    <div class="col-md-6">{{$gal->image}}</div>
                </div>
                <x-slot name="footerSlot"></x-slot>
            </x-adminlte-modal>
            <x-adminlte-modal theme="danger" icon="fa fa-lg fa-fw fa-trash" id="modalDelete{{$gal->id}}"
                              title="Удаление"
                              v-centered static-backdrop scrollable>
                Вы уверены?
                <x-slot name="footerSlot">
                    <form action="{{ route('admin.services.delete', ['id' => $gal->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{$gal->id}}">
                        <x-adminlte-button theme="success" type="submit" label="Да"/>
                    </form>
                    <x-adminlte-button label="Нет" data-dismiss="modal" theme="danger"/>
                </x-slot>
            </x-adminlte-modal>
            <x-adminlte-modal theme="primary" icon="fa fa-lg fa-fw fa-pen" id="modalEdit{{$gal->id}}"
                              title="Редактирование" size="lg"
                              v-centered static-backdrop scrollable>
                <form action="{{route('admin.gallery.update', ['id' => $gal->id])}}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">Название</div>
                        <label class="col-md-6">
                            <input class="form-control" type="text" name="title"
                                   placeholder="Enter title" value="{{$gal->title}}">
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Картинка</div>
                        <label class="col-md-6">
                            <input type="file" name="image" class="form-control">
                        </label>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Обновить</button>
                    </div>
                    <x-slot name="footerSlot"></x-slot>
                </form>
            </x-adminlte-modal>
        @endforeach
    </x-adminlte-datatable>
    {{$gallery->links('pagination::bootstrap-4')}}
@endsection

