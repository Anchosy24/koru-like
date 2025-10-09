@extends('layouts.landing')   {{-- make sure this layout has dark background --}}
@section('content')
<a href="{{ route('login') }}" class="d-block text-start link-light fw-bold mb-4">Back to sign in</a>
                <h4 class="text-light fw-semibold">Verify your email*</h4>
                <p class="small mb-5">
                    We've sent a 6-digit code to<br>
                    <span class="text-light fw-medium">{{ $user->email ?? 'your email' }}</span>
                </p>

            {{-- OTP FORM --}}
            <form method="POST" action="{{ route('verify.update', $unique_id) }}" id="otpForm">
                @csrf
                @method('PUT')
                <div class="d-flex justify-content-between mb-4" id="otpWrapper">
                    {{-- 6 single-digit inputs --}}
                    @for($i=0;$i<6;$i++)
                        <input type="text"
                               name="otp[]"
                               maxlength="1"
                               required
                               class="form-control text-center mx-1 otp-input"
                               style="width:48px;height:56px;font-size:1.75rem;background:#2a2a2a;color:#fff;border:1px solid #ffffffff;border-radius:8px;">
                    @endfor
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-dark text-white border border-white">Verify email</button>
                </div>
            </form>

{{-- tiny script for auto-tab & auto-submit on 6th digit --}}
<script>
const inputs=document.querySelectorAll('.otp-input');
inputs.forEach((inp,i)=>{
    inp.addEventListener('input',e=>{
        if(e.target.value.length===1){
            if(i===inputs.length-1){          // last box
                document.getElementById('otpForm').submit();
            }else{
                inputs[i+1].focus();
            }
        }
    });
    inp.addEventListener('keydown',e=>{
        if(e.key==='Backspace' && e.target.value==='' && i>0){
            inputs[i-1].focus();
        }
    });
});
</script>
@endsection