<div style="padding:20px;">
<form method="post" action="{{$data['action']}}">
<h3>
    @if($data && array_key_exists('customer',$data)) 
        Edit Customer
    @else
        Add New Customer
    @endif
</h3>
@csrf
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Customer Name" value="@if($data && array_key_exists('customer',$data) && $data['customer']->name){{$data['customer']->name}}@endif">
  </div>
    @error('name')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror
  <div class="form-group">
    <label for="dob">DOB</label>
    <input type="date" name="dob" max="<?=date('Y-m-d',strtotime('now'))?>" class="form-control" id="dob" placeholder="DOB" value="@if($data && array_key_exists('customer',$data) && $data['customer']->dob){{$data['customer']->dob}}@endif"
    >
  </div>
  @error('dob')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror
  <div class="form-group">
    <label for="company">Company</label>
    <input type="text" name="company" class="form-control" id="company" placeholder="Enter Company" value="@if(array_key_exists('customer',$data) && $data['customer']->company){{$data['customer']->company}}@endif">
  </div>
  @error('company')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror
    @if($data && array_key_exists('customer',$data) && $data['customer']->id)
    <input type="hidden" name="_method" value="PUT">
    @endif
  <button type="submit" class="btn btn-primary">
      @if($data && array_key_exists('customer',$data))
        Update
      @else
        Save
      @endif
  </button>
</form>
</div>