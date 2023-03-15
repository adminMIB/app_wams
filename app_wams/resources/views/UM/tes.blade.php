<table class="table" id="">
                    <thead>
                      <tr>
                        <th scope="col">NO</th>
                        <th scope="col">Nama Project</th>
                        <th scope="col">Nama Client</th>
                        <th scope="col">Nama Am</th>  
                        <th scope="col">Nama PM</th>  
                        <th scope="col">Nama Technikal</th>  
                        <th scope="col">Nilai Project</th>  
                        <th scope="col">Status Approve</th>  
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($dataProjects as $key => $item)
                        <tr>
                          {{-- {{$no += '1'}} --}}
                          <td>{{ $key + 1}}</td>
                          <td>{{ $item->NamaProject }}</td>
                          <td>{{ $item->NamaClient }}</td>
                          {{-- <td>{{$item->userTechnikals}}</td> --}}
                          @if ($item->userTechnikals != null)
                          @foreach ($item->userTechnikals as $value)
                            <td>{{ $value->AM->name }}</td>
                          @endforeach
                          @else
                            <td>{{ $item->name_user }}</td>
                          @endif
  
                          @if($item->ltoproject != null)
                            @foreach ($item->ltoproject as $value)
                              <td>{{ $value->pmo ?? null }}</td>
                            @endforeach
                          @else 
                            <td>{{ $item->pmo ?? null }}</td>
                          @endif
  
                          @if ($item->presales != null || $item->userTechnikalsPipe != null)
                            @if ($item->userTechnikalsPipe != null)
                              @foreach ($item->userTechnikalsPipe as $value)
                                <td>{{ $value->userTechnikal->name ?? null }}</td>
                                @endforeach
                              @else
                              <td>{{  $item->presales }}</td>
                            @endif
                          @elseif( $item->userTechnikals != null)
                            @foreach ($item->userTechnikals as $value)
                              <td>{{ $value->userTechnikal->name ?? null }}</td>
                            @endforeach
                          @endif
                        
                          @if ($item->contract_amount != null)
                            <td>{{ $item->contract_amount }}</td>
                          @else
                          @foreach ($item->ltoproject as $value)
                            <td>{{ $value->contract_amount ?? null }}</td>
                          @endforeach
                          @endif
                          <td>{{ $item->Status }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>