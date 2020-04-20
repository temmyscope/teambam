@extends('app')
@section('title', 'Profile')
@section('content')

	<?php use App\Helpers\HTML; ?> 

	<?= HTML::Card('Profile'); ?>
	
		<form action="{{ route('profile') }}" method="post">
      <div class="form-group">
      	<div class="form-row">
					<div class="col-md-6">
						<div class="form-label-group">
							<input type="text" value="{{ $dataSource->name }}" id="lastName" name="name" class="form-control" placeholder="Last name" disabled>
							<label for="lastName">Name</label>
						</div>
					</div>
              	</div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="number" id="inputage" value="{{ $dataSource->age }}" name="age" class="form-control" placeholder="Age">
                <label for="inputage"> Age</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                 <input type="text"  id="inputAddress" value="{{ $dataSource->address }}" name="address" class="form-control" placeholder="address">
                <label for="inputAddress">Address</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="number" maxlength="11" id="inputpnumber" value="{{ $dataSource->contact ?? '' }}" name="contact" class="form-control input-sm" placeholder="Phone Number">
                <label for="inputpnumber">Phone Number</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <select type="text" id="inputGender" name="gender" class="form-control" placeholder="Gender">
                  <option>Male</option>
                  <option>Female</option>
                  <option>Others</option>
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="inputEmail" value="{{ $dataSource->email }}" name="email" class="form-control" placeholder="Email Address" disabled>
                <label for="inputEmail">Email Address</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="inputZipcode" value="{{ $dataSource->zipcode ?? '' }}" name="zipcode" class="form-control" placeholder=" Zipcode">
                <label for="inputZipcode">Zipcode</label>
              </div>
            </div>
             <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="inputuser" value="{{ $dataSource->username ?? '' }}" name="username" class="form-control" placeholder="Username">
                <label for="inputuser">User Name</label>
              </div>
            </div>
			
            <button type="submit" class="btn btn-block btn-success" name="signups-submit">Save</button>
        </form>

@endsection