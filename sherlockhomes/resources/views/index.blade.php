@extends('layout')

@section('content')
  <div class="hero-wrap ftco-degree-bg" style="background-image: url('images/bg_1.jpg');"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text justify-content-center align-items-center">
        <div class="col-lg-8 col-md-6 ftco-animate d-flex align-items-end">
          <div class="searchbar-align">
            <img class="imagemHome" src="images/ShieldSearch-removebg-preview (1).png" alt="">
            <form action="{{url('/results/')}}" type="get" class="search-location mt-md-5">
              <div class="row justify-content-center">
                <div class="col-lg-10 align-items-end">
                  <div class="form-group">
                    <div class="form-field">
                      <div class="dropdownSRC">
                        <input type="search" id="myInputSRC" class="form-control dropbtnSRC" placeholder="Pesquise por um imóvel" name="query"/>
                      <button type="submit"><span class="ion-ios-search"></span></button>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <!-- --------------dropdownbar -->
            <div class="dropdown-filters">
              <div class="dropdown">
                <select class="form-select form-select-lg mb-3 DropdownFilters" aria-label=".form-select-lg example" name="selectPriceType">
                  <option value="Todos" selected>Todos</option>
                  @foreach($typePrice as $t_price)                           
                    <option value="{{ $t_price->id }}">{{ $t_price->typeprice }}</option>
                  @endforeach
                </select>
              </div>
              <div class="dropdown">
                <select class="form-select form-select-lg mb-3 DropdownFilters" aria-label=".form-select-lg example" name="selectPropertieType">
                  <option value="Todos" selected>Todos</option>
                  @foreach($typeProperty as $t_property)                           
                    <option value="{{ $t_property->id }}">{{ $t_property->typeproperty }}</option>
                  @endforeach
                </select>
              </div>
              <div class="dropdown">
                <select class="form-select form-select-lg mb-3 DropdownFilters" aria-label=".form-select-lg example" name="selectTypology">
                  <option value="Todos" selected>Todos</option>
                  @foreach($typology as $tpg)                           
                    <option value="{{ $tpg->id }}">{{ $tpg->typology }}</option>
                  @endforeach
                </select>
              </div>
              <div class="dropdown">
                <select class="form-select form-select-lg mb-3 DropdownFilters" aria-label=".form-select-lg example" name="selectDistrict">
                  <option value="Todos" selected>Todos</option>
                  @foreach($locations as $local)                           
                    <option value="{{ $local->id }}">{{ $local->location }}</option>
                  @endforeach
                </select>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mouse">
      <a href="#" class="mouse-icon">
        <div class="mouse-wheel"><span class="ion-ios-arrow-round-down"></span></div>
      </a>
    </div>
  </div>

  <section class="ftco-section goto-here">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          <span class="subheading">Novidades</span>
          <h2 class="mb-2">Novos Imóveis</h2>
        </div>
      </div>
      <div class="row">
       @foreach($properties as $propertie)
				<?php
						$all_imgs = File::files(public_path('uploads\\'.$propertie->id));
						$filecount = count($all_imgs);
						
						if($filecount != 0)
							$imagem = basename($all_imgs[0]);												
					?>
      @if($filecount != 0)
          
			<div class="col-md-4">
        		<div class="property-wrap ftco-animate">
					<div class="img" style="background-image: url(/uploads/{{$propertie->id}}/{{$imagem}});" > 
					{{-- onclick="location.href='/prop/{{ $propertie->id }}';" style="cursor:pointer;" --}}
					@if(Auth::user() != null)
						<form id="favorite-form-{{$propertie->id}}" method="POST" action="{{route('prop.favorite', $propertie->id)}}">
						@csrf
							@if(Auth::user()->favorite_props->where('pivot.properties_id', $propertie->id)->count() == 0)
							<div id="divFav">
								{{-- <input type="image" src="\images\fav_btns\noliked.png" class="ImgFav_button" border="0" alt="Submit" /> --}}
								<input id="submit{{$propertie->id}}" type="image" src="\images\fav_btns\noliked.png" class="ImgFav_button" border="0"  />
							</div>
							@else
							<div id="divFav">
							{{-- <button class="RemoveFav_Button">
								<img src="\images\fav_btns\liked.png" class="ImgFav_button">
							</button> --}}
							{{-- <input type="image" src="\images\fav_btns\liked.png" class="ImgFav_button" border="0" alt="Submit" /> --}}
							<input id="submit{{$propertie->id}}" type="image" src="\images\fav_btns\liked.png" class="ImgFav_button" border="0" onclick="return sub_fav()" />
							</div>
							@endif
						</form>
						<script>
							$("#favorite-form-{{$propertie->id}}").submit(function(){								
								$.ajax({
										url: "favorite/{{$propertie->id}}/add",
										cache: false,
										data:{"_token": "{{ csrf_token() }}"},
										type:"POST",
										success: function (msg) {
										}
									});

								if($('#submit{{$propertie->id}}').attr('src') == "\\images\\fav_btns\\liked.png"){
									$('#submit{{$propertie->id}}').attr('src','\\images\\fav_btns\\noliked.png');
								}else
								{
									$('#submit{{$propertie->id}}').attr('src','\\images\\fav_btns\\liked.png');
								}

							return false;	
							});

						</script>
					@endif
					</div>
        			<div class="text" onclick="location.href='/prop/{{ $propertie->id }}';" style="cursor:pointer;">
						<h3 class="titulo-cortar">{{$propertie->name}}</h3>
						
					
        				<p class="price"><span class="orig-price">{{number_format($propertie->price, 0,',','.').'€' }}
											@if($propertie->typepropertie_id == 2)
												<small>/mês</small>
											@endif
										 </span>
						</p>
        				<ul class="property_list">
						@if($propertie->typology_id == 1)
        					<li><span class="flaticon-bed"></span>0</li>
						@elseif($propertie->typology_id == 2)
        					<li><span class="flaticon-bed"></span>1</li>
						@elseif($propertie->typology_id == 3)
        					<li><span class="flaticon-bed"></span>2</li>
						@elseif($propertie->typology_id == 4)
        					<li><span class="flaticon-bed"></span>3</li>
						@elseif($propertie->typology_id == 5)
        					<li><span class="flaticon-bed"></span>4</li>
						@elseif($propertie->typology_id == 6)
        					<li><span class="flaticon-bed"></span>5</li>
						@else
        					<li><span class="flaticon-bed"></span>+5</li>
						@endif
        				
							<li><span class="flaticon-bathtub"></span>{{$propertie->bathrooms}}</li>
							@if($propertie->usefull_area != 0)
        						<li><span class="flaticon-floor-plan"></span>{{number_format($propertie->usefull_area, 0,',','.')}}m²</li>
							@endif
        				</ul>
        				<span class="icon icon-map-marker"></span>
						<span class="location">&nbsp;&nbsp;{{$propertie->Locations->location}}</span>
        				<div class="d-flex align-items-center justify-content-center btn-custom2">
							@if($propertie->propertywebsite_id == 1)
								<img src="\images\sapo2logo.png"  style="padding-right: 50px;" width=300%/>
							@elseif($propertie->propertywebsite_id == 2)
								<img src="\images\imovirtual.png"  style="padding-right: 50px;" width=300%/>
							@else
								<img src="\images\bpi.png"  style="padding-right: 50px;" width=300%/>
							@endif

						</div>
        			</div>
        		</div>
        	</div>
          @endif
		@endforeach
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-no-pb">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          <h2 class="mb-2">The smartest way to buy a home</h2>
        </div>
      </div>
      <div class="row d-flex">
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services d-block text-center">
            <div class="icon d-flex justify-content-center align-items-center"><span class="flaticon-piggy-bank"></span>
            </div>
            <div class="media-body py-md-4">
              <h3>No Downpayment</h3>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services d-block text-center">
            <div class="icon d-flex justify-content-center align-items-center"><span class="flaticon-wallet"></span>
            </div>
            <div class="media-body py-md-4">
              <h3>All Cash Offer</h3>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services d-block text-center">
            <div class="icon d-flex justify-content-center align-items-center"><span class="flaticon-file"></span></div>
            <div class="media-body py-md-4">
              <h3>Experts in Your Corner</h3>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services d-block text-center">
            <div class="icon d-flex justify-content-center align-items-center"><span class="flaticon-locked"></span>
            </div>
            <div class="media-body py-md-4">
              <h3>Lokced in Pricing</h3>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection
