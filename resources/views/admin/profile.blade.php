@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        Team
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Team</li>
    </ol>
</section>
<section class="content">

      <div class="row">
        <div class="col-md-1">

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
             
              <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              
              <!-- /.tab-pane -->
              	<div class="active tab-pane" id="profile">
                	<div class="box box-primary">
			            <div class="box-body box-profile">
			              <img class="profile-user-img img-responsive img-circle" src="/{{Auth::user()['avatar']}}" alt="User profile picture">

			              <h3 class="profile-username text-center"><b>Name: </b>{{Auth::user()['name']}}</h3>

			              <p class="text-muted text-center"><b>Role: </b>Admin</p>
			              <p class="text-muted text-center"><b>Email: </b>{{Auth::user()['email']}}</p>
			              <p class="text-muted text-center"><b>Phone: </b>{{Auth::user()['phone_no']}}</p>
			              <p class="text-muted text-center"><b>Address: </b>{{Auth::user()['address']}}</p>

			              	<!-- <ul class="list-group list-group-unbordered">
				                <li class="list-group-item">
				                  <b>Followers</b> <a class="pull-right">1,322</a>
				                </li>
				                <li class="list-group-item">
				                  <b>Following</b> <a class="pull-right">543</a>
				                </li>
				                <li class="list-group-item">
				                  <b>Friends</b> <a class="pull-right">13,287</a>
				                </li>
			              	</ul> 
			              	<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
			              	-->

			              
			            </div>
			            <!-- /.box-body -->
			          </div>
              	</div>
          		<div class="tab-pane" id="settings">
	                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{route('profile.update',Auth::user()['id'])}}">
	                	{{csrf_field()}}
	                  <div class="form-group">
	                    <label for="inputName" class="col-sm-2 control-label">Name</label>

	                    <div class="col-sm-10">
	                      <input type="text" name="name" class="form-control" value="{{Auth::user()['name']}}"  id="inputName" placeholder="Name">
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="inputAvatar" class="col-sm-2 control-label">Avatar</label>

	                    <div class="col-sm-10">
	                      <input type="file" name="avatar" class="form-control" id="inputAvatar" placeholder="Avatar">
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
	                    <div class="col-sm-10">
	                      <input type="email" name="email" value="{{Auth::user()['email']}}" class="form-control" id="inputEmail" placeholder="Email">
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="inputPhone" class="col-sm-2 control-label">Phone Number</label>
	                    <div class="col-sm-10">
	                      <input type="text" name="phone_no" value="{{Auth::user()['phone_no']}}" class="form-control" id="inputPhone" placeholder="Phone Number">
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label for="inputAddress" class="col-sm-2 control-label">Address</label>
	                    <div class="col-sm-10">
	                      <input type="text" name="address" value="{{Auth::user()['address']}}" class="form-control" id="inputAddress" placeholder="Address">
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <div class="col-sm-offset-2 col-sm-10">
	                      <button type="submit" class="btn btn-danger">Submit</button>
	                    </div>
	                  </div>
	                </form>
              	</div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
	            	


@endsection
