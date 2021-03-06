<h5>Dear {{$user->username}}, Welcome to Admin Dashboard</h5>
<br/>
 <!-- Default panel contents -->
  <div class="panel-heading">User's List</div>
  <!-- Table -->
  <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>user Name</th>
            <th>Name</th>
            <th>Email Address</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->getId()}}</td>
                <td>{{$user->getUsername()}}</td>
                <td>{{$user->getFirstName() . ' ' . $user->getLastName()}}</td>
                <td>{{$user->getEmail()}}</td>
                <td><a href="{{ URL::to('admin/userdetails') . '/' . $user->getId()}}" class="btn btn-primary">Account Details</a>
                    <a href="{{ URL::to('account/create') .'/' . $user->getId()}}" class="btn btn-primary">Create Account</a>
                </td>
            </tr>
            @endforeach
        </tbody>
  </table>
<br/>

@if (count($unapprovedAccounts) != 0)
<div class="panel-heading">Account's List For Admin Approval</div>
<table class="table">
      <tbody>
          @foreach ($unapprovedAccounts as $account)
          <tr>
              <td>A/C. {{$account->getAccountNo()}}</td>
              <td>Applied From {{ $account->getUser()->getFirstName() .' '. $account->getUser()->getLastName()}}</td>
              <td><a href="{{ URL::to('account/approve') . '/' . $account->getId()}}" class="btn btn-primary">Approve</a></td>
          </tr>
          @endforeach
      </tbody>
</table>
@endif

<a class="btn btn-success" href="{{ URL::to('users/register') }}">Create New User</a>