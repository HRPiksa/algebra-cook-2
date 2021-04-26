<div class="card">
    <div class="card-header">
        Dobro došli <b> {{Auth::user()->firstname }} {{ Auth::user()->lastname}} </b>, na Algebra Cook administracijsko
        sučelje
    </div>
    
    <div class="card-body">
        <h4 style="text-align: left"><u> List of all users </u></h4>        
      
        @can('create-users', User::class)
        <div>
            <a href="{{ route('user-create') }}" class="btn btn-success">Add new user</a>
        </div>
        
        <br>
        @endcan

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all_users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->firstname . ' ' . $user->lastname}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        {{implode(', ', $user->roles()->pluck('name')->toArray())}}
                    </td>
                    @canany(['edit-users', 'delete-users'], User::class)
                    <td>
                        @can('edit-users', User::class)
                        <a href="{{route('user-edit', ['user' => $user->id])}}" class="btn btn-primary">Edit</a>
                        @endcan
                        @can('delete-users', User::class)
                        <a href="{{route('user-delete', ['user' => $user->id])}}" class="btn btn-warning">Delete</a>
                        @endcan
                    </td> 
                    @endcanany
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>