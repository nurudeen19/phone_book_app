@extends('layouts.app')
@section('css')
<style>
	.fontAwesome {
	  font-family: 'Helvetica', FontAwesome, sans-serif;
	}
</style>
@endsection
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 bg-secondary-subtle px-4 py-3">
			<h1 class="text-center fw-bold"><i class="fa fa-address-book" aria-hidden="true"></i> <span class="pl-3">Phone Book App</span> </h1>

			<div class="mt-5">
				<div class="row justify-content-between">
					<div class="col-sm-4">
						<h3>Contacts</h3>
					</div>
					<div class="col-sm-4">
						<button type="button" data-bs-toggle="modal" data-bs-target="#add_contact" class="btn btn-primary fw-bold float-end" @click="reset_input_fields"><i class="fa fa-plus"></i> Add Contact</button>
					</div>
					<div class="col-sm-12 mt-4">
						<form method="GET" action="#" @keyup="search_contact">
							<div class="mb-3">						  
							  <input type="text" class="form-control fontAwesome" placeholder="&#61442; Search for contact by last name..." v-model="query">
							</div>
						</form>
					</div>
					<div class="col-sm-12" v-if="contacts.length > 0">
						<ul class="list-group">
						  <li class="list-group-item p-3" v-for="c in contacts">
						  	<div class="row justify-content-between">
						  		<div class="col-sm-8">
						  			<h3>@{{ c.fname +' '+c.lname  }}</h3>
						  			<span class="text-secondary fs-5"><i class="fa fa-phone"></i> @{{ c.phone }} </span>
						  		</div>
						  		<div class="col-sm-4 pt-4">
						  			<button class="btn btn-primary float-end mx-3" type="button" @click="contact = c" data-bs-toggle="modal" data-bs-target="#edit_contact"><i class="fa fa-pencil"></i></button>
						  			<button class="btn btn-danger float-end" data-bs-toggle="modal" data-bs-target="#remove_contact" type="button" @click="contact = c"><i class="fa fa-trash"></i></button>
						  		</div>
						  	</div>
						  </li>
						</ul>
					</div>
					<div v-else>
						<p class="text-center"> Sorry Nothing to show!</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- Add new Contact Modal --}}
<div class="modal fade" tabindex="-1"id="add_contact" tabindex="-1" aria-labelledby="add_contact" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Contact</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" @submit.prevent="create_contact">
        	@csrf
        	<div class="mb-3">
        		<label>First Name</label>
        		<input type="text" class="form-control" v-model="new_contact.fname" required placeholder="please enter first name">
        	</div>
        	<div class="mb-3">
        		<label>Last Name</label>
        		<input type="text" class="form-control" v-model="new_contact.lname" required placeholder="please enter last name">
        	</div>
        	<div class="mb-3">
        		<label>Phone Number</label>
        		<input type="tel"  pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="form-control" v-model="new_contact.phone" placeholder="123-456-0789" required>
        	</div>
        	<div class="mb-3 float-end">
        		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        	<button type="submit" class="btn btn-primary mx-3" data-bs-dismiss="modal">Save Contact</button>
        	</div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Update Contact Modal --}}
<div class="modal fade" tabindex="-1"id="edit_contact" tabindex="-1" aria-labelledby="edit_contact" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Contact</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<form method="POST" @submit.prevent="update_contact">
        	@csrf
        	<div class="mb-3">
        		<label>First Name</label>
        		<input type="text" class="form-control" v-model="contact.fname" required placeholder="please enter first name">
        	</div>
        	<div class="mb-3">
        		<label>Last Name</label>
        		<input type="text" class="form-control" v-model="contact.lname" required placeholder="please enter last name">
        	</div>
        	<div class="mb-3">
        		<label>Phone Number</label>
        		<input type="tel"  pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="form-control" v-model="contact.phone" placeholder="123-456-0789" required>
        	</div>
        	<div class="mb-3 float-end">
        		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        	<button type="submit" class="btn btn-primary mx-3" data-bs-dismiss="modal" @click="contact_id = contact.id">Save Changes</button>
        	</div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1"id="remove_contact" tabindex="-1" aria-labelledby="remove_contact" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Remove Contact</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-danger text-center">Are you sure you want to Remove <span class="fw-bold text-dark">@{{ contact.fname +' '+contact.lname  }}</span> <br> Action is not reversible!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form method="post" @submit.prevent="remove_contact">
        	@csrf
        	@method('DELETE')
        	<button type="submit" data-bs-dismiss="modal" class="btn btn-danger" @click="contact_id = contact.id">Remove Contact</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
