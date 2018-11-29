
@if($menu)

   <div class="menu classic">
  <ul id="nav" class="menu">
@include(env('THEME').'.customMenuItems',['items'=>$MyNav->roots()])

  </ul>
   </div>



@endif

