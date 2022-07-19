@extends('layout')
@section('content')
			<!-- Titulo e botão de favoritos + ver no site -->
		<div style="padding-top: 120px;">
			<div>
				<div style="float: left; padding-left: 20px;">
					<div>
						<h3>{{ $propertie->name}}</h3>
					</div>
					<div>
						<h5>{{$propertie->TypePrice->typeprice}} - {{number_format($propertie->price, 0,',','.').'€' }}</h5>
					</div>
				</div>				
				<div>
				@if(Auth::user() != null)
						<form id="favorite-form-{{$propertie->id}}" method="POST" action="{{route('prop.favorite', $propertie->id)}}">
						@csrf
							@if(Auth::user()->favorite_props->where('pivot.properties_id', $propertie->id)->count() == 0)
							<div style="text-align: right; padding-right: 30px;" id="divFav">
								{{-- <input type="image" src="\images\fav_btns\noliked.png" class="ImgFav_button" border="0" alt="Submit" /> --}}
								<input type="image" src="\images\fav_btns\noliked.png" class="ImgFav_button" border="0"  />
							</div>
							@else
							<div style="text-align: right; padding-right: 30px;" id="divFav">
							{{-- <button class="RemoveFav_Button">
								<img src="\images\fav_btns\liked.png" class="ImgFav_button">
							</button> --}}
							{{-- <input type="image" src="\images\fav_btns\liked.png" class="ImgFav_button" border="0" alt="Submit" /> --}}
							<input type="image" src="\images\fav_btns\liked.png" class="ImgFav_button" border="0"  />
							</div>
							@endif
						</form>

{{-- {{$propertie->favorite_to_user->count()}} --}}

					@endif








					{{-- <div style="text-align: right; padding-right: 30px;" id="divFav">
						<input type="image" src="\images\fav_btns\noliked.png" class="ImgFav_button" border="0"  />
					</div> --}}
					<br>
					<br>
					<br>
					<div style="text-align: right; padding-right: 15px;">						
						<button class="btn btn-primary" onclick="window.open('{{ $propertie->url }}')">
      						ver no site
    					</button>
					</div>
				</div>
			</div>
      	</div>
<section class="ftco-section ftco-property-details">
	<div class="container">
		<div class="row">
			<div class="col-md-3">	
				<div style="float: left; width: 300px;">
				
					<p> <b>Tipologia:</b> {{$propertie->TypeProperty->typeproperty}} {{$propertie->TypologyProperty->typology}}</p>
					<p><b>Localização:</b> {{$propertie->Locations->location}}</p>
					@if($propertie->usefull_area != 0)
						<p><b>Área Útil:</b> {{number_format($propertie->usefull_area, 0,',','.').' m²' }}</p>
					@endif
					@if($propertie->gross_area != 0)
						<p><b>Área Bruta:</b> {{number_format($propertie->gross_area, 0,',','.').' m²' }}</p>
					@endif
					@if ($propertie->bathrooms != 0)
						<p><b>Casas de Banho:</b> {{$propertie->bathrooms}}</p>
					@endif
				</div>
			</div>
        

{{-- !=========================/ Teste /=================================== --}}
{{-- ! depois do teste apagar(se necessário): [css no Style.css] [ficheiro: 'propertieSlide.js' e seu link no layout desta página] --}}
{{-- ! atenção, para o script funcionar, ele tem que estar no fim da página(baixo) --}}

	<div class="col-md-7">
	
		<div class="bd-example">
		  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
		    <ol class="carousel-indicators">
			<?php $i = 0; ?>
			{{-- {{$i=0}} --}}
			@foreach($imagens as $imagem)
				@if($i != 0)
		      		<li data-target="#carouselExampleCaptions" data-slide-to="{{$i}}"></li>
					{{-- {{$i += 1 }} --}}
				@else	
		      		<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
				{{-- {{$i += 1 }} --}}
				@endif
				<?php $i += 1; ?>
			@endforeach
			</ol>

			<div class="carousel-inner">
		      @foreach($imagens as $imagem)
				@if($imagem == $imagens[0])
			  <div class="carousel-item active">
		        <img src="/uploads/{{$propertie->id}}/{{$imagem}}" class="d-block w-100" width=800 height=400>

		      </div>
				@else
			  <div class="carousel-item">
		        <img src="/uploads/{{$propertie->id}}/{{$imagem}}" class="d-block w-100" width=800 height=400>
		      </div>
				@endif
			  @endforeach
		    </div>
		    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
		      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		      <span class="sr-only">Previous</span>
		    </a>
		    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
		      <span class="carousel-control-next-icon" aria-hidden="true"></span>
		      <span class="sr-only">Next</span>
		    </a>
		  </div>
		</div>

	</div>
<div>
{{-- !=========================!=========================!========================= --}}






          {{-- <div class="img"><img src="images/work-1.jpg" id="bigImage" alt="" style="width: 600px; height: 396px;"></div>

          <div style="padding-top: 6px; padding-left: 300px;">
            <div style="float: left; background-color: black; width: 200px; height: 132px;" ><img class="littleImg" src="images/image_1.jpg" id="img1" alt=""  style="width: 200px; height: 132px;" onclick="SetImageName(this.id)"></div>
            <div style="float: left; background-color: black; width: 200px; height: 132px;"><img class="littleImg" src="images/image_2.jpg" id="img2" alt="" style="width: 200px; height: 132px;" onclick="SetImageName(this.id)"></div>
            <div style="float: left; background-color: black; width: 200px; height: 132px;"><img class="littleImg" src="images/image_3.jpg" id="img3" style="width: 200px; height: 132px; background-color: black;" onclick="SetImageName(this.id)"></div>
            
          </div> --}}
        </div>
        <br>
      	<div class="row" style="display: inline;">
      		<div class="col-md-12 pills">
						<div class="bd-example bd-example-tabs">
							<div class="d-flex justify-content-center">
							  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

							    <li class="nav-item">
							      {{-- <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Descrição</a> --}}
							    	<div>Descrição</div>
								</li>
							    {{-- <li class="nav-item">
							      <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab" aria-controls="pills-review" aria-expanded="true">Evolução do Preço</a>
							    </li> --}}
							  </ul>
							</div>

						  <div class="tab-content" id="pills-tabContent">
						    <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
								{{-- <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
								<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
						     --}}
							{{$propertie->descricao}}
							</div>
						    <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">						      
						    </div>
						  </div>
						</div>
		      </div>
				</div>
      </div>
</section>
<script>


</script>

@endsection
