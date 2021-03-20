@if ($message = Session::get('success'))
<div class="alert alert-success alert-block text-left">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong><i class="fa fa-check"></i> {{ $message }}</strong>
</div>
@endif
  
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block text-left">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong><i class="fa fa-exclamation-triangle"></i> {{ $message }}</strong>
</div>
@endif
   
@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block text-left">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong><i class="fa fa-exclamation-triangle"></i> {{ $message }}</strong>
</div>
@endif
   
@if ($message = Session::get('info'))
<div class="alert alert-info alert-block text-left">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong><i class="fa fa-lightbulb"></i> {{ $message }}</strong>
</div>
@endif
  
@if ($errors->any())
<div class="alert alert-danger text-left">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <i class="fa fa-exclamation-triangle"></i> Por favor, verifique o formulário abaixo há erros.
</div>
@endif