@extends('admin.layoutadmin')

@section('content')
{{-- <div class="content pt-5">

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">@</span>
        <input class="form-control" type="text" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <input class="form-control" type="text" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
        <span class="input-group-text" id="basic-addon2">@example.com</span>
    </div>
    <label class="form-label" for="basic-url">Your vanity URL</label>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
        <input class="form-control" id="basic-url" type="text" aria-describedby="basic-addon3">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text">$</span>
        <input class="form-control" type="text" aria-label="Amount (to the nearest dollar)">
        <span class="input-group-text">.00</span>
    </div>
    <div class="input-group">
        <span class="input-group-text">With textarea</span>
        <textarea class="form-control" aria-label="With textarea"></textarea>.
    </div>
</div> --}}
<div class="content pt-5">
    <h2 class="mb-2">Adicionar Imóvel</h2>
    <form role="form" method="POST" action="/properties" enctype="multipart/form-data">
        @csrf
        <div class="card shadow-none border border-300 my-4" data-component-card>
    
            <div class="p-4">
            <a href="/properties">
            <button class="btn-close" type="button" aria-label="Close"></button>        
            </a>
            <br>
            <br>
                <label class="form-label" for="tituloInput">Título do Imóvel</label>
                <div class="input-group mb-3">
                    <input class="form-control" required value="{{old('tituloInput')}}" id="tituloInput" name="tituloInput" placeholder="Título do imóvel" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                    @error('tituloInput')
                        <p>{{$errors->first('tituloInput')}}</p>
                    @enderror

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="inputPrice">Preço</label>
                        <div class="input-group mb-3"> 
                            <input class="form-control" placeholder="00.00" required value="{{old('inputPrice')}}" id="inputPrice" name="inputPrice">
                            <span class="input-group-text">€</span>
                            @error('inputPrice')
                                <p class="text-danger">{{$errors->first('inputPrice')}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-1"></div>                  
                    <div class="col-md-3">
                        <label class="form-label selp" for="selectPriceType">Tipo de Preço</label> 
                        <select class="form-select" required id="selectPriceType" name="selectPriceType">
                            <option value="DO" selected="selected" disabled>Selecione o tipo de preço</option>
                            @foreach($typePrice as $t_price)
                            @if(old('selectPriceType')==$t_price->id)
                                <option value="{{ $t_price->id }}" selected>{{ $t_price->typeprice }}</option>
                            @else
                                <option value="{{ $t_price->id }}">{{ $t_price->typeprice }}</option>
                            @endif
                            @endforeach
                        </select>
                            @error('selectPriceType')
                                <h6 class="text-danger">Selecione o tipo de preço!<h6>
                            @enderror
                    </div>  
                </div>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label" for="selectDistrict">Localização</label> 
                        <select class="form-select" required id="selectDistrict" name="selectDistrict">
                            <option value="DO" selected="selected" disabled>Selecione o distrito</option>
                            @foreach($locations as $local)
                            @if(old('selectDistrict')==$local->id)
                                <option value="{{ $local->id }}" selected>{{ $local->location }}</option>
                            @else
                                <option value="{{ $local->id }}">{{ $local->location }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('selectDistrict')
                           <h6 class="text-danger"> Selecione a localização do imóvel!<h6>
                        @enderror
                    </div>  
                </div>

                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label" for="selectPropertieType">Tipo Imóvel</label>
                        <select class="form-select" required id="selectPropertieType" name="selectPropertieType">
                            <option value="DO" selected="selected" disabled>Selecione o tipo de imóvel</option>
                            @foreach($typeProperty as $t_propertie)
                            @if(old('selectPropertieType')==$t_propertie->id)
                                <option value="{{ $t_propertie->id }}" selected>{{ $t_propertie->typeproperty }}</option>
                            @else
                                <option value="{{ $t_propertie->id }}">{{ $t_propertie->typeproperty }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('selectPropertieType')
                            <h6 class="text-danger">Selecione o tipo de imóvel!</h6>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label class="form-label" for="selectTypology">Tipologia</label> 
                        <select class="form-select" required id="selectTypology" name="selectTypology">
                            <option value="DO" selected="selected" disabled>Selecione a tipologia do imóvel</option>
                            @foreach($typology as $typo_properties)
                            @if(old('selectTypology')==$typo_properties->id)
                                <option value="{{ $typo_properties->id }}" selected>{{ $typo_properties->typology }}</option>
                            @else
                                <option value="{{ $typo_properties->id }}">{{ $typo_properties->typology }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('selectTypology')
                            <h6 class="text-danger">Selecione a tipologia do imóvel!</h6>
                        @enderror
                    </div>
                    <div class="col-md-1">
                            <label class="form-label" for="inputBath">NºWC</label> 
                        <div class="input-group mb-3">
                            <input class="form-control" required value="{{old('inputBath')}}" id="inputBath" name="inputBath">
                            @error('inputBath')
                                <p>{{$errors->first('inputBath')}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                            <label class="form-label" for="inputGrossArea">Área Bruta</label> 
                       <div class="input-group mb-3">
                            <input class="form-control" placeholder="Área Bruta" required value="{{old('inputGrossArea')}}" id="inputGrossArea" name="inputGrossArea">
                            @error('inputGrossArea')
                                <p>{{$errors->first('inputGrossArea')}}</p>
                            @enderror
                            <span class="input-group-text">m²</span>
                        </div>
                    </div>  
                    <div class="col-md-3">
                            <label class="form-label" for="inputArea">Área Útil</label> 
                        <div class="input-group mb-3">
                            <input class="form-control" placeholder="Área Útil" required value="{{old('inputArea')}}" id="inputArea" name="inputArea">
                            @error('inputArea')
                                <p>{{$errors->first('inputArea')}}</p>
                            @enderror
                            <span class="input-group-text">m²</span>
                        </div>
                    </div>      
                </div>

                <div class="input-group">
                    <span class="input-group-text" for="inputDesc">Descrição</span> 
                    <textarea class="form-control" id="inputDesc" name="inputDesc" placeholder="Descrição..." aria-label="With textarea" required>{{old('inputDesc')}}</textarea>
                </div>
                    @error('inputDesc')
                        <h6 class="text-danger">Insira uma descrição!</h6>      
                    @enderror

                
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label" for="selectWebsite">Website</label> 
                        <select class="form-select" required id="selectWebsite" name="selectWebsite">
                            <option value="DO" selected="selected" disabled>Selecione o website</option>
                            @foreach($propertyWebsite as $p_websites)

                             @if(old('selectWebsite')==$p_websites->id)
                                <option value="{{ $p_websites->id }}" selected>{{ $p_websites->website }}</option>
                            @else
                                <option value="{{ $p_websites->id }}">{{ $p_websites->website }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('selectWebsite')
                             <h6 class="text-danger">Selecione o website!</h6>    
                        @enderror
                    </div>
                    <div class="col-md-9">
                        <label class="form-label" for="inputLink">Link do Imóvel</label>
                        <div class="input-group mb-3">
                            <input class="form-control" placeholder="https://www.example.com" aria-label="Username" aria-describedby="basic-addon1" required value="{{old('inputLink')}}" id="inputLink" name="inputLink">
                            @error('inputLink')
                                <p>{{$errors->first('selectWebsite')}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Imagens</label>
                        <input class="form-control" id="images" required name="imageFile[]" type="file" multiple="multiple" max="3" oninput="imgPreview()">
                        <br>
                        
                        <div class="user-image mb-3 text-center">
                    
                            <div class="imgPreview" id="imgPrev"></div>
                            
                        </div>  
                    </div>
                        @error('imageFile')
                            <p>{{$errors->first('imageFile')}}</p>
                        @enderror
                         @error('imageFile.*')
                            @foreach($errors->all() as $error)
                                <p>{{$error->first('imageFile')}}</p>
                            @endforeach
                        @enderror  


                </div>

                <div class="row g-3">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-soft-warning me-1 mb-1" type="button" onclick="limparCreate()">Limpar</button>
                        </a>
                        <button class="btn btn-soft-primary me-1 mb-1" type="submit">Guardar</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- <script>
    function teste(){
    var inputTitulo = document.getElementById('tituloInput');
    inputTitulo.value = '';
    alert('afdaawdfawd')


}
</script> --}}
@endsection

