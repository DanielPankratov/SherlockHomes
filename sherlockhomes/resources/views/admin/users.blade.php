@extends('admin.layoutadmin')

@section('content')



<div class="content pt-5">
          <div class="mx-n6 bg-white px-6 pt-7 border-y border-300">
          <div class="col-auto">
          <h3>Administradores</h3>
                    <p class="text-700 lh-sm mb-0">Contas com permissão de acesso ao BackOffice</p><br>
<div id="tableExample2" data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;age&quot;],&quot;page&quot;:5,&quot;pagination&quot;:true}">
                        <div class="table-responsive scrollbar">
                          <table class="table table-bordered table-striped fs--1 mb-0">
                            <thead class="bg-200 text-900">
                              <tr>
                                <th class="sort" data-sort="name">Nome</th>
                                <th class="sort" data-sort="email">Email</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody class="list">

                             @foreach($users as $user)
                              @if($user->hasRole('superadmin'))
                            <tr>
                                <td class="name">{{$user->name}}</td>
                                <td class="email">{{$user->email}}</td>
                                <td class="age" style="text-align: center;">
                                  <button class="btn btn-outline-warning me-1 mb-1" type="button" disabled>SuperAdmin</button>                                
                                </td>
                            </tr>
                              @endif
                            @endforeach
                            @foreach($users as $user)
                              @if($user->hasRole('admin'))
                            <tr>
                                <td class="name">{{$user->name}}</td>
                                <td class="email">{{$user->email}}</td>
                                <td class="age" style="text-align: center;">
                                
                                <form role="form" method="POST" action="/user/{{$user->id}}/removeRole" enctype="multipart/form-data">
                                  @csrf
                                  @method('PUT')
                                  <button class="btn btn-outline-danger me-1 mb-1" type="submit">Remover Administrador</button>
                                  </form>
                                  {{-- <button class="btn btn-sm btn-phoenix-secondary me-1 fs--2"><span class="fas fa-pen"></span></button>
                                  <button class="btn btn-sm btn-phoenix-secondary fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-trash"></span></button> --}}
                                </td>
                            </tr>
                              @endif
                            @endforeach

                            </tbody>
                          </table>
                        </div>
</div>
<br><br>
                    <h3>Utilizadores</h3>
                    <p class="text-700 lh-sm mb-0">Todas as contas do SherlockHomes</p><br>
                  </div>
          <div id="tableExample2" data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;age&quot;],&quot;page&quot;:5,&quot;pagination&quot;:true}">
                        <div class="table-responsive scrollbar">
                          <table class="table table-bordered table-striped fs--1 mb-0">
                            <thead class="bg-200 text-900">
                              <tr>
                                <th class="sort" data-sort="name">Nome</th>
                                <th class="sort" data-sort="email">Email</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($users as $user)
                              @if($user->hasRole('admin') || $user->hasRole('superadmin'))
                              @else
                            <tr>
                                <td class="name">{{$user->name}}</td>
                                <td class="email">{{$user->email}}</td>
                                <td class="age" style="text-align: center;">
                                <i class="fa-solid fa-hexagon-plus"></i>

                                <div style="float: left; padding-left: 15%;">
                                  <form role="form" method="POST" action="/user/{{$user->id}}/addRole" enctype="multipart/form-data">
                                  @csrf
                                  @method('PUT')
                                  <button class="btn btn-outline-info  me-1 mb-1" type="submit">Promover a Administrador</button>
                                  </form>
                                </div>
                                <div>                                
                                  <form role="form" method="POST" action="/user/{{$user->id}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                      <button class="btn btn-outline-danger me-1 mb-1" type="submit"><span class="fas fa-trash"></span></button>
                                  </form>
                                </div>
                                  {{-- <button class="btn btn-sm btn-phoenix-secondary me-1 fs--2"><span class="fas fa-pen"></span></button> --}}
                                </td>
                            </tr>
                              @endif
                            
                            @endforeach

                            </tbody>
                          </table>
                          <br><br>
                        </div>
                        
</div>
          </div>
          <footer class="footer">
          @if(session()->has('message'))
              <div id="alertRemove" class="alertfixed alert alert-soft-success d-flex align-items-center" role="alert"><span class="fas fa-check-circle text-success fs-3 me-3"></span>
              {{session()->get('message')}}</div>
            @endif
          </footer>
        </div>
@endsection
