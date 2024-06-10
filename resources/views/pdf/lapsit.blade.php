<table class="table table-bordered">
                <thead>
                  <tr>
                    <th>
                      No
                    </th>
                    <th>
                      Jenis Kejadian
                    </th>
                    <th>
                      Lokasi
                    </th>
                    <th>
                      Waktu Kejadian
                    </th>
                    <th>
                      Terakhir Update
                    </th>
                    <th>
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td>
                      <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal"><i
                          class="menu-icon mdi mdi-information"></i></a>
                      <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#shareModal"><i
                          class="menu-icon mdi mdi-share-variant"></i></a>
                    </td>
                  </tr>
                  
                </tbody>
              </table>
