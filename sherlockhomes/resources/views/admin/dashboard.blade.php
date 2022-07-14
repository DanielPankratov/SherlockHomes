@extends('admin.layoutadmin')

@section('content')
<div class="content pt-5">
          <div class="pb-5">
            <div class="row g-5">
              <div class="col-12 col-xxl-6">
                <div class="mb-8">
                  <h2 class="mb-2">Estatisticas</h2>
                  {{-- <h5 class="text-700 fw-semi-bold">Here’s what’s going on at your business right now</h5> --}}
                </div>
                <div class="row align-items-center g-4">
                  <div class="col-12 col-md-auto">
                    <div class="d-flex align-items-center">
                    <img src="images/icons/illustrations/4.png" alt="" height="46" width="46">
                      <div class="ms-3">
                        <h4 class="mb-0">Imóveis</h4>
                        <p class="text-800 fs--1 mb-0">{{$numProperties}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-auto">
                    <div class="d-flex align-items-center"><img src="images/icons/illustrations/2.png" alt="" height="46" width="46">
                      <div class="ms-3">
                        <h4 class="mb-0">Utilizadores</h4>
                        <p class="text-800 fs--1 mb-0">{{$numUsers}}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mx-n6 bg-white px-6 pt-7 border-y border-300">
            <div class="row">
              <div data-list='{"valueNames":["product","customer","rating","review","time"],"page":6}'>
                <div class="row align-items-end justify-content-between pb-5 g-3">
                  <div class="col-auto">
                    <h3>Adicionados Recentemente</h3>
                    <p class="text-700 lh-sm mb-0">Imóveis recentes na Base de Dados</p>
                  </div>
                  <div class="col-12 col-md-auto">
                    <div class="row g-2">
                      <div class="col-auto flex-1">
                        <div class="search-box">
                          <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input class="form-control form-control-sm search-input search" type="search" placeholder="Pesquisar" aria-label="Search"> <span class="fas fa-search search-box-icon"></span></form>
                        </div>
                      </div>

                    {{-- <div class="col-auto">
                        <button class="btn btn-sm btn-phoenix-secondary ms-2 bg-white hover-bg-100" type="button"><span class="fas fa-trash"></span></button>
                    </div> --}}
                </div>
                  </div>
                </div>
                <div class="table-responsive mx-n1 px-1 scrollbar">
                  <table class="table fs--2 mb-0 overflow-hidden">
                    <thead>
                      <tr>
                        <th class="white-space-nowrap fs--1 border-top ps-0 align-middle">
                          <div class="form-check mb-0 fs-0"></div>
                        </th>
                        <th class="sort border-top white-space-nowrap align-middle" scope="col"></th>
                        <th class="sort border-top white-space-nowrap align-middle" scope="col" style="min-width:360px;" data-sort="product">TITULO</th>
                        <th class="sort border-top align-middle" scope="col" data-sort="customer" style="min-width:200px;">PREÇO</th>
                        <th class="sort border-top align-middle" scope="col" data-sort="rating" style="min-width:110px;">TIPO IMÓVEL</th>
                        <th class="sort border-top align-middle" scope="col" style="max-width:350px;" data-sort="review">TIPOLOGIA</th>
                        <th class="sort border-top text-end align-middle" scope="col" data-sort="time">TIME</th>
                        <th class="sort border-top text-end pe-0 align-middle" scope="col">ACTION</th>
                      </tr>
                    </thead>
                    <tbody class="list" id="table-latest-review-body">
                    @foreach($recentProperties as $propertie)
                     <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="fs--1 align-middle ps-0" style="width: 28px;"></td>
                         <td class="align-middle product white-space-nowrap py-0">

                         <?php
						                $all_imgs = File::files(public_path('uploads\\'.$propertie->id));
						                $filecount = count($all_imgs);

						                if($filecount != 0)
						                	$imagem = basename($all_imgs[0]);												
				                	?>
        	@if($filecount != 0)
                         <img src="/uploads/{{$propertie->id}}/{{$imagem}}" alt="" width="53"></td>
                        <td class="align-middle customer white-space-nowrap" style="min-width:360px;">
                            <h6 class="mb-0 ms-3 text-900">{{$propertie->name }}</h6>
                        </td>
                        <td class="align-middle customer white-space-nowrap" style="min-width:200px;">
                          <div class="d-flex align-items-center">
                          {{-- number_format($Expense->price, 2) }} --}}
                            {{-- <h6 class="mb-0 ms-3 text-900 priceNumber">{{$propertie->price.'€' }}</h6> --}}
                            <h6 class="mb-0 ms-3 text-900 priceNumber">{{number_format($propertie->price, 0,',','.').'€' }}</h6>
                          </div>
                        </td>
                        <td class="align-middle rating white-space-nowrap" style="min-width:110px;">
                          <h6>{{$propertie->typologyproperty->typology}}</h6>
                        </td>
                        <td class="align-middle text-start ps-5 status">
                          <h6>{{$propertie->typeproperty->typeproperty }}</h6>
                        </td>
                        <td class="align-middle text-end time white-space-nowrap">
                          <div class="hover-hide">
                            <h6 class="text-1000 mb-0">{{$propertie->created_at}}</h6>
                          </div>
                        </td>
                        <td class="align-middle white-space-nowrap text-end pe-0">
                          <div class="position-relative">
                            <div class="hover-actions">
                            <a href="propertie/{{$propertie->id}}/edit">
                              <button class="btn btn-sm btn-phoenix-secondary me-1 fs--2"><span class="fas fa-pen"></span></button></div>
                            </a>
                          </div>
                          <div class="font-sans-serif btn-reveal-trigger">


                      <form role="form" method="POST" action="/propertie/{{$propertie->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
              
                          <button class="btn btn-sm btn-phoenix-secondary fs--2 link" type="submite" name="remove" >
                            <span class="fas fa-trash"></span>
                          </button>
                      </form>


                          </div>
                        </td>
                      </tr>
                       @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="row align-items-center py-2">
                  <div class="pagination d-none"></div>
                  <div class="col d-flex fs--1">
                    <p class="mb-0 d-none d-sm-block me-3 fw-semi-bold text-900" data-list-info></p><a class="fw-semi-bold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semi-bold d-none" href="#!" data-list-view="less">View Less</a>
                  </div>
                  <div class="col-auto d-flex"><button class="btn btn-link px-1 me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left me-2"></span>Previous</button><button class="btn btn-link px-1 ms-1" type="button" title="Next" data-list-pagination="next">Next<span class="fas fa-chevron-right ms-2"></span></button></div>
                </div>
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
