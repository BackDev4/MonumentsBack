@extends('adminlte::page')

@section('title', 'Услуги')

@section('content_header')
    <div class="row d-flex justify-content-between col-md">
        <div>
            <h1>Услуги</h1>
        </div>
        <div>
            <x-adminlte-button label="Создать" theme="primary" data-toggle="modal" data-target="#modalCreate"
                               icon="fa fa-lg fa-fw fa-plus">
            </x-adminlte-button>
            <x-adminlte-modal icon="fa fa-info-circle" id="modalCreate" title="Создание"
                              size='lg' v-centered static-backdrop scrollable>
                <form action="{{route('admin.services.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">Название услуги</div>
                        <label class="col-md-6">
                            <input class="form-control" type="text" name="title"
                                   placeholder="Enter title">
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Описание услуги</div>
                        <label class="col-md-6">
                            <div class="editor">
                                <textarea name="content"></textarea>
                            </div>
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
        {{--        @if($contact)--}}
        @foreach($services as $ser)
            <tr>
                <td>{{$ser->id}}</td>
                <td>{{$ser->title}}</td>
                <td>{{$ser->content}}</td>
                <td>
                    <x-adminlte-button theme="primary" data-toggle="modal" data-target="#modalEdit{{$ser->id}}"
                                       icon="fa fa-lg fa-fw fa-pen"></x-adminlte-button>
                    <x-adminlte-button theme="danger" data-toggle="modal" data-target="#modalDelete{{$ser->id}}"
                                       icon="fa fa-lg fa-fw fa-trash"></x-adminlte-button>
                    <x-adminlte-button data-toggle="modal" data-target="#modalShow{{$ser->id}}"
                                       icon="fa fa-lg fa-fw fa-eye">
                    </x-adminlte-button>
                </td>
            </tr>
            <x-adminlte-modal icon="fa fa-info-circle" id="modalShow{{$ser->id}}" title="Контакт"
                              size='lg' enctype="multipart/form-data" v-centered static-backdrop scrollable>
                <div class="row">
                    <div class="col-md-6">ID</div>
                    <div class="col-md-6">{{$ser->id}}</div>
                </div>
                <div class="row">
                    <div class="col-md-6">Название</div>
                    <div class="col-md-6">{{$ser->title}}</div>
                </div>
                <div class="row">
                    <div class="col-md-6">Описание</div>
                    <div class="col-md-6">{{$ser->content}}</div>
                </div>
                <x-slot name="footerSlot"></x-slot>
            </x-adminlte-modal>
            <x-adminlte-modal theme="danger" icon="fa fa-lg fa-fw fa-trash" id="modalDelete{{$ser->id}}"
                              title="Удаление"
                              v-centered static-backdrop scrollable>
                Вы уверены?
                <x-slot name="footerSlot">
                    <form action="{{ route('admin.services.delete', ['id' => $ser->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-adminlte-button theme="success" type="submit" label="Yes"/>
                    </form>
                    <x-adminlte-button label="No" data-dismiss="modal" theme="danger"/>
                </x-slot>
            </x-adminlte-modal>
            <x-adminlte-modal theme="primary" icon="fa fa-lg fa-fw fa-pen" id="modalEdit{{$ser->id}}"
                              title="Редактирование" size="lg"
                              v-centered static-backdrop scrollable>
                <form action="{{route('admin.services.update', ['id' => $ser->id])}}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">Название</div>
                        <label class="col-md-6">
                            <input class="form-control" type="text" name="title"
                                   placeholder="Enter title" value="{{$ser->title}}">
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Описание</div>
                        <div class="editor">
                            <textarea name="content">{{$ser->content}}</textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Обновить</button>
                    </div>
                    <x-slot name="footerSlot"></x-slot>
                </form>
            </x-adminlte-modal>
        @endforeach
        {{--        @endif--}}
    </x-adminlte-datatable>
@endsection

