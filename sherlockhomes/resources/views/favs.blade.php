@extends('layout')
@section('content')
		<section class="ftco-section">
    	<div class="container">
        <div>
          <p><b>Resultados:</b>{{$favProperties->count()}}</p>
		  			{{-- @dd($favorite_Properties_Ids) --}}
						  
					  {{-- {{$favProperties->count()}} --}}
        </div>
        <div class="row">
			{{-- @foreach($favProperties as $propertie) --}}
			@foreach($favProperties as $propertie)
			<div class="col-md-4">
        		<div class="property-wrap ftco-animate">
				{{-- ! a linha abaixo tem que ser analisada --}}
        			{{-- <div href="properties-single.html" class="img" style="background-image: url(/uploads/{{$propertie->id}}/1.jpg);"> --}}
        			<?php
						$all_imgs = File::files(public_path('uploads/'.$propertie->id));
						$filecount = 0;
						$imagem = basename($all_imgs[0]);						
					?>
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
		@endforeach
			{{-- <div class="col-md-4">
        		<div class="property-wrap ftco-animate">
        			<a href="properties-single.html" class="img" style="background-image: url(images/work-1.jpg);"></a>
        			<div class="text">
						<h3  class="titulo-cortar"><a href="properties-single.html">Vendo T3/Porto</a></h3>
        				<p class="price"><span class="orig-price" style="color: red;">200.000€</span></p>
        				<ul class="property_list">
        					<li><span class="flaticon-bed"></span>3</li>
        					<li><span class="flaticon-bathtub"></span>1</li>
        					<li><span class="flaticon-floor-plan"></span>971 m²</li>
        				</ul>
        				<span class="icon icon-map-marker"></span>
						<span class="location">&nbsp;&nbsp;Porto</span>
        				<a href="properties-single.html" class="d-flex align-items-center justify-content-center btn-custom">
        					<span class="ion-ios-link"></span>
        				</a>
        			</div>
        		</div>
        	</div>
			<div class="col-md-4">
        		<div class="property-wrap ftco-animate">
        			<a href="properties-single.html" class="img" style="background-image: url(images/work-1.jpg);"></a>
        			<div class="text">
						<h3 class="titulo-cortar"><a href="properties-single.html">Moradia T4 para comprar em Coimbra</a></h3>
        				<p class="price"><span class="orig-price" style="color:rgb(0, 255, 21);">115.000€</span></p>
        				<ul class="property_list">
        					<li><span class="flaticon-bed"></span>4</li>
        					<li><span class="flaticon-bathtub"></span>1</li>
        					<li><span class="flaticon-floor-plan"></span>100.878 m²</li>
        				</ul>
        				<span class="icon icon-map-marker"></span>
						<span class="location">&nbsp;&nbsp;Coimbra</span>
        				<a href="properties-single.html" class="d-flex align-items-center justify-content-center btn-custom">
        					<span class="ion-ios-link"></span>
        				</a>
        			</div>
        		</div>
        	</div>
			<div class="col-md-4">
        		<div class="property-wrap ftco-animate">
        			<a href="properties-single.html" class="img" style="background-image: url(images/work-1.jpg);"></a>
        			<div class="text">
						<h3 class="titulo-cortar"><a href="properties-single.html">Moradia T5 para alugar</a></h3>
        				<p class="price"><span class="orig-price">3.500€ <small>/mês</small></span></p>
        				<ul class="property_list">
        					<li><span class="flaticon-bed"></span>5</li>
        					<li><span class="flaticon-bathtub"></span>3</li>
        					<li><span class="flaticon-floor-plan"></span>563 m²</li>
        				</ul>
        				<span class="icon icon-map-marker"></span>
						<span class="location">&nbsp;&nbsp;Aveiro</span>
        				<a href="properties-single.html" class="d-flex align-items-center justify-content-center btn-custom">
        					<span class="ion-ios-link"></span>
        				</a>
        			</div>
        		</div>
        	</div>
			<div class="col-md-4">
        		<div class="property-wrap ftco-animate">
        			<a href="properties-single.html" class="img" style="background-image: url(images/work-1.jpg);"></a>
        			<div class="text">
						<h3 class="titulo-cortar"><a href="properties-single.html">Quarto</a></h3>
        				<p class="price"><span class="orig-price">200€<small>/mês</small></span></p>
        				<ul class="property_list">
        					<li><span class="flaticon-bed"></span>1</li>
        					<li><span class="flaticon-floor-plan"></span>1 m²</li>
        				</ul>
        				<span class="icon icon-map-marker"></span>
						<span class="location">&nbsp;&nbsp;Leiria</span>
        				<a href="properties-single.html" class="d-flex align-items-center justify-content-center btn-custom">
        					<span class="ion-ios-link"></span>
        				</a>
        			</div>
        		</div>
        	</div> --}}
        </div>
        {{-- <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div> --}}
    	</div>
    </section>
@endsection