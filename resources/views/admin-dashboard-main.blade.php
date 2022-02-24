<div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        
                        <div class="row justify-content-end">
                            <div class="col-md-2">
                            <a href="/dashboard/customers/add">
                            <button class="btn btn-primary">    
                                Add New Customer
                            </button>
                            </a><br/>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               Customers Table
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>DOB</th>
                                            <th>Company</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>DOB</th>
                                            <th>Company</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                            @if($data['Customers'])
                                            @foreach($data['Customers'] as $Customer)
                                            <tr>
                                                <td>
                                                    {{$Customer->name}}
                                                </td>
                                                <td>
                                                    {{$Customer->dob}}
                                                </td>
                                                <td>
                                                    {{$Customer->company}}
                                                </td>
                                                <td style="display:flex">
                                                    <a href="/dashboard/customers/edit/{{$Customer->id}}" class="btn btn-primary">Edit</a>
                                                    &nbsp
                                                    <form action="/dashboard/customers/delete/{{$Customer->id}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="delete">
                                                        <input type="submit" value="Remove" class="btn btn-danger">
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>