@extends('layout')
@section('content')
		<section class="ftco-section contact-section">
      <div class="container">
        <div class="row d-flex mb-5 contact-info justify-content-center">
        	<div class="col-md-8">
            <br><br><br><br>
        		<div class="row mb-5">
		          <div class="col-md-4 text-center py-4">
		          </div>
		          <div class="col-md-4 text-center py-4">
		          	<div class="icon">
		          		<span class="icon-envelope-o" style="color: #00ccff;"></span>
		          	</div>
		            <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
		          </div>
		        </div>
          </div>
        </div>
        <div class="row block-9 justify-content-center mb-5">
          <div class="col-md-8 mb-md-5">
            <br><br><br><br><br>
          	<h2 class="text-center">Se você tiver alguma dúvida
              por favor, não hesite em nos enviar uma mensagem</h2>
            <form action="#" class="bg-light p-5 contact-form">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Nome">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Email@exemplo.com">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Assunto">
              </div>
              <div class="form-group">
                <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Mensagem"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Enviar" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          
          </div>
        </div>
      </div>
    </section>
@endsection