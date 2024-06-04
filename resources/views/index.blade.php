<x-layout>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Login</h5>
                <form id="submitform">
                    @csrf
                    @if(session('otp') != 1) 
                    <x-form lname="Email" id="email_error">
                        <input type="text" name="email" class="form-control" placeholder="Enter Your Email">
                    </x-form>
                    <button type="submit" class="btn btn-primary w-100" id="button">Request OTP</button>
                   @else
                    <x-form lname="OTP" id="otp_error">
                        <input type="hidden" value="{{session('email')}}" name="re_email"/>
                        <input type="text" inputmode="numeric" maxlength="6" name="otp" class="form-control" placeholder="Enter Your OTP">
                    </x-form>
                    <button type="submit" class="btn btn-primary w-100 otp" id="button">Login</button>
                  @endif                
                </form>
            </div>
        </div>
    </div>
@push('js')
<script>
     $('#submitform').on('submit',function(e){
        e.preventDefault();
        $('#email_error').empty();
        $('#button').html('<div class="spinner-border" role="status"></div>');
        $('#button').attr('disabled',true);
         $.ajax({
             url:"{{ session('otp') != 1 ? route('email.verify') : route('otp.verify') }}",
             type:'POST',
             data:$('#submitform').serialize(),
             success:function(res){

                $('#button').html('Request OTP');
                $('.otp').html('Login');
                $('#button').attr('disabled',false);

                 if(res.code == 400){
                     $('#email_error').html(res.errors.email);
                     $('#otp_error').html(res.errors.otp);
                 }

                 if(res.code == 404){
                    $('#email_error').html(res.message);
                    $('#otp_error').html(res.message);
                 }
                 
                 if(res.code == 200){
                    location.reload();
                 }

                 if(res.code == 200 && res.status == true){
                    window.location.href = "{{route('front.dashbaord')}}"
                 }
             } 
         });         
     })
</script>        
@endpush
@php session()->forget('otp'); @endphp
</x-layout>