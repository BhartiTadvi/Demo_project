<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($address->name) ? $address->name : ''}}" data-parsley-required="true">
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address1') ? 'has-error' : ''}}">
    <label for="address1" class="control-label">{{ 'Address1' }}</label>
    <input class="form-control" name="address1" type="text" id="address1" value="{{ isset($address->address1) ? $address->address1 : ''}}" data-parsley-required="true">
    {!! $errors->first('address1', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address2') ? 'has-error' : ''}}">
    <label for="address2" class="control-label">{{ 'Address2' }}</label>
    <input class="form-control" name="address2" type="text" id="address2" value="{{ isset($address->address2) ? $address->address2 : ''}}" data-parsley-required="true">
    {!! $errors->first('address2', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('country') ? 'has-error' : ''}}">
    <label for="country" class="control-label">{{ 'Country' }}</label>
    <select name="country" class="form-control" id="country" data-parsley-required="true">
         <option value="">Select country</option>
    @foreach ($countries as $country)
        <option value="{{$country->id}}">{{ $country->country_name }}</option>
    @endforeach
</select>
    {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
    <label for="state" class="control-label">{{ 'State' }}</label>

    <select name="state" class="form-control" id="state" data-parsley-required="true">
         <option value="">Select state</option>
        <option value="{{$country->id}}"></option>
  
</select>
    {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
    <label for="city" class="control-label">{{ 'City' }}</label>
    <input class="form-control" name="city" type="text" id="city" value="{{ isset($address->city) ? $address->city : ''}}" data-parsley-required="true">
    {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('zipcode') ? 'has-error' : ''}}">
    <label for="zipcode" class="control-label">{{ 'Zipcode' }}</label>
    <input class="form-control" name="zipcode" type="tex" id="zipcode" value="{{ isset($address->zipcode) ? $address->zipcode : ''}}" data-parsley-required="true" data-parsley-type="digits">
    {!! $errors->first('zipcode', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('mobileno') ? 'has-error' : ''}}">
    <label for="mobileno" class="control-label">{{ 'Mobileno' }}</label>
    <input class="form-control" name="mobileno" type="text" id="mobileno" value="{{ isset($address->mobileno) ? $address->mobileno : ''}}" data-parsley-required="true" data-parsley-type="digits">
    {!! $errors->first('mobileno', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    <a href="{{ url('/myAddress') }}"  class="btn btn btn-primary" title="Back"> Back</a>
</div>
