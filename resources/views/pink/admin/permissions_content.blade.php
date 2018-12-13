<div id="content-page" class="content group">
  <div class="hentry group">

      <h3 class="title_page">Привилегии</h3>
      <form action="{{route('admin.permissions.store')}}" method="POST">
          {{csrf_field()}}

          <div class="short-table while">

              <table style="width: 100%">

                  <thead>
                  <th>Привилегии</th>
                  @if(!$roles->isEmpty())
                     @foreach($roles as $item)
                         <th>{{$item->name}}</th>
                         @endforeach

                      @endif
                  </thead>

                  <tbody>
                  @if(!$priv->isEmpty())
                      @foreach($priv as $val)
                          <tr>
                            <td>{{$val->name}}</td>
                          @foreach($roles as $role)
                             <td>
                                 @if($role->hasPermission($val->name))
                                 <input checked name="" type="checkbox"value=""></td>
                              @else
                                      <input name="" type="checkbox"value=""></td>
                              @endif
                                  @endforeach
                          </tr>



                          @endforeach

                      @endif
                  </tbody>


              </table>



          </div>
          <input class="btn btn-the-salmon-dance-3"type="submit"value="Обновить"/>

      </form>



  </div>
</div>